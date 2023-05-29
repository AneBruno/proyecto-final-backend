<?php

namespace App\Modules\Mercado\Posiciones;

use App\Modules\Clientes\Empresas\EmpresaResource;
use App\Modules\Mercado\Cosechas\CosechaResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PosicionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        /** @var Posicion $posicion */
        $posicion = $this->resource;

        $data = [
            'id'                    => $posicion->getKey(),
            'producto_id'           => $posicion->getAttribute('producto_id'),
            'producto'              => $posicion->producto,
            'calidad_id'            => $posicion->getAttribute('calidad_id'),
            'calidad_observaciones' => $posicion->getAttribute('calidad_observaciones'),
            'calidad'               => $posicion->calidad,
            'fecha_entrega_inicio'  => $posicion->getAttribute('fecha_entrega_inicio'),
            'fecha_entrega_fin'     => $posicion->getAttribute('fecha_entrega_fin'),
            'empresa_id'            => $posicion->getAttribute('empresa_id'),
            'empresa'               => new EmpresaResource($this->whenLoaded('empresa')),
            'usuario_carga_id'      => $posicion->getAttribute('usuario_carga_id'),
            'puerto_id'             => $posicion->getAttribute('puerto_id'),
            'establecimiento_id'    => $posicion->getAttribute('establecimiento_id'),
            'puerto'                => $posicion->puerto,
            'establecimiento'       => $posicion->establecimiento,
            'moneda'                => $posicion->getAttribute('moneda'),
            'precio'                => $posicion->getAttribute('precio'),
            'condicion_pago_id'     => $posicion->getAttribute('condicion_pago_id'),
            'condicion_pago'        => $posicion->condicionPago,
            'posicion_excepcional'  => $posicion->getAttribute('posicion_excepcional'),
            'volumen_limitado'      => $posicion->getAttribute('volumen_limitado'),
            'a_trabajar'            => $posicion->getAttribute('a_trabajar'),
            'cosecha_id'            => $posicion->getAttribute('cosecha_id'),
            'cosecha'               => new CosechaResource($this->whenLoaded('cosecha')),
            'observaciones'         => $posicion->getAttribute('observaciones'),
            'entrega'               => $posicion->getAttribute('entrega'),
            'estado'                => $posicion->getAttribute('estado'),
            'a_fijar'               => $posicion->getAttribute('a_fijar'),
            'localidad_destino'     => $posicion->getAttribute('localidad_destino'),
            'departamento_destino'  => $posicion->getAttribute('departamento_destino'),
            'provincia_destino'     => $posicion->getAttribute('provincia_destino'),
            'latitud_destino'       => $posicion->getAttribute('latitud_destino'),
            'longitud_destino'      => $posicion->getAttribute('longitud_destino'),
            'created_at'            => $posicion->getAttributeValue('created_at'),
            'deleted_at'            => $posicion->getAttribute('deleted_at')
        ];

        return $data;
    }
}
