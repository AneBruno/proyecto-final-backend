<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class OficinasEmpresa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oficinas_empresa', function (Blueprint $table) {
            $table->id();
            $table->integer('empresa_id',       );
            $table->string ('nombre',          50);
            $table->string ('telefono',        50);
            $table->string ('email',           50);
            $table->decimal('latitud',     16, 14)->nullable();
            $table->decimal('longitud',    16, 14)->nullable();
            $table->string ('direccion',       50)->nullable();
            $table->string ('localidad'          )->nullable();
            $table->string ('departamento'       )->nullable();
            $table->string ('provincia'          )->nullable();
            
            $table->index('empresa_id');
            $table->index('deleted_at');
            
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
        Schema::drop('oficinas_empresa');
    }
}
