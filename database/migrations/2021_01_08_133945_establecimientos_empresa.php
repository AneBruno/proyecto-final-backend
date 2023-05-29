<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EstablecimientosEmpresa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('establecimientos_empresa', function (Blueprint $table) {
            $table->id();
            $table->integer('empresa_id',            );
            $table->integer('puerto_id',            );
            $table->string ('nombre',              50);
            $table->enum   ('tipo',   ['CAMPO','PLANTA_ACOPIO']);
            $table->enum   ('propio', ['SI','NO']);
            $table->integer('hectareas_agricolas',   );
            $table->integer('hectareas_ganaderas',   );
            $table->integer('capacidad_acopio',      );
            $table->decimal('latitud',     16, 14)->nullable();
            $table->decimal('longitud',    16, 14)->nullable();
            $table->string ('direccion',       50)->nullable();
            $table->string ('localidad'          )->nullable();
            $table->string ('departamento'       )->nullable();
            $table->string ('provincia'          )->nullable();
            
            $table->index('empresa_id');
            $table->index('puerto_id');
            $table->index('tipo');
            $table->index('propio');
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
        Schema::drop('establecimientos_empresa');
    }
}
