<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class RemoveAccesoVolumenesEstimados extends Migration
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
				->where('nombre', '=', 'Volúmenes Estimados')
				->first();

			DB::table('accesos_roles')
				->where('acceso_id', '=', $acceso->id)
				->delete();

			DB::table('accesos')
				->where('nombre', '=', 'Volúmenes Estimados')
				->delete();
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
		DB::transaction(function () {
			DB::table('accesos')->insert([
				'id' => 8,
				'nombre' => 'Volúmenes Estimados',
				'grupo' => 'Clientes',
				'uri' => 'clientes/volumenes',
				'tipo' => 'menu',
				'orden' => 5
			]);

			DB::table('accesos_roles')->insert([
				[
					'rol_id' => 1,
					'acceso_id' => 8,
				],
				[
					'rol_id' => 2,
					'acceso_id' => 8,
				],
				[
					'rol_id' => 3,
					'acceso_id' => 8,
				],
				[
					'rol_id' => 4,
					'acceso_id' => 8,
				],
				[
					'rol_id' => 5,
					'acceso_id' => 8,
				],
			]);
		});
	}
}
