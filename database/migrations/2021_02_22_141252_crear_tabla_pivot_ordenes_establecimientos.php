<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaPivotOrdenesEstablecimientos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ordenes_establecimientos', function (Blueprint $tabla) {
            $tabla->id();

            $tabla->unsignedBigInteger('orden_id');
            $tabla->foreign('orden_id')->references('id')->on('mercado_ordenes');

            $tabla->unsignedBigInteger('establecimiento_id');
            $tabla->foreign('establecimiento_id')->references('id')->on('establecimientos_empresa');

            $tabla->unique(['orden_id', 'establecimiento_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ordenes_establecimientos');
    }
}
