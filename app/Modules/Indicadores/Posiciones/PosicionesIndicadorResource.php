<?php

namespace App\Modules\Indicadores\Posiciones;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PosicionesIndicadorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        /** @var Posicion $posicion */
        $posicion = $this->resource;
        $porcentajeConfirmada = $posicion->Confirmada > 0 ? ((($posicion->Confirmada) * 100) /($posicion->Total)) : '0';
        $porcentajeEliminada = $posicion->Eliminada > 0 ? ((($posicion->Eliminada) * 100) / ($posicion->Total)) : '0';
        $porcentajeActiva = $posicion->Activa > 0 ? ((($posicion->Activa) * 100) /($posicion->Total)) : '0';

        // Formatear los porcentajes a dos decimales
        $porcentajeConfirmada = number_format($porcentajeConfirmada, 2);
        $porcentajeEliminada = number_format($porcentajeEliminada, 2);
        $porcentajeActiva = number_format($porcentajeActiva, 2);

        return [
            'periodo' => $posicion->periodo,
            'Activa' => $posicion->Activa,
            'porcentaje_activa'=> $porcentajeActiva,
            'Confirmada' => $posicion->Confirmada,
            'porcentaje_confirmada' => $porcentajeConfirmada,
            'Eliminada' => $posicion->Eliminada,
            'porcentaje_eliminada' => $porcentajeEliminada,
            'Total' => $posicion->Total
        ];
    }
}
