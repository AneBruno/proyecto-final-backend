<?php

/*namespace  App\Modules\Clientes\Cargos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class HttpController extends Controller {

    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     *
    public function index(Request $request) {
        $rs = CargoService::listar(
            $request->get('page'   , 1 ),
            $request->get('limit'  , 10),
            $request->get('filtros', [])
        );
        return CargoResource::collection($rs);
    }
    
    public function show(int $id) {
        return $this->json(Cargo::getById($id));
    }
    
    public function store(CargoRequest $request) {
        $nombre = $this->input('nombre', ['required','string']);
        $row = Cargo::crear($nombre);
        return $this->json($row);
    }
    
    public function update(int $id, CargoRequest $request) {
        $row = Cargo::getById($id)->actualizar($this->input('nombre', ['required','string']));
        return $this->json($row);
    }
    
    public function destroy(int $id) {
        Cargo::getById($id)->borrar();
        return $this->json([]);
    }
}
*/