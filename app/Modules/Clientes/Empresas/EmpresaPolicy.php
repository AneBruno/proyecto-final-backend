<?php

namespace App\Modules\Clientes\Empresas;

use App\Modules\Usuarios\Roles\RolHelper;
use App\Modules\Usuarios\Usuarios\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class EmpresaPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }
    
    public function anyAction(User $user, Empresa $empresa) {
        if (!$user->hasAnyRol(
            RolHelper::ADMINISTRADOR_PLATAFORMA,
            RolHelper::RESPONSABLE_COMERCIAL,
            RolHelper::COMERCIAL,
            RolHelper::REPRESENTATE,
            RolHelper::ADMINISTRATIVO
        )) {
            return false;
        }
        if ($user->rol_id === RolHelper::REPRESENTATE) {
            return $empresa->usuario_comercial_id === $user->id;
        }
        return true;
    }
}
