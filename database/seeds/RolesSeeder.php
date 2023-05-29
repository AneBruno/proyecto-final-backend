<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (DB::table('roles')->count('id') == 0) {
            DB::transaction(function() {

                DB::table('roles')->insert([
                    [
                        'id' => 1,
                        'nombre' => 'Administrador de Plataforma',
                    ],
                    [
                        'id' => 2,
                        'nombre' => 'Responsable Comercial'
                    ],
                    [
                        'id' => 3,
                        'nombre' => 'Comercial'
                    ],
                    [
                        'id' => 4,
                        'nombre' => 'Representante'
                    ],
                    [
                        'id' => 5,
                        'nombre' => 'Administrativo'
                    ],
                    [
                        'id' => 6,
                        'nombre' => 'Soporte Equipo NDG'
                    ]
                ]);
            });
        }
    }
}
