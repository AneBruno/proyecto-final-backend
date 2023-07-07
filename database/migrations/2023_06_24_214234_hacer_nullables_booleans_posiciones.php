<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class HacerNullablesBooleansPosiciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mercado_posiciones', function (Blueprint $table) {
            $table->boolean('a_trabajar')->nullable()->change();
            $table->boolean('volumen_limitado')->nullable()->change();
            $table->boolean('posicion_excepcional')->nullable()->change();
    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table->boolean('a_trabajar')->nullable(false)->change();
            $table->boolean('volumen_limitado')->nullable(false)->change();
            $table->boolean('posicion_excepcional')->nullable(false)->change();
    }
}
