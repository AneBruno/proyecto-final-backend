<?php

namespace App\Modules\Clientes\Empresas\Archivos;

use App\Modules\Clientes\Empresas\EmpresaResource;
use App\Modules\Clientes\Empresas\TiposArchivos\TipoArchivoResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\URL;

class ArchivoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $urlArchivoFirmada = URL::signedRoute('clientesEmpresasArchivosDescarga', [
            'empresa' => $this->empresa_id,
            'archivo' => $this->id,
        ]);
        
        return [
            'id'                => $this->id,
            'empresa_id'        => $this->empresa_id,
            'empresa'           => new EmpresaResource($this->whenLoaded('empresa')),
            'archivo'           => $urlArchivoFirmada,
            'fecha_vencimiento' => $this->fecha_vencimiento,
            'tipo_archivo_id'   => $this->tipo_archivo_id,
            'tipo_archivo'      => new TipoArchivoResource($this->whenLoaded('tipoArchivo')),
            'created_at'        => $this->created_at,
        ];
    }
}
