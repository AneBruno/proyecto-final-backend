<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EliminarAccesoOrdenesDuplicado extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('accesos')
        ->where('id', '=', 13) // Condición para seleccionar el registro
        ->update(['nombre' => 'Órdenes de venta duplicado']);

        DB::transaction(function () {
			$acceso = DB::table('accesos')
				->where('nombre', '=', 'Órdenes de venta duplicado')
				->first();

			DB::table('accesos_roles')
				->where('acceso_id', '=', $acceso->id)
				->delete();

			DB::table('accesos')
				->where('nombre', '=', 'Órdenes de venta duplicado')
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
				'id' => 13,
				'nombre' => 'Órdenes de venta duplicado',
				'grupo' => 'Mercado',
				'uri' => 'mercado/ordenes',
				'tipo' => 'menu',
				'orden' => 3
			]);

			DB::table('accesos_roles')->insert([
				[
					'rol_id' => 2,
					'acceso_id' => 13
                ],
                [
					'rol_id' => 3,
					'acceso_id' => 13
                ],
                [
					'rol_id' => 4,
					'acceso_id' => 13
                ]
			]);
		});
    }
}
