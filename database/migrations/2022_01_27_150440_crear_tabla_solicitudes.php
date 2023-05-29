<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaSolicitudes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estados_solicitudes', function(Blueprint $table) {
            $table->id();
            $table->string('descripcion');
        });
        
        Schema::create('solicitudes', function(Blueprint $table) {
            $table->id();
            $table->string('cuit');
            $table->string('razon_social', 255)->nullable(false);
            $table->string('nombre_usuario', 255)->nullable(false);
            $table->unsignedBigInteger('usuario_rol_id');
            $table->foreign('usuario_rol_id')->references('id')->on('roles');
            $table->enum('tipo', ['Disponible', 'Cobranza del día', 'Anticipo']);
            $table->decimal('monto_total', 14, 2, true)->default(0);
            $table->decimal('porcentaje_interes', 5, 2, true)->default(0);
            $table->unsignedBigInteger('estado_id');
            $table->foreign('estado_id')->references('id')->on('estados_solicitudes');
            $table->decimal('monto_aprobado', 14, 2, true)->default(0);
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
        Schema::dropIfExists('solicitudes');
        Schema::dropIfExists('estados_solicitudes');
    }
}
