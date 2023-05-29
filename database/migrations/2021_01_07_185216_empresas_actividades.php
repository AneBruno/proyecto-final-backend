<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EmpresasActividades extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas_actividades', function(Blueprint $table) {
            $table->id();
            $table->foreignId('empresa_id');
            $table->foreign('empresa_id')->references('id')->on('empresas');

            $table->foreignId('actividad_id')->nullable();
            $table->foreign('actividad_id')->references('id')->on('actividades');
            
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
        Schema::drop('empresas_actividades');
    }
}
