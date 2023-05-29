<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Helpers\CategoriasClienteHelper;

class CategoriasCliente extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categorias_cliente', function (Blueprint $table) {
            $table->id();
            $table->string("nombre");
            $table->enum("perfil", [
                CategoriasClienteHelper::PERFIL_COMPRADOR, 
                CategoriasClienteHelper::PERFIL_VENDEDOR
            ]);
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
        Schema::drop('categorias_cliente');
    }
}
