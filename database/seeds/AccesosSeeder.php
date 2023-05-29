<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AccesosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (DB::table('accesos')->count('id') == 0) {
            DB::transaction(function() {

                DB::table('accesos')->insert([
                    [
                        'id' => 2,
                        'nombre' => 'Panel Mercado + CRM',
                        'grupo' => 'Home'

                    ],
                    [
                        'id' => 3,
                        'nombre' => 'Usuarios',
                        'grupo' => 'Usuarios'
                    ],
                    [
                        'id' => 4,
                        'nombre' => 'Oficinas',
                        'grupo' => 'Usuarios'
                    ],
                    [
                        'id' => 5,
                        'nombre' => 'Clientes',
                        'grupo' => 'Clientes'
                    ],
                    [
                        'id' => 6,
                        'nombre' => 'Contactos',
                        'grupo' => 'Clientes'
                    ],
                    [
                        'id' => 7,
                        'nombre' => 'Eventos CRM',
                        'grupo' => 'Clientes'
                    ],
                    [
                        'id' => 8,
                        'nombre' => 'Volúmenes Estimados',
                        'grupo' => 'Clientes'
                    ],
                    [
                        'id' => 9,
                        'nombre' => 'Categorías',
                        'grupo' => 'Clientes'
                    ],
                    [
                        'id' => 10,
                        'nombre' => 'Puertos',
                        'grupo' => 'Clientes'
                    ],
                    [
                        'id' => 11,
                        'nombre' => 'Cargos',
                        'grupo' => 'Clientes'
                    ],
                    [
                        'id' => 12,
                        'nombre' => 'Posiciones',
                        'grupo' => 'Mercado'
                    ],
                    [
                        'id' => 13,
                        'nombre' => 'Órdenes',
                        'grupo' => 'Mercado'
                    ],
                    [
                        'id' => 14,
                        'nombre' => 'Productos',
                        'grupo' => 'Mercado'
                    ],
                    [
                        'id' => 15,
                        'nombre' => 'Calidades por producto',
                        'grupo' => 'Mercado'
                    ],
                    [
                        'id' => 16,
                        'nombre' => 'Cosechas',
                        'grupo' => 'Mercado'
                    ]
                ]);
            });
        }


        if (DB::table('accesos_roles')->count('id') == 0) {
            DB::transaction(function () {

                DB::table('accesos_roles')->insert([
                    // Administrador de plataforma
                    [ 'rol_id' => 1, 'acceso_id' => 3],
                    [ 'rol_id' => 1, 'acceso_id' => 4],
                    [ 'rol_id' => 1, 'acceso_id' => 5],
                    [ 'rol_id' => 1, 'acceso_id' => 6],
                    [ 'rol_id' => 1, 'acceso_id' => 7],
                    [ 'rol_id' => 1, 'acceso_id' => 8],
                    [ 'rol_id' => 1, 'acceso_id' => 9],
                    [ 'rol_id' => 1, 'acceso_id' => 10],
                    [ 'rol_id' => 1, 'acceso_id' => 11],
                    [ 'rol_id' => 1, 'acceso_id' => 14],
                    [ 'rol_id' => 1, 'acceso_id' => 15],
                    [ 'rol_id' => 1, 'acceso_id' => 16],

                    // Responsable Comercial
                    [ 'rol_id' => 2, 'acceso_id' => 5],
                    [ 'rol_id' => 2, 'acceso_id' => 6],
                    [ 'rol_id' => 2, 'acceso_id' => 7],
                    [ 'rol_id' => 2, 'acceso_id' => 8],
                    [ 'rol_id' => 2, 'acceso_id' => 12],
                    [ 'rol_id' => 2, 'acceso_id' => 13],

                    // Comercial
                    [ 'rol_id' => 3, 'acceso_id' => 5],
                    [ 'rol_id' => 3, 'acceso_id' => 6],
                    [ 'rol_id' => 3, 'acceso_id' => 7],
                    [ 'rol_id' => 3, 'acceso_id' => 8],
                    [ 'rol_id' => 3, 'acceso_id' => 12],
                    [ 'rol_id' => 3, 'acceso_id' => 13],

                    // Representante
                    [ 'rol_id' => 4, 'acceso_id' => 5],
                    [ 'rol_id' => 4, 'acceso_id' => 6],
                    [ 'rol_id' => 4, 'acceso_id' => 7],
                    [ 'rol_id' => 4, 'acceso_id' => 8],
                    [ 'rol_id' => 4, 'acceso_id' => 12],
                    [ 'rol_id' => 4, 'acceso_id' => 13],

                    // Administrativo
                    [ 'rol_id' => 5, 'acceso_id' => 5],
                    [ 'rol_id' => 5, 'acceso_id' => 6],
                    [ 'rol_id' => 5, 'acceso_id' => 7],
                    [ 'rol_id' => 5, 'acceso_id' => 8],

                    // Soporte Equipo NDG
                    [ 'rol_id' => 6, 'acceso_id' => 5],
                    [ 'rol_id' => 6, 'acceso_id' => 6],
                    [ 'rol_id' => 6, 'acceso_id' => 7],
                    [ 'rol_id' => 6, 'acceso_id' => 12]
                ]);
            });
        }
    }
}
