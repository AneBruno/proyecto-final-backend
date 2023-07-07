<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class HacerNullablesCamposPosiciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mercado_posiciones', function (Blueprint $table) {
            $table->string('departamento_destino')->nullable()->change();
            $table->decimal('latitud_destino', 11, 8)->nullable()->change();
            $table->decimal('longitud_destino', 11, 8)->nullable()->change();
            $table->unsignedBigInteger('calidad_id')->nullable()->change();
    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mercado_posiciones', function (Blueprint $table) {
            $table->string('departamento_destino')->nullable(false)->change();
            $table->decimal('latitud_destino', 11 ,8)->nullable(false)->change();
            $table->decimal('longitud_destino', 11 , 8)->nullable(false)->change();
            $table->unsignedBigInteger('calidad_id')->nullable(false)->change();
        });
    }
}
