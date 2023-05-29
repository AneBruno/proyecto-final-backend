<?php

use App\Modules\GestionDeSaldos\SolicitudFormaPago;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ChangeToEcheqOnSolicitudesFormasPago extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

		DB::statement("ALTER TABLE solicitudes_formas_pago MODIFY COLUMN forma_pago ENUM('Cheque', 'E-check', 'E-cheq', 'Transferencia') NOT NULL");
        DB::statement("UPDATE solicitudes_formas_pago SET forma_pago = 'E-cheq' WHERE forma_pago = 'E-check'");
        DB::statement("ALTER TABLE solicitudes_formas_pago MODIFY COLUMN forma_pago ENUM('Cheque', 'E-cheq', 'Transferencia') NOT NULL");

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		DB::statement("ALTER TABLE solicitudes_formas_pago MODIFY COLUMN forma_pago ENUM('Cheque', 'E-check', 'E-cheq', 'Transferencia') NOT NULL");
		DB::statement("UPDATE solicitudes_formas_pago SET forma_pago = 'E-check' WHERE forma_pago = 'E-cheq'");
		DB::statement("ALTER TABLE solicitudes_formas_pago MODIFY COLUMN forma_pago ENUM('Cheque', 'E-check', 'Transferencia') NOT NULL");

	}
}
