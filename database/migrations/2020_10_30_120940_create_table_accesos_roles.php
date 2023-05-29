<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateTableAccesosRoles extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accesos_roles', function (Blueprint $table) {
            $table->id();

            $table->foreignId('rol_id');
            $table->foreign('rol_id')->references('id')->on('roles');

            $table->foreignId('acceso_id');
            $table->foreign('acceso_id')->references('id')->on('accesos');
            $table->unique(['rol_id', 'acceso_id'], 'rol_id_acceso_id_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accesos_roles');
    }
}
