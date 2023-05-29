<?php

namespace App\Modules\Usuarios\Roles;

use Kodear\Laravel\Repository\Model;

class Rol extends Model
{
    protected $table = 'roles';

    public function accesos()
    {
        return $this->belongsToMany(\App\Modules\Usuarios\Accesos\Acceso::class, 'accesos_roles');
    }
}
