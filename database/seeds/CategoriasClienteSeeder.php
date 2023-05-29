<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriasClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (DB::table('categorias_cliente')->count('id') == 0) {
            DB::transaction(function() {

                DB::table('categorias_cliente')->insert([
                    [
                        'id' => '1',
                        'nombre' => 'Productor',
                        'perfil' => 'vendedor',
                    ],
                    [
                        'id' => '2',
                        'nombre' => 'Acopio Cooperativa',
                        'perfil' => 'vendedor',
                    ],
                    [
                        'id' => '3',
                        'nombre' => 'Exportador',
                        'perfil' => 'comprador',
                    ],
                    [
                        'id' => '4',
                        'nombre' => 'Consumo',
                        'perfil' => 'comprador',
                    ],
                    [
                        'id' => '5',
                        'nombre' => 'Fábrica Soja',
                        'perfil' => 'comprador',
                    ],
                    [
                        'id' => '6',
                        'nombre' => 'Molino Harinero',
                        'perfil' => 'comprador',
                    ],
                    [
                        'id' => '7',
                        'nombre' => 'Malteria',
                        'perfil' => 'comprador',
                    ],
                    [
                        'id' => '8',
                        'nombre' => 'Feedlot',
                        'perfil' => 'comprador',
                    ],
                    [
                        'id' => '9',
                        'nombre' => 'Fábrica Girasol',
                        'perfil' => 'comprador',
                    ],
                ]);
            });
        }
    }
}
