<?php

use App\Modules\GestionDeSaldos\Cbus\Cbu;
use Illuminate\Support\Facades\Route;
use App\Modules\Usuarios\Usuarios\HttpController as UserController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/email', function() {
	$cbu = Cbu::inRandomOrder()->first();

	return new \App\Modules\GestionDeSaldos\Cbus\Emails\NuevaSolicitudCbu($cbu);
});

Route::get('suscripcion-emails-anulada', [UserController::class, 'unsubscribeEmails'])
	->name('unsubscribed-from-emails')
	->middleware('signed');

Route::get('/desuscripcion-emails', function() {
	return 4;
})->name('desuscripcion-emails');

Route::get('/', function () {
    return view('welcome');
});
