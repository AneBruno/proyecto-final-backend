<?php

namespace App\Modules\Mercado\Ordenes;

use App\Modules\Usuarios\Roles\RolHelper;
use App\Modules\Usuarios\Usuarios\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrdenPolicy
{
    use HandlesAuthorization;

    /**
     * @param User $user
     * @return bool
     */
    public function destroy(User $user): bool
    {
        return $user->hasAnyRol(
            RolHelper::ADMINISTRADOR_PLATAFORMA,
           // RolHelper::RESPONSABLE_COMERCIAL,
            RolHelper::COMERCIAL,
            RolHelper::REPRESENTATE,
            //RolHelper::ADMINISTRATIVO
        );
    }
    /**
     * @param User $user
     * @return bool
     */
    public function cambiarEstado(User $user): bool
    {
        return $user->hasAnyRol(
            RolHelper::ADMINISTRADOR_PLATAFORMA,
            //RolHelper::RESPONSABLE_COMERCIAL,
            RolHelper::COMERCIAL,
            RolHelper::REPRESENTATE,
            //RolHelper::ADMINISTRATIVO
        );
    }
}
