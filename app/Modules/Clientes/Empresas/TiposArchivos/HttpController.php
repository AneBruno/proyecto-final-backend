<?php
/*
namespace App\Modules\Clientes\Empresas\TiposArchivos;

use App\Http\Controllers\Controller;
use App\Modules\Clientes\Empresas\Empresa;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class HttpController extends Controller
{

    /**
     * @param Request $request
     * @param Empresa $empresa
     * @return AnonymousResourceCollection
     * @throws AuthorizationException
     *
    public function index(Request $request)
    {
        $rs = TipoArchivo::listar(
            $request->get('page'   ,  1 ),
            $request->get('limit'  ,  10),
            $request->get('filtros',  []),
            $request->get('ordenes',  []),
            $request->get('opciones', []),
        );
        
        return TipoArchivoResource::collection($rs);
    }

}
*/