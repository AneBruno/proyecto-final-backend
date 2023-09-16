<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class EliminarAccesoTipoproductoAdmin2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::transaction(function () {
            // Eliminar los registros relacionados en la tabla accesos_roles primero
            DB::table('accesos_roles')
                ->where('id', '=', 39) // El ID del acceso que deseas eliminar
                ->delete();
                
            // Ahora eliminar el registro en la tabla accesos
            DB::table('accesos')
                ->where('id', '=', 17) // El mismo ID del acceso que deseas eliminar
                ->delete();
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
