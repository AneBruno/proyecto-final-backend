<?php

namespace App\Modules\GestionDeSaldos\Cbus;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CbuResource extends JsonResource
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
            'id' => $this->id,
            'cuit' => $this->cuit,
            'razon_social' => $this->razon_social,
            'cbu' => $this->cbu,
            'banco'=> $this->banco,
            'mail' => $this->mail,
            'estado' => $this->estado,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
            'usuario_solicitante' => $this->usuario_solicitante,
        ];
    }
}
