<?php

namespace App\Modules\Clientes\Categorias;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoriaClienteResource extends JsonResource
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
            'nombre'     => $this->nombre,
            'perfil'     => $this->perfil,
            'habilitado' => (bool) $this->resource->deleted_at == null,
        ];
    }
}
