<?php
/*
namespace App\Modules\Clientes\Empresas\Archivos;

use App\Helpers\HttpRequestHelper;
use App\Http\Controllers\Controller;
use App\Modules\Clientes\Empresas\Empresa;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Kodear\Laravel\Repository\Exceptions\RepositoryException;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class HttpController extends Controller
{
    protected ArchivosService $service;

    /**
     * HttpController constructor.
     * @param ArchivosService $service
     *
    public function __construct(ArchivosService $service)
    {
        $this->service = $service;
    }

    /**
     * @param Request $request
     * @param Empresa $empresa
     * @return AnonymousResourceCollection
     * @throws AuthorizationException
     *
    public function index(Request $request, Empresa $empresa)
    {
        $this->authorize('anyAction', $empresa);

        $opciones['with_relation'] = HttpRequestHelper::getModelRelation($request);

        $archivos = $this->service->listar($empresa->getKey(),
            $request->input('page' ,    1),
            $request->input('limit',    0),
            $request->input('filtros', []),
            $request->input('ordenes', []),
            $opciones
        );
        return ArchivoResource::collection($archivos);
    }

    /**
     * @param Request $request
     * @param Empresa $empresa
     * @param Archivo $archivo
     * @return ArchivoResource
     * @throws RepositoryException
     * @throws AuthorizationException
     *
    public function show(Request $request, Empresa $empresa, Archivo $archivo)
    {
        $this->authorize('anyAction', $empresa);

        $options['with_relation'] = HttpRequestHelper::getModelRelation($request);

        /** @var Archivo $archivo 
        $archivo = $this->service->getOne($archivo->getKey(), $options);

        return new ArchivoResource($archivo);
    }

    /**
     * @param ArchivoRequest $request
     * @param Empresa $empresa
     * @return ArchivoResource
     * @throws Exception
     *
    public function store(ArchivoRequest $request, Empresa $empresa)
    {
        $this->authorize('anyAction', $empresa);

        $fechaVencimiento = $request->input('fecha_vencimiento');
        $tipoArchivoId = $request->input('tipo_archivo_id');
        $archivoAdjunto = $request->file('archivo_adjunto');

        $archivo = $this->service->create(
            $empresa->getKey(),
            $fechaVencimiento,
            $tipoArchivoId,
            $archivoAdjunto
        );

        return new ArchivoResource($archivo);
    }

    /**
     * @param ArchivoRequest $request
     * @param Empresa $empresa
     * @param Archivo $archivo
     * @return ArchivoResource
     * @throws Exception
     *
    public function update(ArchivoRequest $request, Empresa $empresa, Archivo $archivo)
    {
        $this->authorize('anyAction', $empresa);

        $archivoAdjunto   = $request->file('archivo_adjunto');
        $fechaVencimiento = $request->input('fecha_vencimiento');
        $tipoArchivoId    = $request->input('tipo_archivo_id');

        $archivo = $this->service->update($archivo, $fechaVencimiento, $tipoArchivoId, $archivoAdjunto);

        return new ArchivoResource($archivo);
    }

    /**
     * @param Empresa $empresa
     * @param Archivo $archivo
     * @return JsonResponse
     * @throws AuthorizationException
     * @throws RepositoryException
     *
    public function destroy(Empresa $empresa, Archivo $archivo)
    {
        $this->authorize('anyAction', $empresa);

        $this->service->delete($archivo->getKey());

        return response()->json(null, 204);
    }

    /**
     * @param Request $request
     * @param Empresa $empresa
     * @param Archivo $archivo
     * @return BinaryFileResponse
     *
    public function download(Request $request, Empresa $empresa, Archivo $archivo)
    {
        $rutaArchivo = $this->service->obtenerRutaArchivo($archivo->getKey());

        return response()->download($rutaArchivo);
    }

    /**
     * @param Empresa $empresa
     * @return JsonResource
     *
    public function completos(Empresa $empresa)
    {
        $resultado = $this->service->completos($empresa->getKey());

        return $this->json(['resultado' => $resultado]);
    }
}
*/