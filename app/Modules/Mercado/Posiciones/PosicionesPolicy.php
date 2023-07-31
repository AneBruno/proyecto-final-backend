<?php

namespace App\Modules\Mercado\Posiciones;

use App\Modules\Usuarios\Roles\RolHelper;
use App\Modules\Usuarios\Usuarios\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PosicionesPolicy
{
    use HandlesAuthorization;

    public function destroy(User $user): bool
    {
        return $user->hasAnyRol(
            RolHelper::ADMINISTRADOR_PLATAFORMA,
            RolHelper::COMERCIAL,
            RolHelper::REPRESENTATE
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
            RolHelper::COMERCIAL,
            RolHelper::REPRESENTATE
        );
    }
}
