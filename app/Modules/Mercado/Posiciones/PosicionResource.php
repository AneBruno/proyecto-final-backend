<?php

namespace App\Modules\Mercado\Posiciones;

use App\Modules\Clientes\Empresas\EmpresaResource;
use App\Modules\Mercado\CondicionesPago\CondicionPago;
use App\Modules\Mercado\Cosechas\CosechaResource;
use App\Modules\Usuarios\Usuarios\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Modules\Mercado\CondicionesPago\CondicionesPagoResource;
use App\Modules\Puertos\PuertosResource;
use App\Modules\Productos\Productos\ProductoResource;

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
            'estado'                => $posicion->getAttribute('estado'),
            'producto_id'           => $posicion->getAttribute('producto_id'),
            'producto'              => new ProductoResource($this->whenLoaded('producto')),
            'empresa_id'            => $posicion->getAttribute('empresa_id'),
            'empresa'               => new EmpresaResource($this->whenLoaded('empresa')),
            'usuario_carga_id'      => $posicion->getAttribute('usuario_carga_id'),
            'usuario_carga'         => new UserResource($this->whenLoaded('usuarioCarga')),
            'puerto_id'             => $posicion->getAttribute('puerto_id'),
            'puerto'                => new PuertosResource($this->whenLoaded('puerto')),
            'moneda'                => $posicion->getAttribute('moneda'),
            'precio'                => $posicion->getAttribute('precio'),
            'condicion_pago_id'     => $posicion->getAttribute('condicion_pago_id'),
            'condicion_pago'        => new CondicionesPagoResource($this->whenLoaded('condicionPago')),
            'cosecha_id'            => $posicion->getAttribute('cosecha_id'),
            'cosecha'               => new CosechaResource($this->whenLoaded('cosecha')),
            'observaciones'         => $posicion->getAttribute('observaciones'),
            'localidad_destino'     => $posicion->getAttribute('localidad_destino'),
            'provincia_destino'     => $posicion->getAttribute('provincia_destino'),
            'created_at'            => $posicion->getAttributeValue('created_at'),
            'deleted_at'            => $posicion->getAttribute('deleted_at'),
            'volumen'               => $posicion->volumen,
            'toneladas_Cerradas'    => $posicion->toneladas_cerradas,
        ];

        return $data;
    }
}
