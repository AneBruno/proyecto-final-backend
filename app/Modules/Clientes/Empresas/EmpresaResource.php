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
            'id'         => $this->id,
            'razon_social' => $this->razon_social,
            'comercial_asignado' => new UserResource($this->resource->comercial_asignado),
            'perfil'     => $this->perfil,
            'habilitado' => (bool) $this->resource->habilitada == null
        ];
    }
}
