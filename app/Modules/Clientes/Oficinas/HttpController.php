<?php
/*
namespace App\Modules\Clientes\Oficinas;

use App\Http\Controllers\Controller;
use App\Modules\Clientes\Empresas\Empresa;
use Illuminate\Http\Request;

class HttpController extends Controller
{

    public function index(Empresa $empresa, Request $request) {
        $this->authorize('anyAction', $empresa);
        
        $rs = OficinasService::listar(
            $request->get('page'   , 1 ),
            $request->get('limit'  , 10),
            $request->get('filtros', []),
        );

        return $this->jsonCollection($rs);
    }

    public function show(Empresa $empresa, int $id) {
        $this->authorize('anyAction', $empresa);
        
        $row = OficinasService::getById($id);
        return $this->json($row);
    }

    public function store(Empresa $empresa) {
        $this->authorize('anyAction', $empresa);
        
        $row = OficinasService::crear(
            $this->input('empresa_id',            ['required', 'integer', OficinasService::validadorEmpresaExistente()]),
            $this->input('nombre',                ['required', 'string' ]),
            $this->input('telefono',              ['required', 'integer']),
            $this->input('email',                 ['required', 'email'  ]),
            $this->input('placeId',               ['required', 'string' ]),
            $this->input('descripcion_ubicacion', ['nullable', 'string' ])
        );

        return $this->json($row);
    }

    public function update(Empresa $empresa, int $id) {
        $this->authorize('anyAction', $empresa);
        
        $row = OficinasService::actualizar(
            $id,
            $this->input('nombre',   ['required', 'string' ]),
            $this->input('telefono', ['required', 'integer']),
            $this->input('email',    ['required', 'email'  ]),
            $this->input('placeId',  ['nullable', 'string' ]),
            $this->input('descripcion_ubicacion', ['nullable', 'string' ])
        );
        return $this->json($row);
    }

    public function habilitar(Empresa $empresa, int $id) {
        $this->authorize('anyAction', $empresa);
        
        $row = OficinasService::habilitar($id);
        return $this->json($row);
    }

    public function destroy(Empresa $empresa, int $id) {
        $this->authorize('anyAction', $empresa);
        
        OficinasService::borrar($id);
        return true;
    }
}
*/