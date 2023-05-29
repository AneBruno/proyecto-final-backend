<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EmpresasCategorias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas_categorias', function(Blueprint $table) {
            $table->id();
            $table->foreignId('empresa_id');
            $table->foreign('empresa_id')->references('id')->on('empresas');

            $table->foreignId('categoria_id')->nullable();
            $table->foreign('categoria_id')->references('id')->on('categorias_cliente');
            
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
        Schema::drop('empresas_categorias');
    }
}
