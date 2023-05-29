<?php

namespace App\Modules\Usuarios\Usuarios;

use App\Http\Controllers\Controller;
use App\Modules\Usuarios\Usuarios\User;
use App\Modules\Usuarios\Roles\RolHelper;
use Illuminate\Http\Request;

class HttpController extends Controller {

    public function index(Request $request) {
        $collection = User::listar(
            $request->get('page' ,    0),
            $request->get('limit'  , 10),
            $request->get('filtros', []),
            $request->get('ordenes', [])
        );

        return UserResource::collection($collection);
    }

    public function show($id): UserResource {
        $user = User::getById($id);
        return new UserResource($user);
    }

    public function update() {

    }

    public function actualizarDatosPersonales(ActualizarDatosPersonalesRequest $request): UserResource {
        $user = UserService::actualizarDatosPersonales(
            $request->user()->getKey(),
            $request->post('nombre'    ),
            $request->post('apellido'  ),
			$request->post('suscripto_notificaciones'),
            $request->post('telefono'  ),
            $request->file('foto', null)
        );

        return new UserResource($user);
    }

    public function actualizarDatosPorAdministrador(int $id, ActualizarDatosPorAdministradorRequest $request): UserResource {
        $this->validarAdministrador();

        $user = UserService::actualizarDatosPorAdministrador($id,
            $request->get('rol_id'),
            $request->get('oficina_id', null),
			$request->get('aprobacion_cbu'),
			$request->get('aprobacion_gerencia_comercial'),
			$request->get('aprobacion_dpto_creditos'),
			$request->get('aprobacion_dpto_finanzas'),
			$request->get('confirmacion_pagos')
        );

        return new UserResource($user);
    }

    /**
     *
     * @param int $id
     * @param Request $request
     * @return UserResource
     */
    public function habilitar(int $id, HabilitarRequest $request): UserResource {
        $this->validarAdministrador();

        $user = UserService::habilitar($id, $request->boolean('habilitar'));
        return new UserResource($user);
    }

    public function unsubscribeEmails(Request $request) {
    	$userId = $request->query('user_id');

		UserService::unsusbcribeFromEmailNotifications($userId);

		return view('pages.unsubscribed-from-emails');
	}
}
