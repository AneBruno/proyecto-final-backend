<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CambiarDatosProductos2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('productos')->where('id', '1')->update(['nombre' => 'Soja']);
        DB::table('productos')->where('id', '2')->update(['nombre' => 'Maíz']);
        DB::table('productos')->where('id', '3')->update(['nombre' => 'Trigo']);
        DB::table('productos')->where('id', '4')->update(['nombre' => 'Cebada']);
        DB::table('productos')->where('id', '5')->update(['nombre' => 'Girasol']);
        
        DB::table('productos')->insert([
            'nombre' => 'Sorgo',
            'tipo_producto_id' => '1',
            'habilitado' =>'1'
        ]);
        
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
