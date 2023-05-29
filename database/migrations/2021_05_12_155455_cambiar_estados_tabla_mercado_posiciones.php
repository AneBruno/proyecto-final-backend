<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CambiarEstadosTablaMercadoPosiciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::beginTransaction();
        DB::statement(
            "ALTER TABLE mercado_posiciones
                       MODIFY COLUMN estado ENUM('PUBLICADA','CREADA', 'DENUNCIADA', 'RETIRADA', 'ELIMINADA')"
        );
        DB::table('mercado_posiciones')->where('estado','=', 'PUBLICADA')->update(['estado' => 'CREADA']);

        DB::statement(
            "ALTER TABLE mercado_posiciones
                       MODIFY COLUMN estado ENUM('CREADA', 'DENUNCIADA', 'RETIRADA', 'ELIMINADA') DEFAULT 'CREADA'"
        );

        DB::commit();
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
