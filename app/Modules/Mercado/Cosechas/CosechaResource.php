<?php

namespace App\Modules\Mercado\Cosechas;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CosechaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        /** @var Cosecha $cosecha */
        $cosecha = $this->resource;

        return [
            'id' => $cosecha->id,
            'descripcion' => $cosecha->descripcion,
            'habilitado' => $cosecha->habilitado,
            'created_at' => $cosecha->created_at,
            'updated_at' => $cosecha->updated_at
        ];
    }
}
