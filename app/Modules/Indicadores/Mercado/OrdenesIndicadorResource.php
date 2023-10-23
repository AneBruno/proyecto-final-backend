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
        $porcentajeConfirmada = $orden->Confirmada > 0 ? ((($orden->Confirmada)*100) / ($orden->Total))  : '0';
        $porcentajeEliminada = $orden->Eliminada > 0 ? ((($orden->Eliminada) * 100) / ($orden->Total)) : '0';
        $porcentajeActiva = $orden->Activa > 0 ? ((($orden->Activa) * 100) / ($orden->Total)): '0';
    
        // Formatear los porcentajes a dos decimales
        $porcentajeConfirmada = number_format($porcentajeConfirmada, 2);
        $porcentajeEliminada = number_format($porcentajeEliminada, 2);
        $porcentajeActiva = number_format($porcentajeActiva, 2);

        return [
            'periodo' => $orden->periodo,
            'Total' => $orden->Total,
            'Activa' => $orden->Activa,
            'Confirmada' => $orden->Confirmada,
            'Eliminada' => $orden->Eliminada,
            'porcentaje_confirmada' => $porcentajeConfirmada,
            'porcentaje_eliminada' => $porcentajeEliminada,
            'porcentaje_activa'=> $porcentajeActiva,
            
        ];
    }
}
