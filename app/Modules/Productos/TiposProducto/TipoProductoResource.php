<?php

namespace App\Modules\Productos\TiposProducto;

use Illuminate\Http\Resources\Json\JsonResource;

class TipoProductoResource extends JsonResource
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
            'id'               => $this->resource->id,
            'nombre'           => $this->resource->nombre,
        ];
    }
}
