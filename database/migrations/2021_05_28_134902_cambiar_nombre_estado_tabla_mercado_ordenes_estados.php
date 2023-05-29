<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CambiarNombreEstadoTablaMercadoOrdenesEstados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("
            UPDATE mercado_ordenes_estados SET
                nombre = 'Retirada'
            WHERE nombre = 'Baja'
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("
            UPDATE mercado_ordenes_estados SET
                nombre = 'Baja'
            WHERE nombre = 'Retirada'
        ");
    }
}
