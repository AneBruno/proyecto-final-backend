<?php


namespace App\Modules\Clientes\Establecimientos;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class EstablecimientoHelper
{
    /**
     * @param $id
     * @return Builder|Model|object|null
     */
    public static function obtenerEstablecimientoById($id)
    {
        return Establecimiento::query()->where('id', '=', $id)->first();
    }
}
