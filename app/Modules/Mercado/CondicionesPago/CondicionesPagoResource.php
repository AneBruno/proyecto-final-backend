<?php

namespace App\Modules\Mercado\CondicionesPago;

use Illuminate\Http\Resources\Json\JsonResource;

class CondicionesPagoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'            => $this->resource->id,
            'descripcion'   => $this->resource->descripcion,
        ];
    }
}
