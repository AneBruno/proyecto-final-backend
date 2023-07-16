<?php
/*
namespace App\Modules\Clientes\Eventos\Dtos;

use App\Modules\Clientes\Eventos\Evento;
use App\Modules\Clientes\Eventos\FormRequests\CrearEventoRequest;

class ActualizarEventoDto extends CrearEventoDto
{

    public  int    $id;
    public  string $estado     = Evento::ABIERTO;
    public ?string $resolucion = null;
    
    public static function fromRequest(CrearEventoRequest $request) {
        return new self($request->validated());
    }
}
*/