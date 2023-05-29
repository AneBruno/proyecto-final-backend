<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ModificarCamposTablaEmpresas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::beginTransaction();
        Schema::table('empresas', function(Blueprint $table) {
            $table->string('telefono',50)->nullable()->change();
            $table->string('email',50)->nullable()->change();
        });

        DB::statement("ALTER TABLE empresas MODIFY COLUMN perfil ENUM('COMPRADOR', 'VENDEDOR', 'COMPRADOR_VENDEDOR') NULL");


        DB::commit();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::beginTransaction();
        Schema::table('empresas', function(Blueprint $table) {
            $table->string('telefono',50)->nullable(false)->change();
            $table->string('email',50)->nullable(false)->change();
        });

        DB::statement("ALTER TABLE empresas MODIFY COLUMN perfil ENUM('COMPRADOR', 'VENDEDOR', 'COMPRADOR_VENDEDOR') NOT NULL");


        DB::commit();
    }
}
