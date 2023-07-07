<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EliminarAccesoActividades extends Migration
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
				->where('nombre', '=', 'Actividades')
				->first();

			DB::table('accesos_roles')
				->where('acceso_id', '=', $acceso->id)
				->delete();

			DB::table('accesos')
				->where('nombre', '=', 'Actividades')
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
				'id' => 21,
				'nombre' => 'Actividades',
				'grupo' => 'Clientes',
				'uri' => 'clientes/actividades',
				'tipo' => 'menu',
				'orden' => 8
			]);

			DB::table('accesos_roles')->insert([
				[
					'rol_id' => 1,
					'acceso_id' => 21
				]
			]);
		});
    }
}
