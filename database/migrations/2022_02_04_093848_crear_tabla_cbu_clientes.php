<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaCbuClientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cbu_clientes', function(BluePrint $table) {
            $table->id();
            $table->string('cuit')->nullable(false);
            $table->string('razon_social', 255)->nullable(false);
            $table->string('cbu', 22)->nullable(false);
            $table->string('banco', 255)->nullable(false);
            $table->string('mail', 255)->nullable(false);
            $table->enum('estado', ['Pendiente', 'Procesado']);
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
        Schema::dropIfExists('cbu_clientes');
    }
}
