<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CamposExtrasMercadoOrdenes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mercado_ordenes', function (Blueprint $table) {
            
            $table->string('localidad_procedencia')->nullable()->default(null)->change();
            $table->string('departamento_procedencia')->nullable()->default(null)->change();
            $table->string('provincia_procedencia')->nullable()->default(null)->change();
            $table->decimal('latitud_procedencia', 11, 8)->nullable()->default(null)->change();
            $table->decimal('longitud_procedencia', 11, 8)->nullable()->default(null)->change();
    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mercado_ordenes', function (Blueprint $table) {
            // Revertir el cambio y restaurar el valor por defecto a 0
           // $table->boolean('a_fijar')->default(0)->change();
           $table->string('localidad_procedencia')->nullable(false)->default('Rosario')->change();
            $table->string('departamento_procedencia')->nullable(false)->default('Rosario')->change();
            $table->string('provincia_procedencia')->nullable(false)->default('Santa Fe')->change();
            $table->decimal('latitud_procedencia', 11, 8)->nullable(false)->default(-32.95870220)->change();
            $table->decimal('longitud_procedencia', 11, 8)->nullable(false)->default(-60.69304160)->change();
        });
    }
}
