<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropTablasArchivos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('empresas_archivos', function (Blueprint $table) {
            $table->dropForeign(['empresa_id']);
            $table->dropForeign(['tipo_archivo_id']);
            
        });
        Schema::dropIfExists('empresas_archivos');
        Schema::dropIfExists('empresas_tipos_archivos');
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
