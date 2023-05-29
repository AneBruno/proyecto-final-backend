<?php

namespace App\Modules\Clientes\TiposEvento;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TipoEventoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'                     => $this->id,
            'nombre'                 => $this->nombre,
            'cantidad_dias_alerta_1' => $this->cantidad_dias_alerta_1,
            'cantidad_dias_alerta_2' => $this->cantidad_dias_alerta_2,
            'habilitado'             => $this->habilitado,
            'created_at'             => $this->created_at,
            'updated_at'             => $this->updated_at,
        ];
    }
}
