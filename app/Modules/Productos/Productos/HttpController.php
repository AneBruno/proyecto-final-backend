<?php

namespace App\Modules\Productos\Productos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HttpController extends Controller
{
    private $productosService;

    public function __construct(ProductosService $productos)
    {
        $this->productosService = $productos;
    }

    public function index(Request $request)
    {
        $collection = $this->productosService->listar(
            $request->get('page' ,    0),
            $request->get('limit'  , 10),
            $request->get('filtros', []),
            $request->get('ordenes', []),
        );

        $resources = ProductoResource::collection($collection);

        return $resources;
    }

    public function show($id)
    {
        $producto = $this->productosService->getById($id);
        $resource = new ProductoResource($producto);

        return $resource;
    }

    public function store(ProductosRequest $request)
    {
        $nombre         = $request->input('nombre');
        //$tipoProductoId = $request->input('tipo_producto_id');
        $producto       = $this->productosService->crear($nombre/*, $tipoProductoId*/);
        $resource       = new ProductoResource($producto);

        return $resource;
    }

    public function update(int $id, ProductosRequest $request)
    {
        $nombre         = $request->input('nombre');
        //$tipoProductoId = $request->input('tipo_producto_id');
        $producto       = $this->productosService->actualizar($id, $nombre/*, $tipoProductoId*/);
        $resource       = new ProductoResource($producto);

        return $resource;
    }

    /**
     * @param Producto $producto
     * @return ProductoResource
     */
    public function habilitar(Producto $producto)
    {
        $producto = $this->productosService->habilitar($producto);
        return new ProductoResource($producto);
    }

    /**
     * @param Producto $producto
     * @return ProductoResource
     */
    public function deshabilitar(Producto $producto) {
        $producto = $this->productosService->deshabilitar($producto);
        return new ProductoResource($producto);
    }
}
