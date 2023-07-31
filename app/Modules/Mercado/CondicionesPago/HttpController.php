<?php

namespace App\Modules\Mercado\CondicionesPago;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class HttpController extends Controller
{
    private $condicionesService;
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
     * @param CondicionesPagoRequest $request
     * @param CondicionPago $condicion
     * @return CondicionesPagoResource
     * @throws RepositoryException
     */
    public function update(CondicionesPagoRequest $request, CondicionPago $condicion): CondicionesPagoResource
    {
        $this->authorize('anyAction', CondicionPago::class);

        $data = $request->only([
            'descripcion',
            'habilitado'
        ]);

        $condicion = $this->service->actualizar($condicion, $data);

        return new CondicionesPagoResource($condicion);
    }

    public function habilitar(CondicionPago $condicion)
    {
        $this->authorize('anyAction', CondicionPago::class);

        $condicion = CondicionesPagoService::habilitar($condicion->getKey());
        return $this->json($condicion);
    }

    public function deshabilitar(CondicionPago $condicion) {
        $this->authorize('anyAction', CondicionPago::class);
        $condicion = CondicionesPagoService::deshabilitar($condicion->getKey());
        return $this->json($condicion);
    }

}
