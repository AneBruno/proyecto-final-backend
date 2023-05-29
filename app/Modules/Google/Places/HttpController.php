<?php

namespace App\Modules\Google\Places;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Resources\Json\JsonResource;

class HttpController extends Controller
{
    public function buscar(Request $request) {
        return JsonResource::collection(PlacesService::buscar($request->get('text'), $request->get('sessionToken')));
    }
    
    public function obtenerDetalles(string $id, Request $request) {
        return $this->json((array)PlacesService::obtenerDetalles($id, $request->get('sessionToken')));
    }
}
