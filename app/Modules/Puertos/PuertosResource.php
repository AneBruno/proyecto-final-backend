<?php

namespace App\Modules\Puertos;

use Illuminate\Http\Resources\Json\JsonResource;

class PuertosResource extends JsonResource
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
            'nombre'        => $this->resource->nombre,
            'localidad'     => $this->resource->localidad,
            'provincia'     => $this->resource->provincia
        ];
    }
}
