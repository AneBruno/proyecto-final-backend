<?php

namespace App\Modules\Productos\TiposProducto;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HttpController extends Controller
{
    private $tiposProductosService;

    public function __construct(TiposProductoService $productos)
    {
        $this->tiposProductosService = $productos;
    }

    public function index(Request $request)
    {
        $collection = $this->tiposProductosService->listar(
            $request->get('page' ,    0),
            $request->get('limit'  , 10),
            $request->get('filtros', []),
        );

        $resources = TipoProductoResource::collection($collection);

        return $resources;
    }

    public function show(int $id) {
        return $this->json(TipoProducto::getById($id));
    }

    public function store(Request $request) {
        $nombre = $this->input('nombre', ['required','string']);
        $row = TipoProducto::crear($nombre);
        return $this->json($row);
    }

    public function update(int $id, Request $request) {
        $row = TipoProducto::getById($id)->actualizar($this->input('nombre', ['required','string']));
        return $this->json($row);
    }

    /*public function destroy(TipoProducto $tipos_producto) {
        $this->tiposProductosService->eliminar($tipos_producto);
        return $this->json([]);
    }*/

    public function habilitar(TipoProducto $tipo)
    {
        //$this->authorize('anyAction', TipoProducto::class);
        $tipo = TiposProductoService::habilitar($tipo->getKey());
        return $this->json($tipo);
    }

    public function deshabilitar(TipoProducto $tipo) {
       // $this->authorize('anyAction', TipoProducto::class);
        $tipo = TiposProductoService::deshabilitar($tipo->getKey());
        return $this->json($tipo);
    }
}
