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
            'terminal'      => $this->resource->terminal,
            'latitud'       => $this->resource->latitud,
            'longitud'      => $this->resource->longitud,
            'localidad'     => $this->resource->localidad,
            'departamento'  => $this->resource->departamento,
            'provincia'     => $this->resource->provincia,
            'placeId'       => null,
            'descripcionUbicacion' => $this->resource->descripcionUbicacion,
            'urlImagenMapa' => PuertosService::getUrlImagen($this->resource->id)
        ];
    }
}
