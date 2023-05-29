<?php

namespace App\Modules\Mercado\CondicionesPago;

use App\Modules\Usuarios\Roles\RolHelper;
use App\Modules\Usuarios\Usuarios\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CondicionPagoPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Modules\Usuarios\Usuarios\User  $user
     * @return mixed
     */
    public function anyAction(User $user)
    {
        return $user->hasAnyRol(
            RolHelper::ADMINISTRADOR_PLATAFORMA,
        );
    }
}
