<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OficinasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        if (DB::table('oficinas')->count('id') == 0) {
            DB::table('oficinas')->insert([
                [
                    'id' => 1,
                    'nombre' => 'Buenos Aires',
                    'oficina_madre_id' => null,
                ],
                [
                    'id'               => 2,
                    'nombre'           => 'Bahía Blanca',
                    'oficina_madre_id' => 1,
                ],
                [
                    'id'               => 3,
                    'nombre'           => 'Rosario',
                    'oficina_madre_id' => 1,
                ],
                [
                    'id'               => 4,
                    'nombre'           => 'Necochea',
                    'oficina_madre_id' => 1,
                ],
                [
                    'id'               => 5,
                    'nombre'           => 'Pringles',
                    'oficina_madre_id' => 2,
                ],
                [
                    'id'               => 6,
                    'nombre'           => 'Pigüe',
                    'oficina_madre_id' => 2,
                ],
                [
                    'id'               => 7,
                    'nombre'           => 'Laboulaye',
                    'oficina_madre_id' => 3,
                ],
                [
                    'id'               => 8,
                    'nombre'           => 'Colon (Entre Ríos)',
                    'oficina_madre_id' => 3,
                ],
                [
                    'id'               => 9,
                    'nombre'           => 'Chivilcoy',
                    'oficina_madre_id' => 3,
                ],
                [
                    'id'               => 10,
                    'nombre'           => 'Villaguay',
                    'oficina_madre_id' => 3,
                ],
                [
                    'id'               => 11,
                    'nombre'           => 'Basavilvaso',
                    'oficina_madre_id' => 3,
                ],
                [
                    'id'               => 12,
                    'nombre'           => 'Goya',
                    'oficina_madre_id' => 3,
                ],
                [
                    'id'               => 13,
                    'nombre'           => 'Bovril',
                    'oficina_madre_id' => 3,
                ],
                [
                    'id'               => 14,
                    'nombre'           => 'Jesús María',
                    'oficina_madre_id' => 1,
                ],
            ]);
        }
    }
}
