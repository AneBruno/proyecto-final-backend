<?php

namespace App\Modules\Mercado\Ordenes\Estado;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrdenEstadoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        /** @var OrdenEstado $estado */
        $estado = $this->resource;

        return [
            'id'     => $estado->getKey(),
            'nombre' => $estado->nombre
        ];
    }
}
