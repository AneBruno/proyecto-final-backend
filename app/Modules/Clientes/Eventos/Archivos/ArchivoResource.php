<?php

namespace App\Modules\Clientes\Eventos\Archivos;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;

class ArchivoResource extends JsonResource {

    public function toArray($request) {
        $urlArchivoFirmada = URL::signedRoute('eventosArchivosDescarga', [
            'archivo' => $this->id,
        ]);

        return [
            'id'     => $this->id,
            'nombre' => $this->nombre,
            'url'    => $urlArchivoFirmada,
        ];
    }
}
