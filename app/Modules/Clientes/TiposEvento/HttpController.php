<?php
/*
namespace App\Modules\Clientes\TiposEvento;

use App\Helpers\HttpRequestHelper;
use App\Http\Controllers\Controller;
use \Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Kodear\Laravel\Repository\Exceptions\RepositoryException;

class HttpController extends Controller
{
    protected TiposEventosService $service;

    /**
     * HttpController constructor.
     * @param TiposEventosService $service
     *
    public function __construct(TiposEventosService $service)
    {
        $this->service = $service;
    }

    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     *
    public function index(Request $request)
    {
        $opciones['with_relation'] = HttpRequestHelper::getModelRelation($request);

        $tiposEventos = $this->service->listar(
            $request->input('page' ,    1),
            $request->input('limit',    0),
            $request->input('filtros', []),
            $request->input('ordenes', []),
            $opciones
        );

        return TipoEventoResource::collection($tiposEventos);
    }

    /**
     * @param int $id
     * @return TipoEventoResource
     * @throws RepositoryException
     *
    public function show(int $id)
    {
        $tipoEvento = $this->service->getOne($id);

        return new TipoEventoResource($tipoEvento);
    }

    /**
     * @param CrearTipoEventoRequest $request
     * @return TipoEventoResource
     * @throws AuthorizationException
     * @throws RepositoryException
     *
    public function store(CrearTipoEventoRequest $request)
    {
        $this->authorize('create', TipoEvento::class);

        $tipoEvento = $this->service->crear(
            $request->get('nombre'                ), 
            $request->get('cantidad_dias_alerta_1'),
            $request->get('cantidad_dias_alerta_2')
        );

        return new TipoEventoResource($tipoEvento);
    }

    /**
     * @param TipoEvento $tipoEvento
     * @param ActualizarTipoEventoRequest $request
     * @return TipoEventoResource
     * @throws AuthorizationException
     * @throws RepositoryException
     *
    public function update($id, ActualizarTipoEventoRequest $request)
    {
        $this->authorize('update', TipoEvento::class);

        $tipoEvento = $this->service->actualizar(
            $id, 
            $request->get('nombre'                ), 
            $request->get('cantidad_dias_alerta_1'),
            $request->get('cantidad_dias_alerta_2')
        );

        return new TipoEventoResource($tipoEvento);
    }

    /**
     * @param TipoEvento $tipoEvento
     * @return TipoEventoResource
     * @throws AuthorizationException
     * @throws RepositoryException
     *
    public function habilitar(TipoEvento $tipoEvento)
    {
        $this->authorize('habilitar', TipoEvento::class);

        $tipoEvento = $this->service->habilitar($tipoEvento);

        return new TipoEventoResource($tipoEvento);
    }

    /**
     * @param TipoEvento $tipoEvento
     * @return TipoEventoResource
     * @throws AuthorizationException
     * @throws RepositoryException
     *
    public function deshabilitar(TipoEvento $tipoEvento)
    {
        $this->authorize('deshabilitar', TipoEvento::class);

        $tipoEvento = $this->service->deshabilitar($tipoEvento);

        return new TipoEventoResource($tipoEvento);
    }
}
*/