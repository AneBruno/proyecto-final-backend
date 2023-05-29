<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ActualizarGeolocalizaciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mercado_ordenes', function(Blueprint $table) {

        DB::beginTransaction();

        DB::statement("
            UPDATE puertos SET departamento = REPLACE(departamento, 'Departamento', ''),
                   departamento = REPLACE(departamento, ' Department', ''),
                   provincia    = REPLACE(provincia,    ' Province',   ''),
                   provincia    = REPLACE(provincia,    'Provincia de ',   '')

            WHERE departamento LIKE '% Department%'
               OR departamento LIKE '%Departamento %'
               OR provincia LIKE '% Province%'
               OR provincia LIKE '%Provincia de %';
               ");


        DB::statement("
            UPDATE establecimientos_empresa SET departamento = REPLACE(departamento, 'Departamento ', ''),
                   departamento = REPLACE(departamento, ' Department', ''),
                   provincia    = REPLACE(provincia,    ' Province',   ''),
                   provincia    = REPLACE(provincia,    'Provincia de ',   '')

            WHERE departamento LIKE '% Department%'
               OR departamento LIKE '%Departamento %'
               OR provincia LIKE '% Province%'
               OR provincia LIKE '%Provincia de %';
               ");

        DB::statement("
            UPDATE mercado_ordenes SET
                   departamento_destino = REPLACE(departamento_destino, 'Departamento ', ''),
                   departamento_destino = REPLACE(departamento_destino, ' Department', ''),
                   provincia_destino    = REPLACE(provincia_destino,    ' Province',   ''),
                   provincia_destino    = REPLACE(provincia_destino,    'Provincia de ',   ''),
                   departamento_procedencia = REPLACE(departamento_procedencia, 'Departamento ', ''),
                   departamento_procedencia = REPLACE(departamento_procedencia, ' Department', ''),
                   provincia_procedencia    = REPLACE(provincia_procedencia,    ' Province',   ''),
                   provincia_procedencia    = REPLACE(provincia_procedencia,    'Provincia de ',   '')


            WHERE departamento_destino LIKE '% Department%'
               OR departamento_destino LIKE '%Departamento %'
               OR provincia_destino LIKE '% Province%'
               OR provincia_destino LIKE '%Provincia de %'
               OR departamento_procedencia LIKE '% Department%'
               OR departamento_procedencia LIKE '%Departamento %'
               OR provincia_procedencia LIKE '% Province%'
               OR provincia_procedencia LIKE '%Provincia de %';

               ");

        DB::statement("
            UPDATE mercado_posiciones SET departamento_destino = REPLACE(departamento_destino, 'Departamento ', ''),
                   departamento_destino = REPLACE(departamento_destino, ' Department', ''),
                   provincia_destino    = REPLACE(provincia_destino,    ' Province',   ''),
                   provincia_destino    = REPLACE(provincia_destino,    'Provincia de ',   '')

            WHERE departamento_destino LIKE '% Department%'
               OR departamento_destino LIKE '%Departamento %'
               OR provincia_destino LIKE '% Province%'
               OR provincia_destino LIKE '%Provincia de %';
               ");

        DB::statement("
            UPDATE oficinas_empresa SET departamento = REPLACE(departamento, 'Departamento ', ''),
                   departamento = REPLACE(departamento, ' Department', ''),
                   provincia    = REPLACE(provincia,    ' Province',   ''),
                   provincia    = REPLACE(provincia,    'Provincia de ',   '')

            WHERE departamento LIKE '% Department%'
               OR departamento LIKE '%Departamento %'
               OR provincia LIKE '% Province%'
               OR provincia LIKE '%Provincia de %';
               ");

            $table->string('departamento_destino', 255)->default('Rosario')->change();

            $table->string('departamento_procedencia', 255)->default('Rosario')->change();

        });

        DB::commit();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mercado_ordenes', function(Blueprint $table) {
            $table->string('departamento_destino', 255)->default('Rosario Department')->change();

            $table->string('departamento_procedencia', 255)->default('Rosario Department')->change();

        });
    }
}
