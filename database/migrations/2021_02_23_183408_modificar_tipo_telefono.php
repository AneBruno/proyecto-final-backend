<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModificarTipoTelefono extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('empresas', function(Blueprint $table) {
            $table->bigInteger('telefono')->change();
        });

        Schema::table('contactos', function(Blueprint $table) {
            $table->bigInteger('telefono_fijo')->change();
            $table->bigInteger('telefono_celular')->change();
        });

        Schema::table('oficinas_empresa', function(Blueprint $table) {
            $table->bigInteger('telefono')->change();
        });

        Schema::table('usuarios', function(Blueprint $table) {
            $table->bigInteger('telefono')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('empresas', function(Blueprint $table) {
            $table->string('telefono')->change();
        });

        Schema::table('contactos', function(Blueprint $table) {
            $table->string('telefono_fijo')->change();
            $table->string('telefono_celular')->change();
        });

        Schema::table('oficinas_empresa', function(Blueprint $table) {
            $table->string('telefono')->change();
        });

        Schema::table('usuarios', function(Blueprint $table) {
            $table->string('telefono')->change();
        });
    }
}
