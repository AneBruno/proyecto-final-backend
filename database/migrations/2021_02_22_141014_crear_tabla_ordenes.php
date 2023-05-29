<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaOrdenes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mercado_ordenes', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('empresa_id');
            $table->foreign('empresa_id')->references('id')->on('empresas');

            $table->unsignedBigInteger('producto_id');
            $table->foreign('producto_id')->references('id')->on('productos');

            $table->unsignedBigInteger('calidad_id')->nullable();
            $table->foreign('calidad_id')->references('id')->on('calidades');

            $table->date('fecha_entrega_inicio');
            $table->date('fecha_entrega_fin');

            $table->unsignedBigInteger('puerto_id');
            $table->foreign('puerto_id')->references('id')->on('puertos');

            $table->unsignedBigInteger('condicion_pago_id')->nullable();
            $table->foreign('condicion_pago_id')->references('id')->on('condiciones_pago');

            $table->enum('moneda', ['USD', 'AR$']);
            $table->float('precio')->nullable();
            $table->integer('volumen');
            $table->date('fecha_vencimiento');
            $table->string('observaciones', 255)->nullable();

            $table->unsignedBigInteger('usuario_carga_id');
            $table->foreign('usuario_carga_id')->references('id')->on('usuarios');

            $table->unsignedBigInteger('estado_id');
            $table->foreign('estado_id')->references('id')->on('mercado_ordenes_estados');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mercado_ordenes');
    }
}
