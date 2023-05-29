<?php

namespace App\Modules\Mercado\CondicionesPago;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class HttpController extends Controller
{

    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $collection = CondicionesPagoService::listar(
            $request->get('page' ,    0),
            $request->get('limit'  , 10),
            $request->get('filtros', [])
        );

        return JsonResource::collection($collection);
    }

    /**
     * @param int $id
     * @param Request $request
     * @return CondicionesPagoResource
     */
    public function show(int $id, Request $request)
    {
        $this->authorize('anyAction', CondicionPago::class);
        
        $row = CondicionesPagoService::getById($id);
        return new CondicionesPagoResource($row);
    }

    /**
     * @param CondicionesPagoRequest $request
     * @return CondicionesPagoResource
     */
    public function store(CondicionesPagoRequest $request)
    {
        $this->authorize('anyAction', CondicionPago::class);
        
        $row = CondicionesPagoService::crear(
            $request->input('descripcion')
        );

        return new CondicionesPagoResource($row);
    }

    /**
     * @param int $id
     * @param CondicionesPagoRequest $request
     * @return CondicionesPagoResource
     */
    public function update(int $id, CondicionesPagoRequest $request)
    {
        $this->authorize('anyAction', CondicionPago::class);
        
        $row = CondicionesPagoService::actualizar(
            $id,
            $request->input('descripcion')
        );

        return new CondicionesPagoResource($row);
    }

    /**
     * @param int $id
     */
    public function destroy(int $id)
    {
        $this->authorize('anyAction', CondicionPago::class);
        
        CondicionesPagoService::borrar($id);
        return $this->json([]);
    }
}
