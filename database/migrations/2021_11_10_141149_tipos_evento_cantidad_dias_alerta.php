<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TiposEventoCantidadDiasAlerta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tipos_evento', function(Blueprint $table) {
            $table->integer('cantidad_dias_alerta_1')->nullable();
            $table->integer('cantidad_dias_alerta_2')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tipos_evento', function(Blueprint $table) {
            $table->dropColumn('cantidad_dias_alerta_1');
            $table->dropColumn('cantidad_dias_alerta_2');
        });
    }
}
