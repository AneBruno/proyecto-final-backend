<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EliminarCamposTablaUsuarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('usuarios', function (Blueprint $table) {
            $table->dropColumn('aprobacion_cbu');
            $table->dropColumn('aprobacion_gerencia_comercial');
            $table->dropColumn('aprobacion_dpto_creditos');
            $table->dropColumn('aprobacion_dpto_finanzas');
            $table->dropColumn('confirmacion_pagos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('usuarios', function (Blueprint $table) {
            //
        });
    }
}
