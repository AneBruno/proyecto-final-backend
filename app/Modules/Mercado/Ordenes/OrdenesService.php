<?php

namespace App\Modules\Mercado\Ordenes;

use App\Mail\NegocioCerradoMail;
use App\Mail\NegocioCerradoVendedor;
use App\Modules\Mercado\Ordenes\Dtos\CrearOrdenDto;
use App\Modules\Mercado\Ordenes\Estado\OrdenEstado;
use App\Modules\Mercado\Posiciones\Posicion;
use App\Modules\Mercado\Posiciones\PosicionesService;
use App\Modules\Puertos\Puerto;
use App\Modules\Puertos\PuertoHelper;
use Illuminate\Support\Facades\Mail;
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
        /*if ($user->hasAnyRol(RolHelper::REPRESENTATE)) {
            $filtros['usuario_carga_id'] = $user->getKey();
        }*/

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
        $orden->condicion_pago_id = $crearOrdenDto->condicion_pago_id;
        $orden->moneda = $crearOrdenDto->moneda;
        $orden->precio = $crearOrdenDto->precio;
        $orden->volumen = $crearOrdenDto->volumen;
        $orden->estado_id = 1;
        $orden->observaciones = $crearOrdenDto->observaciones;
        $orden->usuario_carga_id = $user->getKey();

        $idOrdenCopia = $crearOrdenDto->id;
        if (!is_null ($idOrdenCopia)) {
            $ordenCopia = Orden::getById($idOrdenCopia);
        }

        /** @var Puerto $puerto */
        $puerto = PuertoHelper::obtenerPuertoById($crearOrdenDto->puerto_id);
        if (!is_null($puerto)){
            $orden->puerto_id = $crearOrdenDto->puerto_id;
            $orden->localidad_destino = $puerto->getLocalidad();
            $orden->provincia_destino = $puerto->getProvincia();
        } 
        else {
            $orden->localidad_destino = $ordenCopia->localidad_destino;
            $orden->provincia_destino = $ordenCopia->provincia_destino;
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
    public function cerrarSlip(Orden $orden, $data, $data_posicion): Orden
    {
        try {
            DB::beginTransaction();
            $orden->actualizar($data);
            $posicion = Posicion::getById((int) $data['posicion_id']);
            
            $this->posicionesService->actualizarToneladasCerradas(
                (int) $data_posicion['posicion_id'],
                (int) $data_posicion['toneladas_cierre']
            );
            
            $this->cambiarEstado($orden, OrdenEstado::CONFIRMADA);
            

            $toneladas_cierre       = $orden->toneladas_cierre;
            $comprador              = $posicion->empresa;
            $vendedor               = $orden->empresa;
            $producto               = $orden->producto->nombre;
            $forma_pago             = $orden->condicionPago->descripcion;
            $puerto                 = $orden->puerto->nombre;
            $fecha_cierre           = $orden->updated_at->format('d/m');
            $moneda                 = $orden->moneda;
            $precio_cierre          = $orden->precio_cierre_slip;
            $precio_total           = $precio_cierre * $toneladas_cierre;
            //porcentajes de comisiones
            $comision_comprador_porcentaje     = $posicion->empresa->comision;
            $comision_vendedor_porcentaje      = $orden->empresa->comision;
            //monto de las comisiones
            $comision_comprador     = ($comision_comprador_porcentaje /100) * $precio_total;
            $comision_vendedor      = ($comision_vendedor_porcentaje /100) * $precio_total;  
            //usuarios vinculados a las empresas compradoras y vendedoras
            $usuario_comprador_id   = $comprador->usuario_comercial_id;
            $usuario_comprador      = User::find($usuario_comprador_id);
            $usuario_vendedor_id    = $vendedor->usuario_comercial_id;      
            $usuario_vendedor       = User::find($usuario_vendedor_id);

            if (!empty($comprador->email)) {
                Mail::to($comprador->email)->send(new NegocioCerradoMail(
                    $fecha_cierre , $comprador,$vendedor, $producto,$forma_pago, $puerto,$moneda, $precio_cierre, $toneladas_cierre, $precio_total, $comision_comprador_porcentaje,$comision_comprador));  
            }
            if(!empty($usuario_comprador)){
                Mail::to($usuario_comprador->email)->send(new NegocioCerradoMail(
                    $fecha_cierre , $comprador,$vendedor, $producto,$forma_pago, $puerto,$moneda, $precio_cierre, $toneladas_cierre, $precio_total, $comision_comprador_porcentaje,$comision_comprador)); 
            }

            if (!empty($vendedor->email)) {
                Mail::to($vendedor->email)->send(new NegocioCerradoVendedor(
                    $fecha_cierre , $comprador,$vendedor, $producto,$forma_pago, $puerto,$moneda, $precio_cierre, $toneladas_cierre, $precio_total, $comision_vendedor_porcentaje,$comision_vendedor
                ));  
            }
            if(!empty($usuario_vendedor)){
                Mail::to($usuario_vendedor->email)->send(new NegocioCerradoVendedor(
                    $fecha_cierre , $comprador,$vendedor, $producto,$forma_pago, $puerto,$moneda, $precio_cierre, $toneladas_cierre, $precio_total, $comision_vendedor_porcentaje,$comision_vendedor
                ));  
            }

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
