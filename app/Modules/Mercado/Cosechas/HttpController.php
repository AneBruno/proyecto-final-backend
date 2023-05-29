<?php

namespace App\Modules\Mercado\Cosechas;

use App\Helpers\HttpRequestHelper;
use App\Http\Controllers\Controller;
use App\Modules\Usuarios\Roles\RolHelper;
use App\Modules\Usuarios\Usuarios\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use \Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Kodear\Laravel\Repository\Exceptions\RepositoryException;

class HttpController extends Controller
{
    protected CosechasService $service;

    /**
     * HttpController constructor.
     * @param CosechasService $service
     */
    public function __construct(CosechasService $service)
    {
        $this->service = $service;
    }

    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        /** @var User $user */
        $user = $request->user();

        $opciones['with_relation'] = HttpRequestHelper::getModelRelation($request);

        $archivos = $this->service->listar(
            $user,
            $request->input('page' ,    1),
            $request->input('limit',    0),
            $request->input('filtros', []),
            $request->input('ordenes', []),
            $opciones
        );

        return CosechaResource::collection($archivos);
    }

    /**
     * @param Request $request
     * @param Cosecha $cosecha
     * @return CosechaResource
     * @throws RepositoryException
     */
    public function show(Request $request, Cosecha $cosecha)
    {
        $opciones['with_relation'] = HttpRequestHelper::getModelRelation($request);

        /** @var Cosecha $cosecha */
        $cosecha = $this->service->getOne($cosecha, $opciones);

        return new CosechaResource($cosecha);
    }

    /**
     * @param CosechaRequest $request
     * @return CosechaResource
     * @throws RepositoryException
     */
    public function store(CosechaRequest $request): CosechaResource
    {
        $this->authorize('anyAction', Cosecha::class);

        /** @var User $usuario */
        $user = $request->user();

        $data = $request->only(['descripcion']);

        $orden = $this->service->crear($user, $data);

        return new CosechaResource($orden);
    }

    /**
     * @param CosechaRequest $request
     * @param Cosecha $cosecha
     * @return CosechaResource
     * @throws RepositoryException
     */
    public function update(CosechaRequest $request, Cosecha $cosecha): CosechaResource
    {
        $this->authorize('anyAction', Cosecha::class);

        $data = $request->only([
            'descripcion',
            'habilitado'
        ]);

        $cosecha = $this->service->actualizar($cosecha, $data);

        return new CosechaResource($cosecha);
    }
}
