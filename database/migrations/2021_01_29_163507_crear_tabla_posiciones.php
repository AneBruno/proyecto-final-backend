<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaPosiciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mercado_posiciones', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('producto_id');
            $table->foreign('producto_id')->references('id')->on('productos');

            $table->unsignedBigInteger('calidad_id');
            $table->foreign('calidad_id')->references('id')->on('calidades');
            $table->string('calidad_observaciones')->nullable();

            $table->date('fecha_entrega_inicio');
            $table->date('fecha_entrega_fin');

            $table->unsignedBigInteger('empresa_id');
            $table->foreign('empresa_id')->references('id')->on('empresas');

            $table->unsignedBigInteger('usuario_carga_id');
            $table->foreign('usuario_carga_id')->references('id')->on('usuarios');

            $table->unsignedBigInteger('puerto_id')->nullable();
            $table->foreign('puerto_id')->references('id')->on('puertos');

            $table->unsignedBigInteger('establecimiento_id')->nullable();
            $table->foreign('establecimiento_id')->references('id')->on('establecimientos_empresa');

            $table->enum('moneda', ['USD', 'AR$']);
            $table->float('precio');

            $table->unsignedBigInteger('condicion_pago_id')->nullable();
            $table->foreign('condicion_pago_id')->references('id')->on('condiciones_pago');

            $table->boolean('posicion_excepcional');
            $table->boolean('volumen_limitado');
            $table->boolean('a_trabajar');

            $table->string('observaciones')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mercado_posiciones');
    }
}
