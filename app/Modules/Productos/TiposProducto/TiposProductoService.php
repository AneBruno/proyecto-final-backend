<?php

namespace App\Modules\Productos\TiposProducto;


class TiposProductoService
{

    public function listar(int $offset = 0, int $limit = 0, array $filtros = [])
    {
        return TipoProducto::listar($offset, $limit, $filtros);
    }

    /*public function eliminar(TipoProducto $tiposProducto)
    {
        $tiposProducto->productos()->update(['habilitado' => false]);
        TipoProducto::getById($tiposProducto->getKey())->borrar();
    }*/

    static public function habilitar(int $id): TipoProducto {
        $tipo = TipoProducto::getById($id);
        $tipo->habilitar();
        return $tipo;
    }

    static public function deshabilitar(int $id): TipoProducto {
        $tipo = TipoProducto::getById($id);
        $tipo->deshabilitar();
        return $tipo;
    }
}
