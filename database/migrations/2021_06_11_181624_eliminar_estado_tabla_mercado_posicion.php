<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class EliminarEstadoTablaMercadoPosicion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("UPDATE mercado_posiciones SET
                        estado = 'CREADA' WHERE estado = 'SLIP'");

        DB::statement(
            "ALTER TABLE mercado_posiciones
                       MODIFY COLUMN estado ENUM('CREADA', 'DENUNCIADA', 'RETIRADA', 'ELIMINADA') DEFAULT 'CREADA'"
        );

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        DB::statement(
            "ALTER TABLE mercado_posiciones
                       MODIFY COLUMN estado ENUM('CREADA', 'DENUNCIADA', 'RETIRADA', 'ELIMINADA', 'SLIP') DEFAULT 'CREADA'"
        );
    }
}
