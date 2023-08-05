<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EliminarCamposOrdenes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mercado_ordenes', function (Blueprint $table) {
             $table->dropColumn('fecha_entrega_inicio');
             $table->dropColumn('fecha_entrega_fin');
             $table->dropColumn('establecimiento_id');
             $table->dropColumn('entrega');
             $table->dropColumn('calidad_id');
             $table->dropColumn('latitud_procedencia');
             $table->dropColumn('longitud_procedencia');
             $table->dropColumn('provincia_procedencia');
             $table->dropColumn('localidad_procedencia');
             $table->dropColumn('departamento_procedencia');
             $table->dropColumn('longitud_destino');
             $table->dropColumn('latitud_destino');
             $table->dropColumn('departamento_destino');
         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
