<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNombreClienteToCbuClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cbu_clientes', function (Blueprint $table) {
            $table->string('usuario_solicitante');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cbu_clientes', function (Blueprint $table) {
            $table->dropColumn('usuario_solicitante');
        });
    }
}
