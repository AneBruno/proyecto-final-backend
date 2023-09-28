<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AgregarEstadoPosiciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mercado_posiciones', function (Blueprint $table) {
            DB::statement("ALTER TABLE mercado_posiciones MODIFY estado ENUM('ACTIVA', 'ELIMINADA', 'CERRADA')");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mercado_posiciones', function (Blueprint $table) {
            DB::statement("ALTER TABLE mercado_posiciones MODIFY estado ENUM('ACTIVA', 'ELIMINADA')");
        });
    }
}
