<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AgregarAtributoDescripcionUbicacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::Table('empresas', function (Blueprint $table) {
            $table->string('descripcion_ubicacion')->nullable();
        });

        Schema::Table('establecimientos_empresa', function (Blueprint $table) {
            $table->string('descripcion_ubicacion')->nullable();
        });

        Schema::Table('puertos', function (Blueprint $table) {
            $table->string('descripcion_ubicacion')->nullable();
        });

        Schema::Table('oficinas_empresa', function (Blueprint $table) {
            $table->string('descripcion_ubicacion')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::Table('empresas', function (Blueprint $table) {
            $table->dropColumn('descripcion_ubicacion');
        });

        Schema::Table('establecimientos_empresa', function (Blueprint $table) {
            $table->dropColumn('descripcion_ubicacion');
        });

        Schema::Table('puertos', function (Blueprint $table) {
            $table->dropColumn('descripcion_ubicacion');
        });

        Schema::Table('oficinas_empresa', function (Blueprint $table) {
            $table->dropColumn('descripcion_ubicacion');
        });
    }
}
