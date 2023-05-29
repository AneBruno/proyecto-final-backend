<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMailSolicitanteMailClienteOnSolicitudesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('solicitudes', function($table) {
        	$table->string('mail_cliente')->nullable();
        	$table->string('mail_usuario')->nullable();
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::table('solicitudes', function($table) {
			$table->dropColumn(['mail_cliente', 'mail_usuario']);
		});
    }
}
