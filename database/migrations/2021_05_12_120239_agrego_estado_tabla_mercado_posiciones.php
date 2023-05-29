<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AgregoEstadoTablaMercadoPosiciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            DB::statement(
                "ALTER TABLE mercado_posiciones
                       MODIFY COLUMN estado ENUM('PUBLICADA', 'DENUNCIADA', 'RETIRADA', 'ELIMINADA')"
            );
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
