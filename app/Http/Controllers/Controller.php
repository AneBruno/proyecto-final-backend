<?php

namespace App\Http\Controllers;

use App\Modules\Usuarios\Usuarios\User;
use App\Modules\Usuarios\Accesos\AccesosService;
use App\Modules\Usuarios\Roles\RolHelper;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Auth\Access\AuthorizationException;

class Controller extends BaseController
{
    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;
    
    public function input(string $name, $validations) {
        $request     = $this->getRequest();
        $value       = $request->input($name);
        $data        = $request->all();
        $validations = Validator::make($data, [$name => $validations]);
        $validations->validate();
        return $value;
    }
    
    public function json($resource): JsonResource {
        return new JsonResource($resource);
    }
    
    public function jsonCollection($collection): AnonymousResourceCollection {
        return JsonResource::collection($collection);
    }
    
    protected function getRequest(): Request {
        return App::make(Request::class);
    }
    
    protected function verificarAcceso(string $nombre): bool {
        return AccesosService::verificarAcceso($this->getRequest()->user(), $nombre);
    }
    
    protected function validarAcceso(string $nombre) {
        if (!$this->verificarAcceso($nombre)) {
            throw new AuthorizationException('Acceso no permitido');
        }
    }
    
    protected function validarAdministrador() {
        if (!$this->getRequest()->user()->hasAnyRol(RolHelper::ADMINISTRADOR_PLATAFORMA)) {
            abort(403, 'No puede realizar esta acción');
        }
    }

    protected function getUserId() {
        return auth()->user()->id;
    }
}
