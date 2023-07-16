<?php
/*
namespace App\Modules\Clientes\Empresas\Archivos\Policies;

use App\Modules\Usuarios\Roles\RolHelper;
use App\Modules\Usuarios\Usuarios\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArchivoPolicy
{
    use HandlesAuthorization;

    /**
     * @param User $user
     * @return bool
     *
    public function create(User $user)
    {
        return $user->hasAnyRol(
            RolHelper::ADMINISTRADOR_PLATAFORMA,
            RolHelper::RESPONSABLE_COMERCIAL,
            RolHelper::COMERCIAL,
            RolHelper::REPRESENTATE,
            RolHelper::ADMINISTRATIVO
        );
    }

    /**
     * @param User $user
     * @return mixed
     *
    public function update(User $user)
    {
        return $user->hasAnyRol(
            RolHelper::ADMINISTRADOR_PLATAFORMA,
            RolHelper::RESPONSABLE_COMERCIAL,
            RolHelper::COMERCIAL,
            RolHelper::REPRESENTATE,
            RolHelper::ADMINISTRATIVO);
    }

    /**
     * @param User $user
     * @return mixed
     *
    public function viewAny(User $user)
    {
        return $user->hasAnyRol(
            RolHelper::ADMINISTRADOR_PLATAFORMA,
            RolHelper::RESPONSABLE_COMERCIAL,
            RolHelper::COMERCIAL,
            RolHelper::REPRESENTATE,
            RolHelper::ADMINISTRATIVO
        );
    }

    /**
     * @param User $user
     * @return bool
     *
    public function view(User $user)
    {
        return $user->hasAnyRol(
            RolHelper::ADMINISTRADOR_PLATAFORMA,
            RolHelper::RESPONSABLE_COMERCIAL,
            RolHelper::COMERCIAL,
            RolHelper::REPRESENTATE,
            RolHelper::ADMINISTRATIVO
        );
    }

    /**
     * @param User $user
     * @return bool
     *
    public function delete(User $user)
    {
        return $user->hasAnyRol(
            RolHelper::ADMINISTRADOR_PLATAFORMA,
            RolHelper::RESPONSABLE_COMERCIAL,
            RolHelper::COMERCIAL,
            RolHelper::REPRESENTATE,
            RolHelper::ADMINISTRATIVO
        );
    }

    /**
     * @param User $user
     * @return bool
     *
    public function download(User $user)
    {
        return $user->hasAnyRol(
            RolHelper::ADMINISTRADOR_PLATAFORMA,
            RolHelper::RESPONSABLE_COMERCIAL,
            RolHelper::COMERCIAL,
            RolHelper::REPRESENTATE,
            RolHelper::ADMINISTRATIVO
        );
    }
}
*/