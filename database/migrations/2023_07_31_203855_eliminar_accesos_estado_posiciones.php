<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EliminarAccesosEstadoPosiciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::transaction(function () {
            DB::table('accesos_roles')
				->where('acceso_id', '=', 26)
				->delete();

            DB::table('accesos_roles')
            ->where('acceso_id', '=', 27)
            ->delete();
		});
        DB::transaction(function () {
            DB::table('accesos')
				->where('id', '=', 26)
				->delete();

            DB::table('accesos')
            ->where('id', '=', 27)
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
        //
    }
}
