<?php

namespace App\Modules\Clientes\Eventos;

use App\Modules\Clientes\Contactos\ContactoResource;
use App\Modules\Clientes\Empresas\EmpresaResource;
use App\Modules\Clientes\Eventos\Archivos\ArchivoResource;
use App\Modules\Clientes\TiposEvento\TipoEventoResource;
use App\Modules\Mercado\Ordenes\OrdenesResource;
use App\Modules\Usuarios\Usuarios\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventoResource extends JsonResource
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
            'id'                 => $this->id,
            'tipo_evento_id'     => $this->tipo_evento_id,
            'tipo_evento'        => new TipoEventoResource($this->whenLoaded('tipoEvento'    )),
            'usuario_creador'    => new UserResource      ($this->whenLoaded('usuarioCreador')),
            'usuario_creador_id' => $this->usuario_creador_id,
            'titulo'             => $this->titulo,
            'descripcion'        => $this->descripcion,
            'resolucion'         => $this->resolucion,
            'fecha_vencimiento'  => $this->fecha_vencimiento,
            'fecha_alerta_1'     => $this->fecha_alerta_1,
            'fecha_alerta_2'     => $this->fecha_alerta_2,
            'estado'             => $this->estado,
            'contactos'          => ContactoResource ::collection($this->whenLoaded('contactos'   )),
            'empresas'           => EmpresaResource  ::collection($this->whenLoaded('empresas'    )),
            'ordenes'            => OrdenesResource  ::collection($this->whenLoaded('ordenes'     )),
            'responsables'       => UserResource     ::collection($this->whenLoaded('responsables')),
            'archivos'           => ArchivoResource  ::collection($this->whenLoaded('archivos'    )),
            'puedeEditar'        => EventosService   ::puedeEditar($request->user(), $this->resource),
            'created_at'         => $this->created_at,
            'updated_at'         => $this->updated_at,
        ];
    }
}
