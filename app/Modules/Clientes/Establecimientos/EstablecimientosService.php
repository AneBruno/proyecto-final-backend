<?php

namespace App\Modules\Clientes\Establecimientos;

use App\Modules\Direcciones\Direcciones;
use App\Modules\Clientes\Empresas\Empresa;
use App\Modules\Puertos\Puerto;

class EstablecimientosService {

    static public function listar(int $page = 1, int $limit = 0, array $filtros = [], array $ordenes = []) {
        return Establecimiento::listar($page, $limit, $filtros, $ordenes);
    }

    static public function getById(int $id): Establecimiento {
        return Establecimiento::getById($id, [], ['expandir' => ['urlImagenMapa','direccionCompleta']]);
    }

    static public function crear(
        int     $empresa_id,
        int     $puerto_id,
        string  $nombre,
        string  $tipo,
        string  $propio,
        ?int    $hectareas_agricolas,
        ?int    $hectareas_ganaderas,
        ?int    $capacidad_acopio,
        string  $placeId,
        ?string $descripcionUbicacion
    ): Establecimiento {
        $row = Establecimiento::crear($empresa_id, $puerto_id, $nombre, $tipo, $propio, $hectareas_agricolas, $hectareas_ganaderas, $capacidad_acopio);

        Direcciones::actualizarUbicacionPorPlaceId($row, $placeId);
        $row->actualizarDescripcionUbicacion($descripcionUbicacion);

        return $row;
    }

    static public function actualizar(
        int     $id,
        int     $puerto_id,
        string  $nombre,
        string  $tipo,
        string  $propio,
        ?int    $hectareas_agricolas,
        ?int    $hectareas_ganaderas,
        ?int    $capacidad_acopio,
        ?string $placeId,
        ?string $descripcionUbicacion = null
    ): Establecimiento {
        $row = Establecimiento::getById($id)->actualizar(
            $puerto_id,
            $nombre,
            $tipo,
            $propio,
            $hectareas_agricolas,
            $hectareas_ganaderas,
            $capacidad_acopio
        );
        
        $row->actualizarDescripcionUbicacion($descripcionUbicacion);
        
        if ($placeId) {
            Direcciones::actualizarUbicacionPorPlaceId($row, $placeId);
        }
        return $row;
    }

    static public function habilitar(int $id): Establecimiento {
        $row = Establecimiento::getById($id, ['borrados' => true]);
        $row->habilitar();
        return $row;
    }

    static public function borrar(int $id): void {
        Establecimiento::getById($id)->borrar();
    }

    static public function validadorEmpresaExistente() {
        return function($attribute, $value, $fail) {
            if (Empresa::contar(['id'=>$value])===0) {
                $fail("No se encontró la empresa");
            }
        };
    }

    static public function validadorPuertoExistente() {
        return function($attribute, $value, $fail) {
            if (Puerto::contar(['id'=>$value])===0) {
                $fail("No se encontró la empresa");
            }
        };
    }
}
