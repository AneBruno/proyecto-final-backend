<?php


namespace App\Modules\Puertos;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class PuertoHelper
{
    /**
     * @param $id
     * @return Builder|Model|object|null
     */
    public static function obtenerPuertoById($id)
    {
        return Puerto::query()->where('id', '=', $id)->first();
    }
}
