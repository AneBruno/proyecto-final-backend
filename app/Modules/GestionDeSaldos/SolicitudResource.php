<?php

namespace App\Modules\GestionDeSaldos;

use Illuminate\Http\Request;
use App\Modules\GestionDeSaldos\EstadoSolicitudResource;
use Illuminate\Http\Resources\Json\JsonResource;

class SolicitudResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [

            'id'             => $this->id,
            'cuit'           => $this->cuit,
            'razon_social'   => $this->razon_social,
            'nombre_usuario' => $this->nombre_usuario,
            'usuario_rol_id' => $this->usuario_rol_id,
            'tipo'           => $this->tipo,
            'estado_id'      => $this->estado_id,
            'estado'         => $this->estadoSolicitud,
            'updated_at'     => $this->updated_at,
            'created_at'     => $this->created_at,
            'monto_total'    => $this->monto_total,
            'formas_pago'    => SolicitudFormaPagoResource::collection($this->formasPago),
            'observaciones'  => $this->observaciones,
            'created_at'     => $this->created_at,
            'updated_at'     => $this->updated_at,
        ];
    }
}
