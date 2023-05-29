<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EventosColumnaUsuarioCierreId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('eventos', function(Blueprint $table) {
            $table->unsignedBigInteger('usuario_cierre_id')->nullable();
            $table->foreign('usuario_cierre_id')->references('id')->on('usuarios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('eventos', function(Blueprint $table) {
            $table->dropColumn('usuario_cierre_id');
        });
    }
}
