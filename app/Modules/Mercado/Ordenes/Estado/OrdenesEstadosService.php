<?php

namespace App\Modules\Mercado\Ordenes\Estado;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class OrdenesEstadosService
{
    /**
     * @return LengthAwarePaginator|Builder[]|Collection
     */
    public function getAll()
    {
       return OrdenEstado::listar();
    }
}
