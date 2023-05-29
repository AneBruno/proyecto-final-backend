<?php

namespace App\Modules\Puertos;

use App\Modules\Direcciones\Direcciones;
use Exception;

class PuertosService
{

    static public function listar(int $offset = 0, int $limit = 0, array $filtros = [])
    {
        if (!array_key_exists('estado', $filtros)) {
            $filtros['estado'] = 'HABILITADO'; //listado por defecto
        }
        return Puerto::listar($offset, $limit, $filtros);
    }

    static public function getById(int $id): Puerto
    {
        return Puerto::getById($id);
    }

    /**
     *
     * @param string $nombre
     * @param int|null $orden
     * @return Puerto
     */
    static public function crear(
        string $nombre,
        string $terminal,
        string $placeId,
        ?string $descripcionUbicacion = null
    ): Puerto {

        $row = Puerto::crear($nombre, $terminal);
        Direcciones::actualizarUbicacionPorPlaceId($row, $placeId);

        $row->actualizarDescripcionUbicacion($descripcionUbicacion);

        return $row;
    }

    /**
     *
     * @param int $id
     * @param string $nombre
     * @param int|null $orden
     * @return Puerto
     */
    static public function actualizar(
        int     $id,
        string  $nombre,
        string  $terminal,
        ?string $placeId = null,
        ?string $descripcionUbicacion = null
    ): Puerto {
        $row = Puerto::getById($id);
        $row->actualizar($nombre, $terminal);

        $row->actualizarDescripcionUbicacion($descripcionUbicacion);

        if ($placeId) {
            Direcciones::actualizarUbicacionPorPlaceId($row, $placeId);
        }

        return $row;
    }

    /**
     *
     * @param int $id
     * @return void
     */
    static public function borrar(int $id): void
    {
        Puerto::getById($id)->borrar();
    }

    static public function getUrlImagen(int $id): string {
        return Direcciones::getUrlImagen(Puerto::getById($id));
    }

    /**
     * @param Puerto $puerto
     * @param string $estado
     * @return Puerto
     * @throws Exception
     */
    static public function cambiarEstado(Puerto $puerto, string $estado): Puerto
    {
        try {
            $puerto->update(['estado' => $estado]);
            $puerto->save();
        } catch (Exception $e) {
            throw new Exception('No se pudo actualizar el estado del puerto. ' . $e->getMessage(), $e->getCode(), $e->getPrevious());
        }

        return $puerto;
    }
}
