<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CambiarNombreEstadoPosiciones extends Migration
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
                       MODIFY COLUMN estado ENUM('CREADA', 'DENUNCIADA', 'RETIRADA', 'ELIMINADA', 'ACTIVA') DEFAULT 'CREADA'"
        );
        DB::table('mercado_posiciones')->where('estado','=', 'CREADA')->update(['estado' => 'ACTIVA']);

        DB::statement(
            "ALTER TABLE mercado_posiciones
                       MODIFY COLUMN estado ENUM('ACTIVA', 'DENUNCIADA', 'RETIRADA', 'ELIMINADA') DEFAULT 'ACTIVA'"
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
        DB::beginTransaction();
        DB::statement(
            "ALTER TABLE mercado_posiciones
                       MODIFY COLUMN estado ENUM('CREADA', 'DENUNCIADA', 'RETIRADA', 'ELIMINADA', 'ACTIVA') DEFAULT 'ACTIVA'"
        );
        DB::table('mercado_posiciones')->where('estado','=', 'ACTIVA')->update(['estado' => 'CREADA']);

        DB::statement(
            "ALTER TABLE mercado_posiciones
                       MODIFY COLUMN estado ENUM('CREADA', 'DENUNCIADA', 'RETIRADA', 'ELIMINADA') DEFAULT 'CREADA'"
        );

        DB::commit();
    }
}
