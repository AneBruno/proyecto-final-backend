<?php

/*namespace App\Modules\Clientes\Actividades;

use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class HttpController extends Controller {
    
    public function index(Request $request) {
        $collection = ActividadesService::listar(
            $request->get('page'   , 1 ), 
            $request->get('limit'  , 10),
            $request->get('filtros', []),
        );
        $resources = JsonResource::collection($collection);
        
        return $resources;
    }
    
    public function show(int $id, Request $request) {
        $row = ActividadesService::getById($id);
        return new JsonResource($row);
    }
    
    public function store(Request $request) {
        $nombre = $request->input('nombre');
        $row    = ActividadesService::crear($nombre);
        return new JsonResource($row);
    }
    
    public function update(int $id, Request $request) {
        $id     = $request->input('id'    );
        $nombre = $request->input('nombre');
        $row    = ActividadesService::actualizar($id, $nombre);
        return new JsonResource($row);
    }
    
    public function habilitar(int $id) {
        $row = ActividadesService::habilitar($id);
        return new JsonResource($row);
    }
    
    public function destroy(int $id) {
        ActividadesService::borrar($id);
        return true;
    }
}
*/