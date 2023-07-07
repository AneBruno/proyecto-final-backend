<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CampoEstadoFormaPago extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('condiciones_pago', function (Blueprint $table) {
            $table->enum('estado', ['Habilitado', 'Deshabilitado'])->default('Habilitado');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('condiciones_pago', function (Blueprint $table) {
            $table->dropColumn('estado');
        });
    }
}
