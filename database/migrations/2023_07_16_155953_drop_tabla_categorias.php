<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropTablaCategorias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('empresas_categorias', function (Blueprint $table) {
            $table->dropForeign(['categoria_id']);
            $table->dropForeign(['empresa_id']);
            
        });

        Schema::dropIfExists('categorias_cliente');
        Schema::dropIfExists('empresas_categorias');
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
