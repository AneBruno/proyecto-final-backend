<?php

namespace App\Modules\Productos\TiposProducto;


class TiposProductoService
{

    public function listar(int $offset = 0, int $limit = 0, array $filtros = [])
    {
        return TipoProducto::listar($offset, $limit, $filtros);
    }

    public function eliminar(TipoProducto $tiposProducto)
    {
        $tiposProducto->productos()->update(['habilitado' => false]);
        TipoProducto::getById($tiposProducto->getKey())->borrar();
    }
}
