<?php

namespace App\Modules\Mercado\Posiciones;

use App\Exceptions\EmailException;
use App\Modules\Clientes\Establecimientos\Establecimiento;
use App\Modules\Clientes\Establecimientos\EstablecimientoHelper;
use App\Modules\Google\Places\PlacesService;
use App\Modules\Mercado\Posiciones\Notifications\PosicionDenunciada;
use App\Modules\Puertos\Puerto;
use App\Modules\Puertos\PuertoHelper;
use App\Modules\Usuarios\Usuarios\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Kodear\Laravel\Repository\Exceptions\RepositoryException;
use mysql_xdevapi\Exception;

class PosicionesService
{

    /**
     * @param int $offset
     * @param int $limit
     * @param array $filtros
     * @return LengthAwarePaginator
     */
    static public function listar(int $offset = 0, int $limit = 0, array $filtros = [], array $ordenes = [], array $opciones = [])
    {
        if (!array_key_exists('estado', $filtros)) {
            $filtros['estado'] = 'todas'; //listado por defecto
        }
        $opciones['with_relation'] = array_merge([
            'producto',
            'calidad',
            'establecimiento',
            'puerto',
            'condicionPago',
        ], $opciones['with_relation']);

        return Posicion::listar($offset, $limit, $filtros, $ordenes, $opciones);
    }

    /**
     * @param int $id
     * @return Posicion
     * @throws RepositoryException
     */
    static public function getById(int $id, array $opciones = []): Posicion
    {
        $opciones['with_relation'] = array_merge($opciones['with_relation'], [
            'producto',
            'calidad',
            'establecimiento',
            'puerto',
            'condicionPago',
            'empresa'
        ]);

        return Posicion::getById($id, [], $opciones);
    }

    static public function crear(
        int     $usuarioCargaId,
        int     $productoId,
        int     $calidadId,
        string  $fechaEntregaInicio,
        string  $fechaEntregaFin,
        int     $empresaId,
        string  $opcionDestino,
        ?string  $moneda              = null,
        ?float   $precio              = null,
        ?int    $condicionPagoId      = null,
        ?bool   $posicionExcepcional  = null,
        ?bool   $volumenLimitado      = null,
        ?bool   $aTrabajar            = null,
        ?int    $cosecha_id           = null,
        ?int    $establecimientoId    = null,
        ?int    $puertoId             = null,
        ?string $observaciones        = null,
        ?string $calidadObservaciones = null,
        ?string $entrega              = null,
        ?bool   $aFijar               = null,
        ?string $placeId              = null,
        ?int $idPosicionACopiar       = null
    ) {
        $posicionExcepcional = self::getValorBool($posicionExcepcional);
        $volumenLimitado     = self::getValorBool($volumenLimitado);
        $aTrabajar           = self::getValorBool($aTrabajar);
        $aFijar              = self::getValorBool($aFijar);

        if ($aFijar) {
            $moneda = null;
            $precio = null;
        }

        $row = new Posicion;

        $row->usuario_carga_id      = $usuarioCargaId;
        $row->producto_id           = $productoId;
        $row->calidad_id            = $calidadId;
        $row->fecha_entrega_inicio  = $fechaEntregaInicio;
        $row->fecha_entrega_fin     = $fechaEntregaFin;
        $row->empresa_id            = $empresaId;
        $row->moneda                = $moneda;
        $row->precio                = $precio;
        $row->condicion_pago_id     = $condicionPagoId;
        $row->posicion_excepcional  = $posicionExcepcional;
        $row->volumen_limitado      = $volumenLimitado;
        $row->a_trabajar            = $aTrabajar;
        $row->cosecha_id            = $cosecha_id;
        $row->observaciones         = $observaciones;
        $row->calidad_observaciones = $calidadObservaciones;
        $row->entrega               = $entrega;
        $row->a_fijar               = $aFijar;

        if ($opcionDestino === 'exportacion') {
            /** @var Puerto $puerto */
            $puerto = PuertoHelper::obtenerPuertoById($puertoId);

            $row->puerto_id = $puertoId;
            $row->localidad_destino = $puerto->getLocalidad();
            $row->departamento_destino = $puerto->getDepartamento();
            $row->provincia_destino = $puerto->getProvincia();
            $row->latitud_destino = $puerto->getLatitud();
            $row->longitud_destino = $puerto->getLongitud();

        } else {
            if (!is_null($placeId)) {
                $detalles = PlacesService::obtenerDetalles($placeId);

                $row->localidad_destino = $detalles->localidad;
                $row->departamento_destino = $detalles->departamento;
                $row->provincia_destino = $detalles->provincia;
                $row->latitud_destino = $detalles->latitud;
                $row->longitud_destino = $detalles->longitud;

            } else {
                if (!is_null($establecimientoId)) {
                    /** @var Establecimiento $establecimiento */
                    $establecimiento = EstablecimientoHelper::obtenerEstablecimientoById($establecimientoId);

                    $row->establecimiento_id = $establecimientoId;
                    $row->localidad_destino = $establecimiento->getLocalidad();
                    $row->departamento_destino = $establecimiento->getDepartamento();
                    $row->provincia_destino = $establecimiento->getProvincia();
                    $row->latitud_destino = $establecimiento->getLatitud();
                    $row->longitud_destino = $establecimiento->getLongitud();
                } elseif (!is_null($idPosicionACopiar)) {
                    /** @var Posicion $posicionPorCopiar */
                    $posicionPorCopiar = Posicion::query()->where('id', '=', $idPosicionACopiar)->first();

                    $row->localidad_destino = $posicionPorCopiar->getLocalidadDestino();
                    $row->departamento_destino = $posicionPorCopiar->getDepartamentoDestino();
                    $row->provincia_destino = $posicionPorCopiar->getProvinciaDestino();
                    $row->latitud_destino = $posicionPorCopiar->getLatitudDestino();
                    $row->longitud_destino = $posicionPorCopiar->getLongitudDestino();
                } else {
                    throw new \Exception('Error al crear la posición');
                }
            }
        }

        return $row->insertar();
    }

    /**
     * @param int $id
     * @param int $productoId
     * @param int $calidadId
     * @param string $fechaEntregaInicio
     * @param string $fechaEntregaFin
     * @param int $empresaId
     * @param string|null $moneda
     * @param float|null $precio
     * @param int|null $condicionPagoId
     * @param bool|null $posicionExcepcional
     * @param bool|null $volumenLimitado
     * @param bool|null $aTrabajar
     * @param int|null $cosechaId
     * @param int|null $establecimientoId
     * @param int|null $puertoId
     * @param string|null $observaciones
     * @param string|null $calidadObservaciones
     * @param string|null $entrega
     * @param bool|null $aFijar
     * @return Posicion
     * @throws RepositoryException
     */
    static public function actualizar(
        int     $id,
        int     $productoId,
        int     $calidadId,
        string  $fechaEntregaInicio,
        string  $fechaEntregaFin,
        int     $empresaId,
        ?string  $moneda,
        ?float   $precio,
        ?int    $condicionPagoId      = null,
        ?bool   $posicionExcepcional  = null,
        ?bool   $volumenLimitado      = null,
        ?bool   $aTrabajar            = null,
        ?int    $cosechaId            = null,
        ?int    $establecimientoId    = null,
        ?int    $puertoId             = null,
        ?string $observaciones        = null,
        ?string $calidadObservaciones = null,
        ?string $entrega              = null,
        ?bool   $aFijar               = null
    ): Posicion {
        $posicionExcepcional = self::getValorBool($posicionExcepcional);
        $volumenLimitado     = self::getValorBool($volumenLimitado);
        $aTrabajar           = self::getValorBool($aTrabajar);
        $aFijar              = self::getValorBool($aFijar);

        $row = Posicion::getById($id);
        $row->producto_id           = $productoId;
        $row->calidad_id            = $calidadId;
        $row->fecha_entrega_inicio  = $fechaEntregaInicio;
        $row->fecha_entrega_fin     = $fechaEntregaFin;
        $row->empresa_id            = $empresaId;
        $row->moneda                = $moneda;
        $row->precio                = $precio;
        $row->condicion_pago_id     = $condicionPagoId;
        $row->posicion_excepcional  = $posicionExcepcional;
        $row->volumen_limitado      = $volumenLimitado;
        $row->a_trabajar            = $aTrabajar;
        $row->cosecha_id            = $cosechaId;
        $row->establecimiento_id    = $establecimientoId;
        $row->puerto_id             = $puertoId;
        $row->observaciones         = $observaciones;
        $row->calidad_observaciones = $calidadObservaciones;
        $row->entrega               = $entrega;
        $row->a_fijar               = $aFijar;

        $row->guardar();

        return $row;
    }

    /**
     * @param int $id
     * @throws RepositoryException
     */
    static public function borrar(int $id): void
    {
        Posicion::getById($id)->borrar();
    }

    /**
     * @param $valor
     * @return bool
     */
    static private function getValorBool($valor) {
        if ($valor == null) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * @param Posicion $posicion
     * @param string $estado
     * @param User|null $user
     * @return Posicion
     * @throws EmailException
     * @throws RepositoryException
     */
    static public function cambiarEstado(Posicion $posicion, string $estado, User $user = null)
    {
        try {
            $posicion->update(['estado' => $estado]);
            $posicion->guardar();

            if ($estado === Posicion::DENUNCIADA && !is_null($user)) {
                self::notificarUsuarioPosicionDenunciada($posicion, $user);
            }
            return $posicion;
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

    /**
     * @param Posicion $posicion
     * @param User $usuarioDenunciante
     * @throws EmailException
     */
    static private function notificarUsuarioPosicionDenunciada(Posicion $posicion, User $usuarioDenunciante): void
    {
        try {
            /** @var User $userPosicion */
            $userPosicion = $posicion->usuarioCarga()->getResults();

            $userPosicion->notify(new PosicionDenunciada($posicion, $usuarioDenunciante));
        } catch (\Throwable $e) {
            throw new EmailException("No se pudo notificar la posición denunciada.", 0, $e);
        }
    }
}
