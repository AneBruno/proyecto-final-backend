<?php

namespace App\Modules\Clientes\Contactos;

use App\Http\Controllers\Controller;
use App\Modules\Clientes\Empresas\Empresa;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Kodear\Laravel\Repository\Exceptions\RepositoryException;

class HttpController extends Controller {

    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     */
    public function index(Request $request) {
        $filtros = $this->obtenerFiltrosPorUsuario();
        
        $rs = ContactosService::listar(
            $request->get('page'   , 1 ),
            $request->get('limit'  , 10),
            array_merge($request->get('filtros', []), $filtros)
        );
        return $this->jsonCollection($rs);
    }

    /**
     * @param $id
     * @return JsonResource
     */
    public function show(Contacto $contacto) {
        $this->authorize('anyAction', $contacto);
        $contacto = ContactosService::getById($contacto->id);
        return $this->json($contacto);
    }

    /**
     * @param ContactoRequest $request
     * @return ContactoResource
     * @throws RepositoryException
     */
    public function store(ContactoRequest $request) {
        
        $empresa = Empresa::getById($request->input('empresa_id'));
        
        $this->authorize('anyAction', $empresa);
        
        $contacto = ContactosService::crear(
            $request->input('nombre'              ),
            $request->input('telefono_celular'    ),
            $request->input('telefono_fijo'       ),
            $request->input('email'               ),
            $request->input('empresa_id'          ),
            $request->input('fecha_nacimiento'    ),
            $request->input('cargo_id'            ),
            $request->input('nivel_jerarquia'     )
        );

        return $this->json($contacto);
    }

    /**
     * @param int $id
     * @param ContactoRequest $request
     * @return ContactoResource
     * @throws RepositoryException
     */
    public function update(Contacto $contacto, ContactoRequest $request) {
        
        $this->authorize('anyAction', $contacto);
        
        $contacto = ContactosService::actualizar(
            $contacto->id,
            $request->input('nombre'              ),
            $request->input('telefono_celular'    ),
            $request->input('telefono_fijo'       ),
            $request->input('email'               ),
            $request->input('empresa_id'          ),
            $request->input('fecha_nacimiento'    ),
            $request->input('cargo_id'            ),
            $request->input('nivel_jerarquia'     )
        );

        return $this->json($contacto);
    }

    public function destroy(Contacto $contacto)
    {
        $this->authorize('anyAction', $contacto);
        
        ContactosService::borrar($contacto->id);
        return $this->json([]);
    }
    
    public function obtenerAlertaExistente(Request $request) {
        return $this->json(ContactosService::obtenerAlertaExistente(
            $request->input('empresa_id'),
            $request->input('nombre'    ),
            $request->input('email'     ),
            $request->input('contacto_id', null),
        ));
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
