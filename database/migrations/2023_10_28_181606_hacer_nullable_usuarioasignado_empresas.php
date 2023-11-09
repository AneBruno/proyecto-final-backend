<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class HacerNullableUsuarioasignadoEmpresas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Schema::table('empresas', function (Blueprint $table) {
            $table->unsignedBigInteger('usuario_comercial_id')->nullable()->change();
            $table->foreign('usuario_comercial_id')->references('id')->on('usuarios')->onDelete('set null');
        });*/
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
