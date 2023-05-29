<?php


namespace App\Modules\Clientes\Eventos\Archivos;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class HttpController {

    public function download(Request $request, int $archivoId): BinaryFileResponse {
        
        $rutaArchivo = ArchivosService::obtenerRuta($archivoId);
        $archivo     = Archivo::getById($archivoId);
        $nombre      = $archivo->nombre;

        return response()->download($rutaArchivo, $nombre);
    }
}