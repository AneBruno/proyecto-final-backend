<?php

namespace App\Modules\Clientes\Empresas;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Modules\Usuarios\Usuarios\UserResource;


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
            'id'         => $this->resource->id,
            'cuit' => $this->resource->cuit,
            'razon_social' => $this->resource->razon_social,
            'telefono'=> $this->resource->telefono,
            'comercial_asignado' => new UserResource($this->whenLoaded('usuarioComercial')),
            'perfil'     => $this->resource->perfil,
            'habilitado' => (bool) $this->resource->habilitada == null
        ];
    }
}
