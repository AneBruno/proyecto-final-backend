<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TiposProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        if (DB::table('tipos_producto')->count('id') == 0) {
            DB::table('tipos_producto')->insert([
                [
                    'id' => 1,
                    'nombre' => 'Cereales',
                ],
                [
                    'id'     => 2,
                    'nombre' => 'Fertilizantes',
                ],
                [
                    'id'     => 3,
                    'nombre' => 'Aceites',
                ],
                [
                    'id'     => 4,
                    'nombre' => 'Harinas',
                ],
                [
                    'id'     => 5,
                    'nombre' => 'Valores',
                ],
                [
                    'id'     => 6,
                    'nombre' => 'Ganado',
                ],
            ]);
        }
    }
}
