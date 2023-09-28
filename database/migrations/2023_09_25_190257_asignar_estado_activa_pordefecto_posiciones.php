<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AsignarEstadoActivaPordefectoPosiciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('mercado_posiciones')
        ->whereNull('estado')
        ->update(['estado' => 'ACTIVA']);

        DB::statement('ALTER TABLE mercado_posiciones
        MODIFY estado ENUM("ACTIVA", "ELIMINADA", "CERRADA") NOT NULL DEFAULT "ACTIVA";');
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
