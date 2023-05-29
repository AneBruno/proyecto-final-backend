<?php

namespace App\Modules\Clientes\RedesSociales;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RedSocialResource extends JsonResource
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
            'id' => $this->resource->id,
            'contacto_id' => $this->resource->contacto_id,
            'red' => $this->resource->red,
            'url' => $this->resource->url
        ];
    }
}
