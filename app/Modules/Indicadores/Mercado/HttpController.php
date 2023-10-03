<?php

namespace App\Modules\Indicadores\Mercado;

use App\Http\Controllers\Controller;
use App\Modules\Usuarios\Usuarios\User;
use \Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class HttpController extends Controller
{
    protected OrdenesIndicadorService $service;

    public function __construct(OrdenesIndicadorService $service)
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

        $archivos = $this->service->listar(
            $user,
            $request->input('page' ,    1),
            $request->input('limit',    0),
            $request->input('filtros', []),
            $request->input('ordenes', []),
        );

        return OrdenesIndicadorResource::collection($archivos);
    }
}
