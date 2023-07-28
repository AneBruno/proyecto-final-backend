<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropTablaActividades extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('empresas_actividades', function (Blueprint $table) {
            $table->dropForeign(['actividad_id']);
            $table->dropForeign(['empresa_id']);
            
        });

        Schema::dropIfExists('actividades');
        Schema::dropIfExists('empresas_actividades');
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
