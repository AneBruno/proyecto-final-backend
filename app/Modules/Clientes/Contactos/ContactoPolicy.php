<?php

namespace App\Modules\Clientes\Contactos;

use App\Modules\Usuarios\Usuarios\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ContactoPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    
    public function anyAction(User $user, Contacto $contacto) {
        if ($user->rol_id === 4) {
            if (!$contacto->empresa) {
                return false;
            }
            return $user->can('anyAction', $contacto->empresa);
            //return $contacto->empresa->usuario_comercial_id === $user->id;
        }
        return true;
    }
}
