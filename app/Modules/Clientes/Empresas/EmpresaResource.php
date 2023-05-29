<?php

namespace App\Modules\Clientes\Empresas;

use Illuminate\Http\Resources\Json\JsonResource;

class EmpresaResource extends JsonResource
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
            'id'         => $this->id,
            'razon_social' => $this->razon_social,
            'perfil'     => $this->perfil,
            'habilitado' => (bool) $this->resource->deleted_at == null,
            'abreviacion' => $this->abreviacion
        ];
    }
}
