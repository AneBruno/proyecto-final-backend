<?php

namespace App\Modules\Clientes\Establecimientos;

use App\Modules\Clientes\Empresas\EmpresaResource;
use App\Modules\Puertos\PuertosResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class EstablecimientoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        /** @var Establecimiento $establecimiento */
        $establecimiento = $this->resource;

        return [
            'id' => $establecimiento->getKey(),
            'empresa_id' => $establecimiento->establecimiento_id,
            'empresa' => new EmpresaResource($this->whenLoaded('empresa')),
            'puerto_id' => $establecimiento->puerto_id,
            'puerto' => new PuertosResource($this->whenLoaded('puerto')),
            'nombre' => $establecimiento->nombre,
            'tipo' => $establecimiento->tipo,
            'propio' => $establecimiento->propio,
            'hectareas_agricolas' => $establecimiento->hectareas_agricolas,
            'hectareas_ganaderas' => $establecimiento->hectareas_ganaderas,
            'capacidad_acopio' => $establecimiento->capacidad_acopio,
            'latitud' => $establecimiento->latitud,
            'longitud' => $establecimiento->longitud,
            'codigo_postal' => $establecimiento->codigo_postal,
            'direccion' => $establecimiento->direccion,
            'localidad' => $establecimiento->localidad,
            'departamento' => $establecimiento->departamento,
            'provincia' => $establecimiento->provincia,
            'created_at' => $establecimiento->created_at,
            'updated_at' => $establecimiento->updated_at,
            'deleted_at' => $establecimiento->deleted_at,
            'descripcion_ubicacion' => $establecimiento->descripcion_ubicacion
        ];
    }
}
