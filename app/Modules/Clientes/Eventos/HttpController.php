<?php
/*
namespace App\Modules\Clientes\Eventos;

use App\Helpers\HttpRequestHelper;
use App\Modules\Clientes\Eventos\Dtos\ActualizarEventoDto;
use App\Modules\Clientes\Eventos\Dtos\CrearEventoDto;
use App\Modules\Clientes\Eventos\FormRequests\ActualizarEventoRequest;
use App\Modules\Clientes\Eventos\FormRequests\CrearEventoRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HttpController extends Controller {

    public function index(Request $request) {
        $opciones['with_relation'] = HttpRequestHelper::getModelRelation($request);

        $opciones['with_relation'] = [
            'tipoEvento',
            'empresas',
            'responsables',
            'usuarioCreador',
        ];
        
        $eventos = EventosService::listar(
            $this->getUserId(),
            $request->input('page' ,    1),
            $request->input('limit',    0),
            $request->input('filtros', []),
            $request->input('ordenes', []),
            $opciones
        );

        return EventoResource::collection($eventos);
    }

    public function show(Request $request, int $eventoId) {
        $evento = EventosService::getById($this->getUserId(), $eventoId);
        $evento->load([
            'responsables',
            'empresas',
            'contactos',
            'ordenes',
            'ordenes.empresa',
            'ordenes.producto',
            'archivos',
            'usuarioCreador',
        ]);
        //$evento->load($opciones['with_relation']);

        return new EventoResource($evento);
    }
    
    public function store(CrearEventoRequest $request) {
        $dto            = CrearEventoDto::fromRequest($request);
        $dto->usuarioId = $this->getUserId();
        $evento         = EventosService::crear($dto);

        return new EventoResource($evento);
    }

    public function actualizar(ActualizarEventoRequest $request, int $id) {
        $dto = ActualizarEventoDto::fromRequest($request);
        $dto->id        = $id;
        $dto->usuarioId = $this->getUserId();
        $evento = EventosService::actualizar($dto);

        return new EventoResource($evento);
    }
}
*/