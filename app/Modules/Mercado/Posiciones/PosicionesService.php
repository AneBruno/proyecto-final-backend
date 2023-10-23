<?php

namespace App\Modules\Mercado\Posiciones;

use App\Exceptions\EmailException;
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
        /*if (!array_key_exists('estado', $filtros)) {
            $filtros['estado'] = 'todas'; //listado por defecto
        }*/
        $opciones['with_relation'] = array_merge([
            'producto',
            'puerto',
            'condicionPago',
            'usuarioCarga'
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
            'puerto',
            'condicionPago',
            'empresa',
            'usuarioCarga'
        ]);

        return Posicion::getById($id, [], $opciones);
    }

    static public function crear(
        int     $usuarioCargaId,
        int     $productoId,
        int     $empresaId,
        string  $moneda,
        float   $precio,
        float   $volumen,
        ?int    $condicionPagoId      = null,
        ?int    $cosecha_id           = null,
        ?int    $puertoId             = null,
        ?string $observaciones        = null,
        ?int    $idPosicionACopiar       = null
    ) {

        $row = new Posicion;

        $row->usuario_carga_id      = $usuarioCargaId;
        $row->producto_id           = $productoId;
        $row->empresa_id            = $empresaId;
        $row->moneda                = $moneda;
        $row->precio                = $precio;
        $row->condicion_pago_id     = $condicionPagoId;
        $row->cosecha_id            = $cosecha_id;
        $row->observaciones         = $observaciones;
        $row->volumen               = $volumen;

        /** @var Puerto $puerto */
        $puerto = PuertoHelper::obtenerPuertoById($puertoId);
        if (!is_null($puerto)){

            $row->puerto_id = $puertoId;
            $row->localidad_destino = $puerto->getLocalidad();
            $row->provincia_destino = $puerto->getProvincia();
        }
        else
        {
            if (!is_null($idPosicionACopiar)) {
                /** @var Posicion $posicionPorCopiar */
                $posicionPorCopiar = Posicion::query()->where('id', '=', $idPosicionACopiar)->first();

                $row->localidad_destino = $posicionPorCopiar->getLocalidadDestino();
                $row->provincia_destino = $posicionPorCopiar->getProvinciaDestino();
            } else {
                throw new \Exception('Error al crear la posición');
            }
        }
        return $row->insertar();
        }       
    

    /**
     * @param int $id
     * @param int $productoId
     * @param int $calidadId
     * @param int $empresaId
     * @param string|null $moneda
     * @param float|null $precio
     * @param int|null $condicionPagoId
     * @param int|null $cosechaId
     * @param int|null $puertoId
     * @param string|null $observaciones
     * @return Posicion
     * @throws RepositoryException
     */
    static public function actualizar(
        int     $id,
        int     $productoId,
        int     $empresaId,
        ?string $moneda,
        ?float  $precio,
        float     $volumen,
        ?int    $condicionPagoId      = null,
        ?int    $cosechaId            = null,
        ?int    $puertoId             = null,
        ?string $observaciones        = null
    ): Posicion {

        $row = Posicion::getById($id);
        $row->producto_id           = $productoId;
        $row->empresa_id            = $empresaId;
        $row->moneda                = $moneda;
        $row->precio                = $precio;
        $row->condicion_pago_id     = $condicionPagoId;
        $row->cosecha_id            = $cosechaId;
        $row->puerto_id             = $puertoId;
        $row->observaciones         = $observaciones;
        $row->volumen               = $volumen;

        $row->guardar();

        return $row;
    }

    static public function actualizarToneladasCerradas(
        int     $id,
        int     $toneladas_cerradas
    ): Posicion{
        $row = Posicion::getById($id);
        $row->toneladas_cerradas += $toneladas_cerradas;

        if($row->toneladas_cerradas >= $row->getVolumen()){
            $row = self::cambiarEstado($row, 'CERRADA');
        }
        $row->guardar();

        return $row;
    }

    static public function restarToneladasCerradas(
        int     $id,
        int     $toneladas_cerradas
    ): Posicion{
        $row = Posicion::getById($id);
        $row->toneladas_cerradas -= $toneladas_cerradas;

        if($row->toneladas_cerradas < $row->getVolumen()){
            $row = self::cambiarEstado($row, 'ACTIVA');
        }else{
            //no hago nada porque se debe mantener el estado 'cerrada'
        }
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
            return $posicion;
        } catch (\Exception $exception) {
            throw $exception;
        }
    }

}