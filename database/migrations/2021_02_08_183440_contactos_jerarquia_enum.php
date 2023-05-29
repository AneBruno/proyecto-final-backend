<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class ContactosJerarquiaEnum extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE contactos MODIFY COLUMN nivel_jerarquia ENUM('1','2','3','4','5')");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE contactos MODIFY COLUMN nivel_jerarquia INT(11)  ");
    }
}
