<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CambiarDefaultDireccionPosiciones extends Migration
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
            $table->decimal('latitud_destino', 11 , 8)->nullable()->default(null)->change();
            $table->decimal('longitud_destino', 11, 8)->nullable()->default(null)->change();
            $table->string('departamento_destino')->nullable()->default(null)->change();
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
            // Cambiar el valor por defecto del campo a NULL
            $table->decimal('latitud_destino', 11 , 8)->nullable()->default(-32.95870220)->change();
            $table->decimal('longitud_destino', 11, 8)->nullable()->default(-60.69304160)->change();
            $table->string('departamento_destino')->nullable()->default('Rosario Department')->change();
        });
    }
}
