<?php

namespace App\Modules\Clientes\Oficinas;

use App\Modules\Direcciones\Direcciones;
use App\Modules\Clientes\Empresas\Empresa;

class OficinasService
{

    static public function listar(int $page = 1, int $limit = 0, array $filtros = [], array $ordenes = []) {
        return Oficina::listar($page, $limit, $filtros, $ordenes);
    }


    static public function getById(int $id): Oficina {
        return Oficina::getById($id, [], ['expandir' => ['urlImagenMapa','direccionCompleta']]);
    }

    static public function crear(
        int    $empresaId,
        string $nombre,
        string $telefono,
        string $email,
        string $placeId,
        ?string $descripcionUbicacion = null
    ): Oficina {
        $row = Oficina::crear($empresaId, $nombre, $telefono, $email);

        Direcciones::actualizarUbicacionPorPlaceId($row, $placeId);
        $row->actualizarDescripcionUbicacion($descripcionUbicacion);

        return $row;
    }

    static public function actualizar(
        int $id,
        string $nombre,
        string $telefono,
        string $email,
        ?string $placeId = null,
        ?string $descripcionUbicacion = null
    ): Oficina {
        $row = Oficina::getById($id)->actualizar($nombre, $telefono, $email);
        $row->actualizarDescripcionUbicacion($descripcionUbicacion);
        
        if ($placeId) {
            Direcciones::actualizarUbicacionPorPlaceId($row, $placeId);
        }
        return $row;
    }

    static public function habilitar(int $id): Oficina {
        $row = Oficina::getById($id, ['borrados' => true]);
        $row->habilitar();
        return $row;
    }

    static public function borrar(int $id): void
    {
        Oficina::getById($id)->borrar();
    }

    static public function validadorEmpresaExistente() {
        return function($attribute, $value, $fail) {
            if (Empresa::contar(['id'=>$value])===0) {
                $fail("No se encontró la empresa");
            }
        };
    }
}
