<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropTablasCalidades2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mercado_posiciones', function (Blueprint $table) {
            $table->dropForeign(['calidad_id']);
            
        });
        Schema::table('mercado_ordenes', function (Blueprint $table) {
            $table->dropForeign(['calidad_id']);
            
        });
        Schema::dropIfExists('calidades');
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
