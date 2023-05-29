<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class SeedCargos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('cargos')->insert([
            [
                'id' => 1,
                'nombre' => 'Comercial',
            ],
            [
                'id' => 2,
                'nombre' => 'Logística'
            ],
            [
                'id' => 3,
                'nombre' => 'Administración'
            ],
            [
                'id' => 4,
                'nombre' => 'Gerencia'
            ],
            [
                'id' => 5,
                'nombre' => 'Director'
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
        DB::table('cargos')->truncate();
    }
}
