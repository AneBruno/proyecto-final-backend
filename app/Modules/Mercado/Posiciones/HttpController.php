<?php

namespace App\Modules\Mercado\Posiciones;

use App\Exceptions\EmailException;
use App\Helpers\HttpRequestHelper;
use App\Http\Controllers\Controller;
use App\Modules\Usuarios\Usuarios\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Kodear\Laravel\Repository\Exceptions\RepositoryException;

class HttpController extends Controller
{

    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $opciones['with_relation'] = HttpRequestHelper::getModelRelation($request);

        $collection = PosicionesService::listar(
            $request->get('page' ,    0),
            $request->get('limit'  , 10),
            $request->get('filtros', []),
            $request->get('ordenes', [
                'id' => 'DESC',
            ]),
            $opciones
        );

        return PosicionResource::collection($collection);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return PosicionResource
     * @throws RepositoryException
     */
    public function show(int $id, Request $request)
    {
        $opciones = ['with_relation' => HttpRequestHelper::getModelRelation($request)];

        $row = PosicionesService::getById($id, $opciones);

        return new PosicionResource($row);
    }

    /**
     * @param PosicionesRequest $request
     * @return PosicionResource
     * @throws RepositoryException
     */
    public function store(PosicionesRequest $request)
    {
        /** @var User $usuario_carga */
        $usuario_carga = $request->user();

        $row = PosicionesService::crear(
            $usuario_carga->getKey(),
            $request->input('producto_id'),
            $request->input('empresa_id'),
            $request->input('moneda'),
            $request->input('precio'),
            $request->input('volumen'),
            $request->input('condicion_pago_id'),
            $request->input('cosecha_id'),
            $request->input('puerto_id'),
            $request->input('observaciones'),
            $request->input('id')            
        );

        return new PosicionResource($row);
    }

    /**
     * @param PosicionesRequest $request
     * @param $id
     * @return PosicionResource
     * @throws RepositoryException
     */
    public function update(int $id, PosicionesRequest $request)
    {
        $row = PosicionesService::actualizar(
            $id,
            $request->input('producto_id'),
            $request->input('empresa_id'),
            $request->input('moneda'),
            $request->input('precio'),
            $request->input('volumen'),
            $request->input('condicion_pago_id'),
            $request->input('puerto_id'),
            $request->input('cosecha_id'),
            $request->input('observaciones')
        );

        return new PosicionResource($row);
    }

    /**
     * @param int $id
     * @return JsonResource
     * @throws RepositoryException
     */
    public function destroy(int $id)
    {
        $this->authorize('destroy', Posicion::class);

        PosicionesService::borrar($id);
        return $this->json([]);
    }

    /**
     * @param CambiarEstadoPosicionRequest $request
     * @param Posicion $posicion
     * @return PosicionResource
     * @throws AuthorizationException
     * @throws RepositoryException
     * @throws EmailException
     */
    public function cambiarEstado(CambiarEstadoPosicionRequest $request, Posicion $posicion)
    {
        $this->authorize('cambiarEstado', Posicion::class);

        /** @var User $usuario */
        $usuario = $request->user();

        $estado = $request->get('estado');

        $posicion = PosicionesService::cambiarEstado($posicion, $estado, $usuario);

        return new PosicionResource($posicion);
    }

    /**
     * @param CambiarEstadoPosicionRequest $request
     * @param Posicion $posicion
     * @return PosicionResource
     * @throws AuthorizationException
     * @throws RepositoryException
     * @throws EmailException
     */
    public function cancelarNegocio(CambiarEstadoPosicionRequest $request, Posicion $posicion){
        /** @var User $usuario */
        $usuario = $request->user();
        $estado = $request->get('estado');

        $posicion = PosicionesService::cambiarEstado($posicion, $estado, $usuario);

        return new PosicionResource($posicion);
    }
}
