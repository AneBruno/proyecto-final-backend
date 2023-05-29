<?php

namespace App\Modules\Mercado\Ordenes;

class OrdenesHelper
{
    public static function getById($id)
    {
        return Orden::query()->where('id', '=', $id)->first();
    }
}
