<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CodigoPostal extends Migration
{
    private $tablas = [
        'empresas',
        'puertos',
        'oficinas_empresa',
        'establecimientos_empresa',
    ];
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach($this->tablas as $tabla) {
            Schema::table($tabla, function(Blueprint $table) {
                $table->string('codigo_postal')
                        ->nullable()->after('longitud');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        foreach($this->tablas as $tabla) {
            Schema::table($tabla, function(Blueprint $table) {
                $table->removeColumn('codigo_postal');
            });
        }
    }
}
