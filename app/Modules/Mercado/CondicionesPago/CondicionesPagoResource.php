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
        /** @var CondicionPago $condicion */
        $condicion = $this->resource;

        return [
            'id'            => $condicion->id,
            'descripcion'   => $condicion->descripcion,
            'habilitado'    => (bool) $this->resource->habilitado ==null,
            'created_at' => $condicion->created_at,
            'updated_at' => $condicion->updated_at
        ];
    }
}
