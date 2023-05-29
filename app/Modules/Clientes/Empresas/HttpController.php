<?php

namespace App\Modules\Clientes\Empresas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HttpController extends Controller {

    public function index(Request $request) {

        $filtros = $this->obtenerFiltrosPorUsuario();

        $rs = EmpresasService::listar(
            $request->get('page'   , 1 ),
            $request->get('limit'  , 10),
            array_merge($request->get('filtros', []), $filtros),
        );

        return $this->jsonCollection($rs);
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
            $request->input('comision_comprador'   ),
            $request->input('comision_vendedor'    ),
            $request->input('categoria_crediticia' ),
            $request->input('afinidad'             ),
            $request->input('usuario_comercial_id' ),
            $request->input('placeId'              ),
            $request->input('descripcion_ubicacion'),
            $request->input('actividades_id'       ),
            $request->input('categorias_id'        ),
            $request->input('abreviacion', null)
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
            $request->input('comision_comprador'   ),
            $request->input('comision_vendedor'    ),
            $request->input('categoria_crediticia' ),
            $request->input('afinidad'             ),
            $request->input('usuario_comercial_id' ),
            $request->input('placeId',         null),
            $request->input('descripcion_ubicacion'),
            $request->input('actividades_id'       ),
            $request->input('categorias_id'        ),
            $request->input('abreviacion',null)
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

    public function destroy(Empresa $empresa)
    {
        $this->authorize('anyAction', $empresa);

        EmpresasService::borrar($empresa->getKey());
        return $this->json([]);
    }

    protected function obtenerFiltrosPorUsuario(): array {
        $usuario = $this->getRequest()->user();
        $filtros = [];

        if ($usuario->rol_id === 4) {
            $filtros['usuario_comercial_id'] = $usuario->id;
        }

        return $filtros;
    }
}
