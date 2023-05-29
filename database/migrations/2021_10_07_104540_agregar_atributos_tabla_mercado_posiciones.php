<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AgregarAtributosTablaMercadoPosiciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mercado_posiciones', function(Blueprint $table) {
            $table->string('localidad_destino', 255)->default('Rosario');
            $table->string('departamento_destino', 255)->default('Rosario Department');
            $table->string('provincia_destino', 255)->default('Santa Fe');
            $table->decimal('latitud_destino', 11, 8)->default('-32.95870220000000');
            $table->decimal('longitud_destino', 11, 8)->default(' -60.69304160000000');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mercado_posiciones', function(Blueprint $table) {
            $table->dropColumn('localidad_destino');
            $table->dropColumn('departamento_destino');
            $table->dropColumn('provincia_destino');
            $table->dropColumn('latitud_destino');
            $table->dropColumn('longitud_destino');
        });
    }
}
