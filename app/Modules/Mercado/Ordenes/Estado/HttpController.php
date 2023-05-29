<?php

namespace App\Modules\Mercado\Ordenes\Estado;

use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class HttpController extends Controller
{
    protected OrdenesEstadosService $service;

    /**
     * HttpController constructor.
     * @param OrdenesEstadosService $service
     */
    public function __construct(OrdenesEstadosService $service)
    {
        $this->service = $service;
    }

    /**
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        $estadosOrdenes = $this->service->getAll();

        return OrdenEstadoResource::collection($estadosOrdenes);
    }
}
