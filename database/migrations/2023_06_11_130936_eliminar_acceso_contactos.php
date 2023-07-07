<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EliminarAccesoContactos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::transaction(function () {
			$acceso = DB::table('accesos')
				->where('nombre', '=', 'Contactos')
				->first();

			DB::table('accesos_roles')
				->where('acceso_id', '=', $acceso->id)
				->delete();

			DB::table('accesos')
				->where('nombre', '=', 'Contactos')
				->delete();
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::transaction(function () {
			DB::table('accesos')->insert([
				'id' => 6,
				'nombre' => 'Contactos',
				'grupo' => 'Clientes',
				'uri' => 'clientes/contactos',
				'tipo' => 'menu',
				'orden' => 2
			]);

			DB::table('accesos_roles')->insert([
				[
					'rol_id' => 1,
					'acceso_id' => 6
                ],
                [
					'rol_id' => 2,
					'acceso_id' => 6
				],[
					'rol_id' => 3,
					'acceso_id' => 6
                ],
                [
					'rol_id' => 4,
					'acceso_id' => 6
				],
                [
					'rol_id' => 5,
					'acceso_id' => 6
				],
                [
					'rol_id' => 6,
					'acceso_id' => 6
				]
			]);
		});
    }
}
