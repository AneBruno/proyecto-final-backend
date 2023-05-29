<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeCbuNullableOnSolicitudesFormasPagoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::table('solicitudes_formas_pago', function (Blueprint $table) {
			$table->string('cbu')->nullable()->change();
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::table('solicitudes_formas_pago', function (Blueprint $table) {
			$table->string('cbu')->nullable(false)->change();
		});
    }
}
