<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Modules\GestionDeSaldos\Cbus;

use App\Modules\Extranet\Auth\AuthService;
use App\Modules\GestionDeSaldos\Cbus\Emails\NuevaSolicitudCbu;
use App\Modules\Usuarios\Usuarios\User;
use App\Modules\Usuarios\Usuarios\UserService;


/**
 * Description of SolicitudesService
 *
 * @author kodear
 */
class CbusService {
    
    static public function agregar(
        $token, 
        $cuit, 
        $mail, 
        $banco, 
        $cbu
    ) {
        $datosCliente = AuthService::obtenerDatosCliente($token, $cuit);
        $razonSocial = $datosCliente['Empresa'];
		$usuarioSolicitante = AuthService::obtenerNombreUsuario($token);

        $cbu = Cbu::agregar(
            $cuit,
            $razonSocial,
            $mail,
            $banco,
            $cbu,
			$usuarioSolicitante
        );

        //@ToDO: Enviar notificacion por mail
		static::notificarAltaSolicitudCbu($cbu);
                        
        return $cbu;
    }


    static private function notificarAltaSolicitudCbu($cbu) {
		$usuariosToNotificar = User::listar(1, 0, ['aprobacion_cbu' => 1]);

		foreach ($usuariosToNotificar as $user) {
			UserService::enviarMail($user, new NuevaSolicitudCbu($cbu));
		}
	}


    static public function listarPor(
        $token,
        $offset = 0,
        $limit = 0,
        array $filtros = [],
        array $ordenes = [],
        array $opciones = []
    ) {
        
        return Cbu::listar($offset, $limit, $filtros, $ordenes, $opciones);
    }

    static public function getById(int $id): Cbu
    {
        $cbu = Cbu::getById($id);
        
        return $cbu;
    }

    static public function estadoProcesado(Cbu $cbu) {
        return $cbu->actualizar(['estado' => Cbu::ESTADO_PROCESADO]);
    }
}
