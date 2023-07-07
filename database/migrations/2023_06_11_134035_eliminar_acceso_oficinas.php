<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EliminarAccesoOficinas extends Migration
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
				->where('nombre', '=', 'Oficinas')
				->first();

			DB::table('accesos_roles')
				->where('acceso_id', '=', $acceso->id)
				->delete();

			DB::table('accesos')
				->where('nombre', '=', 'Oficinas')
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
				'id' => 4,
				'nombre' => 'Oficinas',
				'grupo' => 'Usuarios',
				'uri' => 'oficinas',
				'tipo' => 'menu'
			]);

			DB::table('accesos_roles')->insert([
				[
					'rol_id' => 1,
					'acceso_id' => 4
                ]
			]);
		});
    }
}
