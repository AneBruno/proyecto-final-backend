<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrearTablaContactos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contactos', function (Blueprint $table) {
            $table->id();

            $table->string('nombre',50);
            $table->string('telefono_celular', 20);
            $table->string('telefono_fijo', 20);
            $table->string('email', 50)->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->integer('nivel_jerarquia');
            $table->string('direccion', 50)->nullable();

            $table->unsignedBigInteger('cargo_id');
            $table->foreign('cargo_id')->references('id')->on('cargos');

             $table->foreignId('empresa_id')->nullable();

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
        Schema::dropIfExists('contactos');
    }
}
