<?php
/*
namespace App\Modules\Oficinas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HttpController extends Controller
{
    private $oficinasService;
    
    public function __construct(OficinasService $oficinas)
    {
        $this->oficinasService = $oficinas;
    }
    
    public function index(Request $request)
    {
        $collection = $this->oficinasService->listar(
            $request->get('page' ,    0),
            $request->get('limit'  , 10),
            $request->get('filtros', []),
        );
        $resources = OficinaResource::collection($collection);
        
        return $resources;
    }
    
    public function show(int $id, Request $request)
    {
        $oficina = $this->oficinasService->getById($id);
        $resource = new OficinaResource($oficina);
        
        return $resource;
    }
    
    public function store(CrearRequest $request)
    {
        $nombre = $request->input('nombre');
        $oficina_madre_id = $request->input('oficina_madre_id', null);
        $oficina = $this->oficinasService->crear($nombre, $oficina_madre_id);
        $resource = new OficinaResource($oficina);

        return $resource;
    }
    
    public function update(int $id, ActualizarRequest $request)
    {
        $nombre = $request->input('nombre');
        $oficina_madre_id = $request->input('oficina_madre_id', null);
        $oficina = $this->oficinasService->actualizar($id, $nombre, $oficina_madre_id);
        $resource = new OficinaResource($oficina);
        
        return $resource;
    }
    
    public function destroy(int $id)
    {
        return $this->oficinasService->borrar($id);
    }
}
*/