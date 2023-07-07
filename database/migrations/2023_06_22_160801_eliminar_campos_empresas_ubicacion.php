<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EliminarCamposEmpresasUbicacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('empresas', function (Blueprint $table) {
            $table->dropColumn('latitud');
            $table->dropColumn('longitud');
            $table->dropColumn('codigo_postal');
            $table->dropColumn('descripcion_ubicacion');
            $table->dropColumn('departamento');
            $table->dropColumn('abreviacion');
            $table->dropColumn('deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('empresas', function (Blueprint $table) {
            $table->addColumn('decimal(16,14)', 'latitud');
            $table->addColumn('decimal(16,14)', 'longitud');
            $table->addColumn('varchar(255)', 'codigo_postal');
            $table->addColumn('varchar(255)', 'descripcion_ubicacion');
            $table->addColumn('varchar(255)', 'departamento');
            $table->addColumn('varchar(255)', 'abreviacion');
            $table->addColumn('timestamp', 'deleted_at');
        });
    }
}
