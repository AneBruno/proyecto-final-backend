<?php

namespace App\Modules\GestionDeSaldos;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EstadoSolicitudResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [      
            'id'             => $this->id,
            'descripcion'    => $this->descripcion,
        ];
    }
}
