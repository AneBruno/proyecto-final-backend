<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CrearTablaEmpresasTiposArchivos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas_tipos_archivos', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion');
            $table->timestamps();
        });

        DB::table('empresas_tipos_archivos')->insert([
            [
                'id' => 1,
                'descripcion' => 'Constancia de inscripción en Afip',
            ],
            [
                'id' => 2,
                'descripcion' => 'Constancia de inscripción en IIBB'
            ],
            [
                'id' => 3,
                'descripcion' => 'CM05 (convenio multilateral)'
            ],
            [
                'id' => 4,
                'descripcion' => 'Certificados de exclusión'
            ],
            [
                'id' => 5,
                'descripcion' => 'Datos Bancarios'
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empresas_tipos_archivos');
    }
}
