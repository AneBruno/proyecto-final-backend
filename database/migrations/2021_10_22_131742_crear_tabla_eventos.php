<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaEventos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eventos', function(Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('tipo_evento_id');
            $table->foreign('tipo_evento_id')->references('id')->on('tipos_evento');

            $table->unsignedBigInteger('usuario_creador_id');
            $table->foreign('usuario_creador_id')->references('id')->on('usuarios');

            $table->string('titulo', 255);
            $table->text('descripcion')->nullable();
            $table->text('resolucion')->nullable();
            $table->date('fecha_vencimiento')->nullable();
            $table->enum('estado', ['ABIERTO', 'CERRADO'])->default('ABIERTO');

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
        Schema::dropIfExists('eventos');
    }
}
