<?php

/*namespace App\Modules\GestionDeSaldos\Cbus;

use App\Http\Controllers\Controller;
use App\Modules\GestionDeSaldos\Cbus\CbuResource;
use App\Modules\GestionDeSaldos\Cbus\CbusService;
use App\Modules\GestionDeSaldos\Cbus\Requests\AgregarCbuRequest;
use Illuminate\Http\Request;

class HttpController extends Controller {
    
    public function store(AgregarCbuRequest $request) {
        $token = $request->get('token');
        $cuit = $request->get('cuit');
        $mail = $request->get('mail');
        $banco = $request->get('banco');
        $cbu = $request->get('cbu');
        
        $cbu  = CbusService::agregar(
            $token, 
            $cuit, 
            $mail, 
            $banco, 
            $cbu,
        );
        
        return $this->json($cbu);
    }
    
    public function index(Request $request) {
        $token = $request->get('token');
        $page = $request->get('page', 1);
        $limit = $request->get('limit', 10);
        $filtros = $request->get('filtros', []);
        $ordenes = $request->get('ordenes', []);
        $opciones = $request->get('opciones', []);
        
        $rs = CbusService::listarPor($token, $page, $limit, $filtros, $ordenes, $opciones);
        return CbuResource::collection($rs);
    }
    
    public function listarEmpresas(Request $request) {
        $page     = $request->get('page', 1);
        $limit    = $request->get('limit', 50);
        $filtros  = $request->get('filtros', []);
        $ordenes  = $request->get('ordenes', []);
        $opciones = $request->get('opciones', []);
        $rs = Empresa::listar($page, $limit, $filtros, $ordenes, $opciones);
        return EmpresaResource::collection($rs);
    }

    public function show(int $id, Request $request) {
        $cbu = CbusService::getById($id);
        $resource = new CbuResource($cbu);
        
        return $resource;
    }

    public function estadoProcesado(int $id, Request $request) {
        $cbu = CbusService::getById($id);

        $cbu = CbusService::estadoProcesado($cbu);

        return new CbuResource($cbu);
    }
}
*/