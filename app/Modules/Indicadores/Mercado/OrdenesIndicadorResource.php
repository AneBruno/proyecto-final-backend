<?php

namespace App\Modules\Indicadores\Mercado;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrdenesIndicadorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        /** @var Orden $orden */
        $orden = $this->resource;
        $porcentajeConfirmada = $orden->Confirmada > 0 ? (($orden->Confirmada) * ($orden->Total)) / 100 : 0;
        $porcentajeEliminada = $orden->Eliminada > 0 ? (($orden->Eliminada) * ($orden->Total)) / 100 : 0;

        return [
            'periodo' => $orden->periodo,
            'Total' => $orden->Total,
            'Activa' => $orden->Activa,
            'Confirmada' => $orden->Confirmada,
            'Eliminada' => $orden->Eliminada,
            'porcentaje_confirmada' => $porcentajeConfirmada,
            'porcentaje_eliminada' => $porcentajeEliminada
        ];
    }
}
