<?php

namespace App\Modules\Clientes\Categorias;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HttpController extends Controller
{
    
    public function index(Request $request)
    {
        $collection = CategoriasClienteService::listar(
            $request->get('page'   , 1 ), 
            $request->get('limit'  , 10),
            $request->get('filtros', []),
        );
        $resources = CategoriaClienteResource::collection($collection);
        
        return $resources;
    }
    
    public function show(int $id, Request $request)
    {
        $categoria = CategoriasClienteService::getById($id);
        $resource = new CategoriaClienteResource($categoria);
        
        return $resource;
    }
    
    public function store(CategoriasClienteRequest $request)
    {
        $nombre    = $request->input('nombre');
        $perfil    = $request->input('perfil');
        $categoria = CategoriasClienteService::crear($nombre, $perfil);
        $resource  = new CategoriaClienteResource($categoria);

        return $resource;
    }
    
    public function update(int $id, CategoriasClienteRequest $request)
    {
        $id        = $request->input('id'    );
        $nombre    = $request->input('nombre');
        $perfil    = $request->input('perfil');
        $categoria = CategoriasClienteService::actualizar($id, $nombre, $perfil);
        $resource  = new CategoriaClienteResource($categoria);
        
        return $resource;
    }
    
    public function habilitar(int $id) {
        $categoria = CategoriasClienteService::habilitar($id);
    }
    
    public function destroy(int $id)
    {
        return CategoriasClienteService::borrar($id);
    }
}
