<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class EliminarAccesoARolSoporte extends Migration {

    public function up()  {
        DB::statement("
            DELETE FROM accesos_roles
            WHERE rol_id = 6
            AND acceso_id IN(
                SELECT id
                FROM accesos
                WHERE nombre = 'Eventos CRM'
                AND tipo = 'menu'
            )
        ");
    }

    public function down() {
        //
    }
}
