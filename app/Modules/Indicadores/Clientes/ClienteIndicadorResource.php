<?php

namespace App\Modules\Indicadores\Clientes;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClienteIndicadorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        /** @var Cliente $cliente */
        $cliente = $this->resource;

        return [
            'id'                    => $cliente->id,
            'cuit'                  => $cliente->cuit,
            'razon_social'          => $cliente->razon_social,
            'Total'                 => $cliente->Total,
            'Cerrada'               =>$cliente->Cerrada,
            'Eliminada'             =>$cliente->Eliminada,
            'Activa'                => $cliente->Activa,
            'periodo'               =>$cliente->periodo
            //'porcentaje_compras_cerradas' =>$cliente->porcentaje_compras_cerradas
        ];
    }
}
