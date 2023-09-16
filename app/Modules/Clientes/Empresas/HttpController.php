<?php

namespace App\Modules\Clientes\Empresas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\HttpRequestHelper;

class HttpController extends Controller {

    public function index(Request $request) {

        $filtros = $this->obtenerFiltrosPorUsuario();

        $opciones = $request->get('opciones', []);
        $opciones['with_relation'] = 'usuarioComercial'; 

        $rs = EmpresasService::listar(
            $request->get('page'   , 1 ),
            $request->get('limit'  , 10),
            array_merge($request->get('filtros', []), $filtros),
            [],
            $opciones
        );

        return EmpresaResource::collection($rs);
    }

    public function show(int $id) {
        $this->authorize('anyAction', Empresa::getById($id));
        $categoria = EmpresasService::getById($id);
        return $this->json($categoria);
    }

    public function store(EmpresaRequest $request) {
        $empresa = EmpresasService::crear(
            $request->input('cuit'                 ),
            $request->input('razon_social'         ),
            $request->input('telefono'             ),
            $request->input('email'                ),
            $request->input('perfil'               ),
            $request->input('usuario_comercial_id' ),
            $request->input('direccion'            ),
            $request->input('localidad'            ),
            $request->input('provincia'            ),
            $request->input('comision'            )
        );

        return $this->json($empresa);
    }

    public function update(Empresa $empresa, EmpresaRequest $request) {
        $this->authorize('anyAction', $empresa);

        $empresa = EmpresasService::actualizar(
            $empresa->getKey(),
            $request->input('cuit'                 ),
            $request->input('razon_social'         ),
            $request->input('telefono'             ),
            $request->input('email'                ),
            $request->input('perfil'               ),
            $request->input('usuario_comercial_id' ),
            $request->input('direccion'            ),
            $request->input('localidad'            ),
            $request->input('provincia'            ),
            $request->input('comision'             )
        );

        return $this->json($empresa);
    }

    public function habilitar(Empresa $empresa) {
        $this->authorize('anyAction', $empresa);

        $this->validarAcceso('empresas_habilitar');
        $empresa = EmpresasService::habilitar($empresa->getKey());
        return $this->json($empresa);
    }

    public function deshabilitar(Empresa $empresa) {
        $this->authorize('anyAction', $empresa);

        $this->validarAcceso('empresas_deshabilitar');
        $empresa = EmpresasService::deshabilitar($empresa->getKey());
        return $this->json($empresa);
    }

    protected function obtenerFiltrosPorUsuario(): array {
        $usuario = $this->getRequest()->user();
        $filtros = [];

        return $filtros;
    }
}
