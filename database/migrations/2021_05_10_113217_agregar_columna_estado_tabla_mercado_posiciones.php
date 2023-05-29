<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AgregarColumnaEstadoTablaMercadoPosiciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mercado_posiciones', function(Blueprint $table) {
            $table->enum('estado', ['PUBLICADA', 'DENUNCIADA', 'RETIRADA'])->default('PUBLICADA');
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
            $table->dropColumn('estado');
        });
    }
}
