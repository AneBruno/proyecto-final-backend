<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AgregarCamposCobrosTablaUsuarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::table('usuarios', function (Blueprint $table) {
			$table->tinyInteger('aprobacion_cbu')->nullable()->after('telefono');
			$table->tinyInteger('aprobacion_gerencia_comercial')->nullable()->after('aprobacion_cbu');
			$table->tinyInteger('aprobacion_dpto_creditos')->nullable()->after('aprobacion_gerencia_comercial');
			$table->tinyInteger('aprobacion_dpto_finanzas')->nullable()->after('aprobacion_dpto_creditos');
			$table->tinyInteger('confirmacion_pagos')->nullable()->after('aprobacion_dpto_finanzas');
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
			$table->dropColumn([
				'aprobacion_cbu',
				'aprobacion_gerencia_comercial',
				'aprobacion_dpto_creditos',
				'aprobacion_dpto_finanzas',
				'confirmacion_pagos'
			]);
		});
    }
}
