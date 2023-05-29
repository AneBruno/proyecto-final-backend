<?php

namespace App\Modules\Oficinas;

use Illuminate\Http\Resources\Json\JsonResource;

class OficinaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $resource = $this->resource;
        /**
         *  @var Oficina $oficina
         */
        $oficinaMadre = $resource->oficinaMadre()->getResults();
        
        return [
            'id'                   => $this->id,
            'nombre'               => $this->nombre,
            'oficina_madre_id'     => $this->oficina_madre_id,
            'oficina_madre_nombre' => $this->obtenerNombre($oficinaMadre),
        ];
    }
    
    /**
     *
     * @param Oficina $oficina
     * @return string
     */
    public function obtenerNombre(?Oficina $oficina): string
    {
        $oficinaMadreNombre = '';
        if ($oficina) {
            $oficinaMadreNombre = $oficina->nombre;
        }
        return $oficinaMadreNombre;
    }
}
