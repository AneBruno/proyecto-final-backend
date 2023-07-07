<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EliminarCamposPuertos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('puertos', function (Blueprint $table) {
            $table->dropColumn('latitud');
            $table->dropColumn('longitud');
            $table->dropColumn('departamento');
            $table->dropColumn('codigo_postal');
            $table->dropColumn('direccion');
            $table->dropColumn('terminal');
            $table->dropColumn('descripcion_ubicacion');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('puertos', function (Blueprint $table) {
            $table->addColumn('decimal(16,14)', 'latitud');
            $table->addColumn('decimal(16,14)', 'longitud');
            $table->addColumn('varchar(255)', 'departamento');
            $table->addColumn('varchar(255)', 'codigo_postal');
            $table->addColumn('varchar(128)', 'direccion');
            $table->addColumn('varchar(128)', 'terminal');
            $table->addColumn('varchar(255)', 'descripcion_ubicacion');
        });
    }
}
