<?php

namespace App\Modules\GestionDeSaldos\Cbus;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmpresaResource extends JsonResource
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
            'cuit' => $this->cuit,
            'razon_social' => $this->razon_social,
        ];
    }
}
