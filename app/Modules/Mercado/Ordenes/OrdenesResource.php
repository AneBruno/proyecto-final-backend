<?php

namespace App\Modules\Mercado\Ordenes;

use App\Modules\Clientes\Empresas\EmpresaResource;
use App\Modules\Clientes\Establecimientos\EstablecimientoResource;
use App\Modules\Mercado\CondicionesPago\CondicionesPagoResource;
use App\Modules\Mercado\Ordenes\Estado\OrdenEstadoResource;
use App\Modules\Mercado\Posiciones\PosicionResource;
use App\Modules\Productos\Productos\ProductoResource;
use App\Modules\Productos\Calidades\CalidadResource;
use App\Modules\Puertos\PuertosResource;
use App\Modules\Usuarios\Usuarios\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrdenesResource extends JsonResource
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

        return [
            'id'                       => $orden->getKey(),
            'empresa_id'               => $orden->empresa_id,
            'empresa'                  => new EmpresaResource($this->whenLoaded('empresa')),
            'producto_id'              => $orden->producto_id,
            'producto'                 => new ProductoResource($this->whenLoaded('producto')),
            'calidad_id'               => $orden->calidad_id,
            'calidad'                  => new CalidadResource($this->whenLoaded('calidad')),
            'puerto_id'                => $orden->puerto_id,
            'puerto'                   => new PuertosResource($this->whenLoaded('puerto')),
            'establecimiento_id'       => $orden->establecimiento_id,
            'establecimiento'          => new EstablecimientoResource($this->whenLoaded('establecimiento')),
            'condicion_pago_id'        => $orden->condicion_pago_id,
            'condicion_pago'           => new CondicionesPagoResource($this->whenLoaded('condicionPago')),
            'moneda'                   => $orden->moneda,
            'precio'                   => $orden->precio,
            'volumen'                  => $orden->volumen,
            'fecha_entrega_inicio'     => $orden->fecha_entrega_inicio,
            'fecha_entrega_fin'        => $orden->fecha_entrega_fin,
            'observaciones'            => $orden->observaciones,
            'usuario_carga_id'         => $orden->usuario_carga_id,
            'usuario_carga'            => new UserResource($this->whenLoaded('usuarioCarga')),
            'estado_id'                => $orden->estado_id,
            'estado'                   => new OrdenEstadoResource($this->whenLoaded('estado')),
            'posicion_id'              => $orden->posicion_id,
            'posicion'                 => new PosicionResource($this->whenLoaded('posicion')),
            'entrega'                  => $orden->entrega,
            'precio_cierre_slip'       => $orden->precio_cierre_slip,
            'localidad_destino'        => $orden->localidad_destino,
            'departamento_destino'     => $orden->departamento_destino,
            'provincia_destino'        => $orden->provincia_destino,
            'latitud_destino'          => $orden->latitud_destino,
            'longitud_destino'         => $orden->longitud_destino,
            'localidad_procedencia'    => $orden->localidad_procedencia,
            'departamento_procedencia' => $orden->departamento_procedencia,
            'provincia_procedencia'    => $orden->provincia_procedencia,
            'latitud_procedencia'      => $orden->latitud_procedencia,
            'longitud_procedencia'     => $orden->longitud_procedencia,
            'created_at'               => $orden->created_at,
            'updated_at'               => $orden->updated_at
        ];
    }
}
