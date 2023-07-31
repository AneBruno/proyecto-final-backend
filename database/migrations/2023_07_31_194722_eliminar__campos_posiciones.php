<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EliminarCamposPosiciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Schema::table('mercado_posiciones', function (Blueprint $table) {
            $table->dropForeign(['calidad_id']);
            $table->dropForeign(['establecimiento_id']);
            
        });*/
        Schema::table('mercado_posiciones', function (Blueprint $table) {
           // $table->dropColumn('calidad_id');
            $table->dropColumn('calidad_observaciones');
            $table->dropColumn('fecha_entrega_inicio');
            $table->dropColumn('fecha_entrega_fin');
            $table->dropColumn('establecimiento_id');
            $table->dropColumn('posicion_excepcional');
            $table->dropColumn('volumen_limitado');
            $table->dropColumn('a_trabajar');
            $table->dropColumn('a_fijar');
            $table->dropColumn('entrega');
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
