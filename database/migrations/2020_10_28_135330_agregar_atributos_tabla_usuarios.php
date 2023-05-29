<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AgregarAtributosTablaUsuarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('usuarios', function(Blueprint $table) {
            $table->foreignId('rol_id');
            $table->foreign('rol_id')->references('id')->on('roles');

            $table->foreignId('oficina_id')->nullable();
            $table->foreign('oficina_id')->references('id')->on('oficinas');

            $table->foreignId('provider_id')->nullable();
            $table->string('provider_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::transaction(function() {
            Schema::table('usuarios', function(Blueprint $table) {
                $table->dropForeign('usuarios_oficina_id_foreign');
                $table->dropForeign('usuarios_rol_id_foreign');

                $table->dropColumn(['rol_id', 'oficina_id', 'provider_id', 'provider_name']);
            });
        });
    }
}
