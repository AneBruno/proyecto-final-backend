<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Puertos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('puertos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 50);
            $table->string('terminal', 50);
            $table->decimal('latitud', 16, 14);
            $table->decimal('longitud', 16, 14);
            $table->string('localidad');
            $table->string('departamento');
            $table->string('provincia');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('puertos');
    }
}
