<?php

namespace App\Modules\Mercado\Ordenes;

use App\Exceptions\EmailException;
use App\Modules\Clientes\Establecimientos\Establecimiento;
use App\Modules\Clientes\Establecimientos\EstablecimientoHelper;
use App\Modules\Google\Places\PlacesService;
use App\Modules\Mercado\Ordenes\Dtos\CrearOrdenDto;
use App\Modules\Mercado\Ordenes\Estado\OrdenEstado;
use App\Modules\Mercado\Posiciones\Posicion;
use App\Modules\Mercado\Posiciones\PosicionesService;
use App\Modules\Puertos\Puerto;
use App\Modules\Puertos\PuertoHelper;
use App\Modules\Usuarios\Roles\RolHelper;
use App\Modules\Usuarios\Usuarios\User;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Kodear\Laravel\Repository\Exceptions\RepositoryException;
use Exception;
use Throwable;

class OrdenesService
{
    protected PosicionesService $posicionesService;

    /**
     * OrdenesService constructor.
     * @param PosicionesService $posicionesService
     */
    public function __construct(PosicionesService $posicionesService)
    {
        $this->posicionesService = $posicionesService;
    }

    /**
     * @param User $user
     * @param int $page
     * @param int $limit
     * @param array $filtros
     * @param array $ordenes
     * @param array $opciones
     * @return LengthAwarePaginator
     */
    public function listar(User $user, int $page = 1, int $limit = 0, array $filtros = [], array $ordenes = [], array $opciones = [])
    {
        if ($user->hasAnyRol(RolHelper::REPRESENTATE)) {
            $filtros['usuario_carga_id'] = $user->getKey();
        }

        return Orden::listar(
            $page,
            $limit,
            $filtros,
            $ordenes,
            $opciones
        );
    }

    public function obtenerOfertas(int $page = 1, int $limit = 0, array $filtros = [], array $ordenes = [], array $opciones = []) {
        return Orden::listar(
            $page,
            $limit,
            $filtros,
            $ordenes,
            $opciones
        );
    }

    /**
     * @param Orden $orden
     * @param $opciones
     * @return Orden
     * @throws RepositoryException
     */
    public function getOne(Orden $orden, $opciones): Orden
    {
        return Orden::getById($orden->getKey(), [], $opciones);
    }

    /**
     * @param User $user
     * @param CrearOrdenDto $crearOrdenDto
     * @return Orden
     */
    public function crear(User $user, CrearOrdenDto $crearOrdenDto): Orden
    {
        $orden = new Orden;

        $orden->empresa_id = $crearOrdenDto->empresa_id;
        $orden->producto_id = $crearOrdenDto->producto_id;
        $orden->calidad_id = $crearOrdenDto->calidad_id;
        $orden->condicion_pago_id = $crearOrdenDto->condicion_pago_id;
        $orden->moneda = $crearOrdenDto->moneda;
        $orden->precio = $crearOrdenDto->precio;
        $orden->volumen = $crearOrdenDto->volumen;
        $orden->estado_id = $crearOrdenDto->estado_id;
        $orden->fecha_entrega_inicio = $crearOrdenDto->fecha_entrega_inicio;
        $orden->fecha_entrega_fin = $crearOrdenDto->fecha_entrega_fin;
        $orden->observaciones = $crearOrdenDto->observaciones;
        $orden->entrega = $crearOrdenDto->entrega;
        $orden->usuario_carga_id = $user->getKey();

        $idOrdenCopia = $crearOrdenDto->id;
        if (!is_null ($idOrdenCopia)) {
            $ordenCopia = Orden::getById($idOrdenCopia);
        }

        //Se completan la ubicación de PROCEDENCIA
        //Si hay establecimiento_id se copia esa geolocalización. Si no hay, pero existe placeIdProcedencia, se copia esa.
        //Si no hay ninguna entonces quiere decir que se está copiando desde otra orden (ver validaciones de OrdenesRequest.php), entonces
        //se copia esa geolocalización
        if (!is_null($crearOrdenDto->establecimiento_id)) {

            /** @var Establecimiento $establecimiento */
            $establecimiento = EstablecimientoHelper::obtenerEstablecimientoById($crearOrdenDto->establecimiento_id);

            $orden->establecimiento_id = $crearOrdenDto ->establecimiento_id;
            $orden->localidad_procedencia = $establecimiento->getLocalidad();
            $orden->departamento_procedencia = $establecimiento->getDepartamento();
            $orden->provincia_procedencia = $establecimiento->getProvincia();
            $orden->latitud_procedencia = $establecimiento->getLatitud();
            $orden->longitud_procedencia = $establecimiento->getLongitud();
        } else if (!is_null($crearOrdenDto->placeIdProcedencia)) {
            $detalles = PlacesService::obtenerDetalles($crearOrdenDto->placeIdProcedencia);

            $orden->localidad_procedencia = $detalles->localidad;
            $orden->departamento_procedencia = $detalles->departamento;
            $orden->provincia_procedencia = $detalles->provincia;
            $orden->latitud_procedencia = $detalles->latitud;
            $orden->longitud_procedencia = $detalles->longitud;

        } else {
            $orden->localidad_procedencia = $ordenCopia->localidad_procedencia;
            $orden->departamento_procedencia = $ordenCopia->departamento_procedencia;
            $orden->provincia_procedencia = $ordenCopia->provincia_procedencia;
            $orden->latitud_procedencia = $ordenCopia->latitud_procedencia;
            $orden->longitud_procedencia = $ordenCopia->longitud_procedencia;
        }

        //Se completa la ubicación de DESTINO
        //Si hay puerto_id se copia esa geolocalización. Si no hay, pero existe placeIdDestino, se copia la geolocalización del placeIdDestino.
        //Si no hay ninguna entonces quiere decir que se está copiando desde otra orden (ver validaciones de OrdenesRequest.php), entonces
        //se copia la geolocalización de esa orden.
        if ($crearOrdenDto->opcion_destino === 'exportacion') {
            /** @var Puerto $puerto */
            $puerto = PuertoHelper::obtenerPuertoById($crearOrdenDto->puerto_id);

            $orden->puerto_id = $crearOrdenDto->puerto_id;
            $orden->localidad_destino = $puerto->getLocalidad();
            $orden->departamento_destino = $puerto->getDepartamento();
            $orden->provincia_destino = $puerto->getProvincia();
            $orden->latitud_destino = $puerto->getLatitud();
            $orden->longitud_destino = $puerto->getLongitud();
        } else if (!is_null($crearOrdenDto->placeIdDestino)) {
            $detalles = PlacesService::obtenerDetalles($crearOrdenDto->placeIdDestino);
            $orden->localidad_destino = $detalles->localidad;
            $orden->departamento_destino = $detalles->departamento;
            $orden->provincia_destino = $detalles->provincia;
            $orden->latitud_destino = $detalles->latitud;
            $orden->longitud_destino = $detalles->longitud;
        } else {
            $orden->localidad_destino = $ordenCopia->localidad_destino;
            $orden->departamento_destino = $ordenCopia->departamento_destino;
            $orden->provincia_destino = $ordenCopia->provincia_destino;
            $orden->latitud_destino = $ordenCopia->latitud_destino;
            $orden->longitud_destino = $ordenCopia->longitud_destino;
        }

        $orden->insertar();

        return $orden;
    }

    /**
     * @param Orden $orden
     * @param array $data
     * @return Orden
     * @throws RepositoryException
     */
    public function actualizar(Orden $orden, array $data): Orden
    {
        $orden->actualizar($data);

        return $orden;
    }

    /**
     * @param Orden $orden
     * @throws Exception
     */
    public function borrar(Orden $orden): void
    {
        $orden->borrar();
    }

    /**
     * @param Orden $orden
     * @param int $estadoId
     * @return Orden
     * @throws RepositoryException
     */
    public function cambiarEstado(Orden $orden, int $estadoId)
    {
        return $orden->actualizar(['estado_id' => $estadoId]);
    }

    /**
     * @param Orden $orden
     * @param $data
     * @return Orden
     * @throws RepositoryException
     * @throws Throwable
     */
    public function cerrarSlip(Orden $orden, $data): Orden
    {
        try {
            DB::beginTransaction();
            $orden->actualizar($data);

            $posicion = Posicion::getById((int) $data['posicion_id']);
            $this->cambiarEstado($orden, OrdenEstado::CONFIRMADA);

            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }

        return $orden->load('posicion');
    }

	public function listarLocalidades() {
		$query = Orden::generarConsulta();

		$query->select('localidad_destino')
			->whereDate('created_at', '=', Carbon::today())
			->where('localidad_destino', '!=', '')				// Preveer casos donde no se seteó la localidad
			->distinct();

		return $query->get();
	}
}
