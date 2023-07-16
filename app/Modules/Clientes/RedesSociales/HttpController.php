<?php
/*
namespace App\Modules\Clientes\RedesSociales;

use App\Http\Controllers\Controller;
use App\Modules\Clientes\Contactos\Contacto;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;
use Kodear\Laravel\Repository\Exceptions\RepositoryException;

class HttpController extends Controller {

    /**
     * @param Request $request
     * @return AnonymousResourceCollection
     *
    public function index(Request $request, Contacto $contacto) {
        $this->authorize('anyAction', $contacto);
        
        $filtros = $request->get('filtros', []);
        $filtros['contacto_id'] = $contacto->id;
        $rs = RedesSocialesService::listar(
            $request->get('page'   , 1 ),
            $request->get('limit'  , 10),
            $filtros,
        );
        return RedSocialResource::collection($rs);
    }

    /**
     * @param RedSocial $red_social
     * @return RedSocialResource
     *
    public function show(Contacto $contacto, int $id) {
        $this->authorize('anyAction', $contacto);
        $row = RedesSocialesService::getById($id);
        return new RedSocialResource($row);
    }

    /**
     * @param RedSocialRequest $request
     * @param Contacto $contacto
     * @return RedSocialResource
     * @throws RepositoryException
     *
    public function store(RedSocialRequest $request, Contacto $contacto)
    {
        $this->authorize('anyAction', $contacto);
        $red_social = RedesSocialesService::crear(
            $contacto->getKey(),
            $request->input('red'),
            $request->input('url')
        );

        return new RedSocialResource($red_social);
    }

    /**
     * @param int $id
     * @param RedSocialRequest $request
     * @return RedSocialResource
     *
    public function update(RedSocialRequest $request, Contacto $contacto, int $id)
    {
        $this->authorize('anyAction', $contacto);
        
        $red_social = RedesSocialesService::actualizar(
            $id,
            $request->input('red'),
            $request->input('url')
        );

        return new RedSocialResource($red_social);
    }

    /**
     * @param int $id
     * @return JsonResource
     * @throws RepositoryException
     *
    public function destroy(Contacto $contacto, int $id)
    {
        $this->authorize('anyAction', $contacto);
        
        RedesSocialesService::borrar($id);
        return $this->json([]);
    }
}
*/