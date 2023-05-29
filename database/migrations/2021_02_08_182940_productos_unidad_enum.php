<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class ProductosUnidadEnum extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE productos MODIFY COLUMN unidad ENUM('TONELADAS', 'UNIDADES')");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE productos MODIFY COLUMN unidad VARCHAR(255)");
    }
}
