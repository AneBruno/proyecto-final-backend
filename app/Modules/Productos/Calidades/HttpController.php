<?php

namespace App\Modules\Productos\Calidades;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HttpController extends Controller
{
    private $calidadesService;
    
    public function __construct(CalidadesService $calidades)
    {
        $this->calidadesService = $calidades;
    }
    
    public function index(Request $request)
    {
        $collection = $this->calidadesService->listar(
            $request->get('page' ,    0),
            $request->get('limit'  , 10),
            $request->get('filtros', []),
        );
        $resources = CalidadResource::collection($collection);
        
        return $resources;
    }
    
    public function show(int $id, Request $request)
    {
        $calidad = $this->calidadesService->getById($id);
        $resource = new CalidadResource($calidad);
        
        return $resource;
    }
    
    public function store(CalidadesRequest $request)
    {
        $nombre = $request->input('nombre');
        $orden = $request->input('orden');
        $calidad = $this->calidadesService->crear($nombre, $orden);
        $resource = new CalidadResource($calidad);

        return $resource;
    }
    
    public function update(int $id, CalidadesRequest $request)
    {
        $nombre = $request->input('nombre');
        $orden = $request->input('orden');
        $calidad = $this->calidadesService->actualizar($id, $nombre, $orden);
        $resource = new CalidadResource($calidad);
        
        return $resource;
    }
    
    public function destroy(int $id)
    {
        return $this->calidadesService->borrar($id);
    }
}
