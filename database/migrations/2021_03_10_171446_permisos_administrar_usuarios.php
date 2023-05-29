<?php

use Illuminate\Database\Migrations\Migration;
use App\Modules\Usuarios\Accesos\AccesoRol;
use App\Modules\Usuarios\Accesos\Acceso;
use App\Modules\Usuarios\Roles\RolHelper;

class PermisosAdministrarUsuarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Acceso::listarTodos([
            'uri' => 'usuarios',
        ])->each(function($row) {
            $acceso_id = $row->getKey();
            AccesoRol::listarTodos([
                'acceso_id' => $acceso_id,
            ])->each(function($row) {
                if ($row->rol_id != RolHelper::ADMINISTRADOR_PLATAFORMA) {
                    $row->borrar();
                }
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
