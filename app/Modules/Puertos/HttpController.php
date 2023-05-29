<?php

namespace App\Modules\Puertos;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Geo\PlacesRepository;
use Illuminate\Http\Resources\Json\JsonResource;

class HttpController extends Controller
{

    public function index(Request $request)
    {
        $collection = PuertosService::listar(
            $request->get('page' ,    0),
            $request->get('limit'  , 10),
            $request->get('filtros', []),
        );

        return JsonResource::collection($collection);
    }

    public function show(int $id, Request $request)
    {
        $row = PuertosService::getById($id);
        return $this->json($row);
    }

    public function store(PuertosRequest $request)
    {
        $row = PuertosService::crear(
            $request->input('nombre'  ),
            $request->input('terminal'),
            $request->input('placeId' ),
            $request->input('descripcion_ubicacion')
        );

        return $this->json($row);
    }

    public function update(int $id, PuertosRequest $request)
    {
        $row = PuertosService::actualizar(
            $id,
            $request->input('nombre'  ),
            $request->input('terminal'),
            $request->input('placeId' ),
            $request->input('descripcion_ubicacion')
        );

        return $this->json($row);
    }

    public function destroy(int $id)
    {
        return PuertosService::borrar($id);
    }

    /**
     * @param CambiarEstadoPuertoRequest $request
     * @param Puerto $puerto
     * @return JsonResource
     * @throws Exception
     */
    public function  cambiarEstado(CambiarEstadoPuertoRequest $request, Puerto $puerto)
    {
        $estado = $request->get('estado');

        $puerto = PuertosService::cambiarEstado($puerto, $estado);

        return $this->json($puerto);
    }

    public function buscarUbicacion(Request $request) {
        return PlacesRepository::buscarUbicacion($request->get('text'));
    }

    public function obtenerDetalles(string $id) {
        return new JsonResource(PlacesRepository::obtenerDetalles($id));
    }
}
