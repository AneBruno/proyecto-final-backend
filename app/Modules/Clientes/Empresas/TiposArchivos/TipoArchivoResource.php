<?php

namespace App\Modules\Clientes\Empresas\TiposArchivos;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TipoArchivoResource extends JsonResource
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
            'id'         => $this->id,
            'descripcion' => $this->descripcion
        ];
    }
}
