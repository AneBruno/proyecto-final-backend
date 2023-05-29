<?php

use App\Modules\Usuarios\Accesos\Acceso;
use App\Modules\Usuarios\Accesos\AccesoRol;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AsignarEmpresasHabilitarAAdministradorPlataforma extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	$acceso = Acceso::getOne(['nombre' => 'empresas_habilitar']);

        $accesoRol = AccesoRol::where([
        	'rol_id' => 1,
			'acceso_id' => $acceso->id
		])->first();

        if (!$accesoRol) {
        	DB::table('accesos_roles')->insert([
        		'rol_id' => 1,
				'acceso_id' => $acceso->id
			]);
		}
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		$acceso = Acceso::getOne(['nombre' => 'empresas_habilitar']);

		DB::table('accesos_roles')->where([
			'rol_id' => 1,
			'acceso_id' => $acceso->id
		])->delete();
    }
}
