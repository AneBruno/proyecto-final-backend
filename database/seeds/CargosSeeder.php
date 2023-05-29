<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CargosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (DB::table('cargos')->count('id') == 0) {

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
    }
}
