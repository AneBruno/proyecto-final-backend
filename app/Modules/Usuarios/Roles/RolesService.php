<?php

namespace App\Modules\Usuarios\Roles;


class RolesService
{
    private $rolesRepository;

    /**
     *
     * @param Oficina $rol
     */
    public function __construct(Rol $rol)
    {
        $this->rolesRepository = $rol->getRepository();
    }
    
    /**
     *
     * @return type
     */
    public function listar()
    {
        $collection = $this->rolesRepository->get();
        
        return $collection;
    }
}
