<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class HacerNotnullDatosEmpresas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('empresas')->where('id', 7)->update(['perfil' => 'COMPRADOR']);
        DB::table('empresas')->where('id', 9)->update(['perfil' => 'COMPRADOR']);
        Schema::table('empresas', function (Blueprint $table) {
            $table->unsignedBigInteger('usuario_comercial_id')->nullable(false)->change();
        });
        DB::statement('ALTER TABLE empresas MODIFY perfil ENUM("COMPRADOR", "VENDEDOR", "COMPRADOR_VENDEDOR") NOT NULL');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
