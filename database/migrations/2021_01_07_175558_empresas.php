<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Empresas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->string ('cuit',                     50);
            $table->string ('razon_social',             50);
            $table->string ('telefono',                 50);
            $table->string ('email',                    50);
            $table->enum   ('perfil',               ['COMPRADOR','VENDEDOR','COMPRADOR_VENDEDOR']);
            $table->decimal('comision_comprador',   10,  2)->nullable();
            $table->decimal('comision_vendedor',    10,  2)->nullable();
            $table->enum   ('categoria_crediticia', ['VENDER','PREGUNTAR','NO_VENDER']);
            $table->enum   ('afinidad',             ['FIDEIZADO','NO_FIDEIZADO']);
            $table->integer('usuario_comercial_id',       )->nullable();
            $table->decimal('latitud',              16, 14)->nullable();
            $table->decimal('longitud',             16, 14)->nullable();
            $table->string ('direccion',                50)->nullable();
            $table->string ('localidad'                   )->nullable();
            $table->string ('departamento'                )->nullable();
            $table->string ('provincia'                   )->nullable();
            $table->boolean('habilitada'                  )->default(0);
            
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
        Schema::drop('empresas');
    }
}
