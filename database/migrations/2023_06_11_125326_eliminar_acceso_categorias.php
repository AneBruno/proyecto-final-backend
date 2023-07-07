<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EliminarAccesoCategorias extends Migration
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
				->where('nombre', '=', 'Categorías')
				->first();

			DB::table('accesos_roles')
				->where('acceso_id', '=', $acceso->id)
				->delete();

			DB::table('accesos')
				->where('nombre', '=', 'Categorías')
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
				'id' => 9,
				'nombre' => 'Categorías',
				'grupo' => 'Clientes',
				'uri' => 'clientes/categorias',
				'tipo' => 'menu',
				'orden' => 6
			]);

			DB::table('accesos_roles')->insert([
				[
					'rol_id' => 1,
					'acceso_id' => 9
				]
			]);
		});
    }
}
