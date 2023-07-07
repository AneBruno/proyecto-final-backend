<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CambiarValorDefectoAFijar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mercado_posiciones', function (Blueprint $table) {
            // Cambiar el valor por defecto del campo a NULL
            $table->boolean('a_fijar')->nullable()->default(null)->change();
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
            // Revertir el cambio y restaurar el valor por defecto a 0
            $table->boolean('a_fijar')->default(0)->change();
        });
    }
}
