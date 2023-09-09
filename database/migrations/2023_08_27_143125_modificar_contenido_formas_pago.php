<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


class ModificarContenidoFormasPago extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('condiciones_pago')->where('id', '3')->update(['descripcion' => 'Contra entrega']);
        DB::table('condiciones_pago')
        ->whereIn('id', [4,5])
        ->delete();
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
