<?php

namespace App\Modules\Mercado\Ordenes;

use App\Helpers\HttpRequestHelper;
use App\Http\Controllers\Controller;
use App\Modules\Mercado\Ordenes\Dtos\CrearOrdenDto;
use App\Modules\Mercado\Ordenes\FormRequests\CambiarEstadoOrdenRequest;
use App\Modules\Mercado\Ordenes\FormRequests\CerrarSlipRequest;
use App\Modules\Mercado\Ordenes\FormRequests\OrdenesRequest;
use App\Modules\Usuarios\Usuarios\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use \Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Kodear\Laravel\Repository\Exceptions\RepositoryException;
use Throwable;

class HttpController extends Controller
{
    protected OrdenesService $service;

    /**
     * HttpController constructor.
     * @param OrdenesService $service
     */
    public function __construct(OrdenesService $service)
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

        return OrdenesResource::collection($archivos);
    }

    public function show(Request $request, Orden $ordene)
    {
        $opciones['with_relation'] = HttpRequestHelper::getModelRelation($request);

        /** @var Orden $orden */
        $ordene = $this->service->getOne($ordene, $opciones);

        return new OrdenesResource($ordene);
    }

    /**
     * @param OrdenesRequest $request
     * @return OrdenesResource
     */
    public function store(OrdenesRequest $request)
    {
        /** @var User $usuario */
        $user = $request->user();

        $crearOrdenDto = CrearOrdenDto::fromRequest($request);

        $orden = $this->service->crear($user, $crearOrdenDto);

        return new OrdenesResource($orden);
    }

    /**
     * @param OrdenesRequest $request
     * @param Orden $ordene
     * @return OrdenesResource
     * @throws RepositoryException
     */
    public function update(OrdenesRequest $request, Orden $ordene)
    {
        $data = $this->getRequestValues($request);

        $ordene = $this->service->actualizar($ordene, $data);

        return new OrdenesResource($ordene);
    }

    /**
     * @param Orden $ordene
     * @return JsonResponse
     * @throws AuthorizationException
     */
    public function destroy(Orden $ordene)
    {
        $this->authorize('destroy', Orden::class);

        $this->service->borrar($ordene);

        return response()->json(null, 204);
    }

    /**
     * @param CambiarEstadoOrdenRequest $request
     * @param Orden $orden
     * @return OrdenesResource
     * @throws AuthorizationException
     * @throws RepositoryException
     */
    public function cambiarEstado(CambiarEstadoOrdenRequest $request, Orden $orden)
    {
        $this->authorize('cambiarEstado', Orden::class);

        $estado = (int) $request->get('estado_id');

        $orden = $this->service->cambiarEstado($orden, $estado);

        return new OrdenesResource($orden);
    }

    /**
     * @param CerrarSlipRequest $request
     * @param Orden $orden
     * @return OrdenesResource
     * @throws RepositoryException
     * @throws Throwable
     */
    public function cerrarSlip(CerrarSlipRequest $request, Orden $orden)
    {
        $data = $request->only([
            'posicion_id',
            'precio_cierre_slip',
            'toneladas_cierre',
            'comision_vendedor_cierre',
            'comision_comprador_cierre'
        ]);
        $data_posicion = $request->only([
            'posicion_id',
            'toneladas_cierre'
        ]);

        $orden = $this->service->cerrarSlip($orden, $data, $data_posicion);

        return new OrdenesResource($orden);
    }

    public function listarLocalidades() {
    	$localidades = $this->service->listarLocalidades();

    	return new JsonResource($localidades);
	}

    /**
     * @param Request $request
     * @return array
     */
    private function getRequestValues(Request $request)
    {
        return $request->only([
            'empresa_id',
            'producto_id',
            'puerto_id',
            'condicion_pago_id',
            'moneda',
            'precio',
            'volumen',
            'estado_id',
            'observaciones'
        ]);
    }

    public function cancelarSlip(Orden $orden){
    
        $orden = $this->service->cancelarSlip($orden);

        return new OrdenesResource($orden);
    }
}