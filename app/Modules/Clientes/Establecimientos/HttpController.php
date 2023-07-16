<?php
/*
namespace App\Modules\Clientes\Establecimientos;

use App\Http\Controllers\Controller;
use App\Modules\Clientes\Empresas\Empresa;
use Illuminate\Http\Request;

class HttpController extends Controller
{

    public function index(Empresa $empresa, Request $request) {
        $this->authorize('anyAction', $empresa);
        $rs = EstablecimientosService::listar(
            $request->get('page'   , 1 ),
            $request->get('limit'  , 10),
            $request->get('filtros', []),
        );

        return $this->jsonCollection($rs);
    }

    public function show(Empresa $empresa, int $id) {
        $this->authorize('anyAction', $empresa);
        $row = EstablecimientosService::getById($id);
        return $this->json($row);
    }

    public function store(Empresa $empresa, EstablecimientoRequest $request) {
        $this->authorize('anyAction', $empresa);
        $row = EstablecimientosService::crear(
            $request->input('empresa_id'           ),
            $request->input('puerto_id'            ),
            $request->input('nombre'               ),
            $request->input('tipo'                 ),
            $request->input('propio'               ),
            $request->input('hectareas_agricolas'  ),
            $request->input('hectareas_ganaderas'  ),
            $request->input('capacidad_acopio'     ),
            $request->input('placeId'              ),
            $request->input('descripcion_ubicacion')
        );

        return $this->json($row);
    }

    public function update(Empresa $empresa, int $id, EstablecimientoRequest $request) {
        $this->authorize('anyAction', $empresa);
        $row = EstablecimientosService::actualizar(
            $id,
            $request->input('puerto_id'            ),
            $request->input('nombre'               ),
            $request->input('tipo'                 ),
            $request->input('propio'               ),
            $request->input('hectareas_agricolas'  ),
            $request->input('hectareas_ganaderas'  ),
            $request->input('capacidad_acopio'     ),
            $request->input('placeId'              ),
            $request->input('descripcion_ubicacion')
        );
        return $this->json($row);
    }

    public function habilitar(Empresa $empresa, int $id) {
        $this->authorize('anyAction', $empresa);
        $row = EstablecimientosService::habilitar($id);
        return $this->json($row);
    }

    public function destroy(Empresa $empresa, int $id) {
        $this->authorize('anyAction', $empresa);
        EstablecimientosService::borrar($id);
        return true;
    }
}
*/