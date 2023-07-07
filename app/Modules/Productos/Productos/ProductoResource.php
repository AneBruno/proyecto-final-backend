<?php

namespace App\Modules\Productos\Productos;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Modules\Productos\TiposProducto\TipoProductoResource;

class ProductoResource extends JsonResource
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
            'id'            => $this->resource->id,
            'nombre'        => $this->resource->nombre,
            'tipo_producto' => new TipoProductoResource($this->resource->tipoProducto),
            //'unidad'        => $this->resource->unidad,
            //'uso_frecuente' => (bool) $this->resource->uso_frecuente,
            'habilitado'    => (bool) $this->resource->habilitado
        ];
    }
}
