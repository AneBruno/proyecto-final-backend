<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class NotnullCamposPosiciones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mercado_posiciones', function (Blueprint $table) {
            
            $table->unsignedBigInteger('puerto_id')->nullable(false)->change();
            $table->unsignedBigInteger('condicion_pago_id')->nullable(false)->change();
            $table->unsignedBigInteger('cosecha_id')->nullable(false)->change();
    });
        DB::statement('ALTER TABLE mercado_posiciones MODIFY moneda ENUM("USD", "AR$") NOT NULL');
        DB::statement('ALTER TABLE mercado_posiciones MODIFY precio DOUBLE PRECISION NOT NULL');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mercado_posiciones', function (Blueprint $table) {

            $table->unsignedBigInteger('puerto_id')->nullable()->change();
            $table->unsignedBigInteger('condicion_pago_id')->nullable()->change();
            $table->unsignedBigInteger('cosecha_id')->nullable()->change();
    });
    DB::statement('ALTER TABLE mercado_posiciones MODIFY moneda ENUM("USD", "AR$")');
    DB::statement('ALTER TABLE mercado_posiciones MODIFY precio DOUBLE PRECISION');
    }
}
