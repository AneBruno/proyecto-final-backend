<?php

namespace App\Modules\Usuarios\Roles;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HttpController extends Controller
{
    private $rolesService;
    
    public function __construct(RolesService $roles)
    {
        $this->rolesService = $roles;
    }
    
    public function index(Request $request)
    {
        $collection = $this->rolesService->listar();
        $resources = RolResource::collection($collection);
        
        return $resources;
    }
}
