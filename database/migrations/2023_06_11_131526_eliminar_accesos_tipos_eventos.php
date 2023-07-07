<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EliminarAccesosTiposEventos extends Migration
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
				->where('nombre', '=', 'Tipos de eventos CRM')
				->first();

			DB::table('accesos_roles')
				->where('acceso_id', '=', $acceso->id)
				->delete();

			DB::table('accesos')
				->where('nombre', '=', 'Tipos de eventos CRM')
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
				'id' => 32,
				'nombre' => 'Tipos de eventos CRM',
				'grupo' => 'Clientes',
				'uri' => 'clientes/tipos-eventos',
				'tipo' => 'menu',
				'orden' => 3
			]);

			DB::table('accesos_roles')->insert([
				[
					'rol_id' => 1,
					'acceso_id' => 32
				]
			]);
		});
    }
}
