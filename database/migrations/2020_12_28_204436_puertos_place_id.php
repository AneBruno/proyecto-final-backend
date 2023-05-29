<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PuertosPlaceId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('puertos', function(Blueprint $table) {
            $table->string('placeId')->nullable();
            $table->index('placeId');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('puertos', function(Blueprint $table) {
            $table->removeColumn('placeId');
        });
    }
}
