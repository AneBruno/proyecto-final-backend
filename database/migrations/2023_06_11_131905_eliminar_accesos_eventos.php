<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EliminarAccesosEventos extends Migration
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
				->where('nombre', '=', 'Eventos CRM')
				->first();

			DB::table('accesos_roles')
				->where('acceso_id', '=', $acceso->id)
				->delete();

			DB::table('accesos')
				->where('nombre', '=', 'Eventos CRM')
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
				'id' => 7,
				'nombre' => 'Eventos CRM',
				'grupo' => 'Clientes',
				'uri' => 'clientes/eventos',
				'tipo' => 'menu',
				'orden' => 4
			]);

			DB::table('accesos_roles')->insert([
				[
					'rol_id' => 1,
					'acceso_id' => 7
                ],
                [
					'rol_id' => 2,
					'acceso_id' => 7
				],[
					'rol_id' => 3,
					'acceso_id' => 7
                ],
                [
					'rol_id' => 4,
					'acceso_id' => 7
				],
                [
					'rol_id' => 5,
					'acceso_id' => 7
				]
			]);
		});
    }
}
