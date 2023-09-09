<?php

//use App\Modules\GestionDeSaldos\Cbus\Cbu;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'namespace' => '\\',
], function(Router $router) {
	// Basic Authentication
	$router->group([
		'prefix' => 'basic',
		'middleware' => ['auth.basic']
	], function (Router $router) {
		$router->post('clientes/empresas', [App\Modules\Clientes\Empresas\HttpController::class, 'store']);
	});

	

	$router->group([
		'prefix' => 'v1',
	], function(Router $router) {

		$router->group([
			'prefix' => 'auth'
		], function(Router $router){
			$router->post('registro',[App\Modules\Auth\HttpController::class, 'registro']);
			$router->post('login', [App\Modules\Auth\HttpController::class, 'login']);
		});

		// Protected Routes
		$router->group([
			'middleware' => 'auth:api'
		], function (Router $router) {
			$router->get('auth/getUser', [App\Modules\Auth\HttpController::class, 'getUser']);
			$router->post('auth:logout', [App\Modules\Auth\HttpController::class, 'logout']);
			$router->post('clientes/empresas', [App\Modules\Clientes\Empresas\HttpController::class, 'store']);

			$router->post('usuarios/actualizarDatosPersonales', [App\Modules\Usuarios\Usuarios\HttpController   ::class, 'actualizarDatosPersonales']);
			$router->post('usuarios/{id}:actualizarDatosPorAdministrador', [App\Modules\Usuarios\Usuarios\HttpController   ::class, 'actualizarDatosPorAdministrador']);
			$router->post('usuarios/{id}:habilitar', [App\Modules\Usuarios\Usuarios\HttpController   ::class, 'habilitar']);
			$router->put('productos/{producto}/habilitar', [App\Modules\Productos\Productos\HttpController ::class, 'habilitar']);
			$router->put('productos/{producto}/deshabilitar', [App\Modules\Productos\Productos\HttpController ::class, 'deshabilitar']);
			$router->put('clientes/empresas/{empresa}/habilitar', [App\Modules\Clientes\Empresas\HttpController   ::class, 'habilitar']);
			$router->put('clientes/empresas/{empresa}/deshabilitar', [App\Modules\Clientes\Empresas\HttpController   ::class, 'deshabilitar']);
			

			$router->patch('mercado/posiciones/{posicion}/estado', [App\Modules\Mercado\Posiciones\HttpController  ::class, 'cambiarEstado']);
			$router->get('mercado/ordenes/localidades', [App\Modules\Mercado\Ordenes\HttpController     ::class, 'listarLocalidades']);
			$router->patch('mercado/ordenes/{orden}/estado', [App\Modules\Mercado\Ordenes\HttpController     ::class, 'cambiarEstado']);
			$router->post('mercado/ordenes/{orden}:cerrarSlip', [App\Modules\Mercado\Ordenes\HttpController     ::class, 'cerrarSlip']);
			$router->patch('puertos/{puerto}/estado', [App\Modules\Puertos\HttpController             ::class, 'cambiarEstado']);
			$router->put('mercado/condicionesPago/{condicion}/habilitar', [App\Modules\Mercado\CondicionesPago\HttpController   ::class, 'habilitar']);
			$router->put('mercado/condicionesPago/{condicion}/deshabilitar', [App\Modules\Mercado\CondicionesPago\HttpController   ::class, 'deshabilitar']);
			$router->post('mercado/panel:cambiarEstados', [App\Modules\Mercado\Panel\HttpController       ::class, 'cambiarEstados']);
			//$router->get('mercado/historial', [App\Modules\Mercado\Ordenes\HttpController::class, 'listarNegocios']);

			$router->apiResources([
				'usuarios' => '\\' . App\Modules\Usuarios\Usuarios\HttpController         ::class,
				'roles' => '\\' . App\Modules\Usuarios\Roles\HttpController            ::class,
				'productos' => '\\' . App\Modules\Productos\Productos\HttpController       ::class,
				'puertos' => '\\' . App\Modules\Puertos\HttpController                   ::class,

                'clientes/empresas' =>  App\Modules\Clientes\Empresas\HttpController::class,

				'mercado/condiciones-pago' => '\\' . App\Modules\Mercado\CondicionesPago\HttpController   ::class,
				'mercado/posiciones' => '\\' . App\Modules\Mercado\Posiciones\HttpController        ::class,
				'mercado/ordenes/estados' => '\\' . App\Modules\Mercado\Ordenes\Estado\HttpController    ::class,
				'mercado/panel' => '\\' . App\Modules\Mercado\Panel\HttpController             ::class,
				'mercado/ordenes' => '\\' . App\Modules\Mercado\Ordenes\HttpController           ::class,
				'mercado/cosechas' => '\\' . App\Modules\Mercado\Cosechas\HttpController          ::class,
				'mercado/historial' => '\\' . App\Modules\Mercado\Ordenes\HttpController           ::class,

			]);

			
			$empresaClass = \App\Modules\Clientes\Empresas\Empresa::class;
			$router->group([
				'prefix' => 'clientes/empresas/{empresa}/',
			], function (Router $router) {
				$router->apiResources([
				]);
			});
		});
	});
});

