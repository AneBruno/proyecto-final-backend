<?php

namespace App\Modules\GestionDeSaldos\Empresas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HttpController extends Controller {
    
    public function listarRazonesSociales(Request $request) {
        
        $token   = $request->get('token'  );
        $filtros = $request->get('filtros');
        
        return $this->jsonCollection(EmpresasService::obtenerPorUsuario($token, $filtros['busqueda']??''));
    }
}
