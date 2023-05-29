<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModificarNombreAtributoTablaPosiciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mercado_posiciones', function(Blueprint $table) {
            $table->dropColumn('cosecha_nueva');

            $table->unsignedBigInteger('cosecha_id')->nullable();
            $table->foreign('cosecha_id')->references('id')->on('mercado_cosechas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mercado_posiciones', function(Blueprint $table) {
            $table->dropColumn('cosecha_id');

            $table->boolean('cosecha_nueva')->default(0);
        });
    }
}
