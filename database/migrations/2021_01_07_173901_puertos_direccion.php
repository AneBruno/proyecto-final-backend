<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PuertosDireccion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('puertos', function(Blueprint $table) {
            $table->decimal('latitud', 16, 14)->nullable()->change();
            $table->decimal('longitud', 16, 14)->nullable()->change();
            $table->string('direccion', 50)->nullable()->after('longitud');
            $table->string('localidad')->nullable()->change();;
            $table->string('departamento')->nullable()->change();;
            $table->string('provincia')->nullable()->change();;
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
            $table->removeColumn('direccion');
        });
    }
}
