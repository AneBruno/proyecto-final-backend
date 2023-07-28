<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropTablaEstabl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mercado_posiciones', function (Blueprint $table) {
            $table->dropForeign(['establecimiento_id']);
            
        });
        Schema::table('mercado_ordenes', function (Blueprint $table) {
            $table->dropForeign(['establecimiento_id']);
            
        });
        Schema::dropIfExists('establecimientos_empresa');
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
