<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Modules\GestionDeSaldos;

use App\Exceptions\BusinessException;
use App\Modules\Extranet\Auth\AuthService;
use App\Modules\GestionDeSaldos\Emails\NuevaSolicitudCobro;
use App\Modules\GestionDeSaldos\Emails\NuevaSolicitudCobroAnticipo;
use App\Modules\Usuarios\Usuarios\User;
use App\Modules\Usuarios\Usuarios\UserService;
use Illuminate\Support\Facades\DB;

/**
 * Description of SolicitudesService
 *
 * @author kodear
 */
class SolicitudesService {
    
    static public function agregar(
        $token,
        $cuit,
        $tipo,
        $formasPago,
        $observaciones
    ) {
        
        $datosCliente  = AuthService::obtenerDatosCliente($token, $cuit);
		$razonSocial   = $datosCliente['Empresa'];
		$clienteEmail  = empty($datosCliente['Email']) ? null : $datosCliente['Email'];

		$nombreUsuario = AuthService::obtenerNombreUsuario($token);
        $usuarioRolId  = AuthService::obtenerTipoUsuario($token);
        $usuarioEmail  = AuthService::obtenerEmailUsuario($token);


        $montoTotal = 0;
        foreach($formasPago as $row) {
            $montoTotal += $row['monto'];
        }

        if ($tipo === Solicitud::TIPO_ANTICIPO) {
        	$estado_id = EstadoSolicitud::ID_SOLICITADO;
		}

        if ($tipo === Solicitud::TIPO_DISPONIBLE) {
            if ($montoTotal > ($datosCliente['Saldos']['Disponibles'] * -1)) {
                throw new BusinessException('No hay saldo suficiente');
            }

            $estado_id = EstadoSolicitud::ID_PENDIENTE;
        }
        
        if ($tipo === Solicitud::TIPO_COBRANZA_DEL_DIA) {
            if ($montoTotal > ($datosCliente['Saldos']['del Día'] * -1 * 0.95)) {
                throw new BusinessException('No hay saldo suficiente');
            }

            $estado_id = EstadoSolicitud::ID_PENDIENTE;
        }
        
        DB::beginTransaction();
            
        $solicitud = Solicitud::agregar($cuit, $razonSocial, $clienteEmail, $nombreUsuario, $usuarioEmail, $usuarioRolId, $tipo, $estado_id, $observaciones);

        foreach($formasPago as $row) {
            $fecha = substr($row['fecha'], 0, 10);
            SolicitudFormaPago::agregar($solicitud->id, $row['forma_pago'], (float) $row['monto'], $fecha, "{$row['cbu']}");
        }
        
        $solicitud->actualizarTotal($montoTotal);
        
        DB::commit();

		static::notificarNuevaSolicitudCobro($solicitud);

        return $solicitud;
    }

    static private function notificarNuevaSolicitudCobro(Solicitud $solicitud) {
    	$usuariosToNotificar = [];

    	if (in_array($solicitud->tipo, [Solicitud::TIPO_DISPONIBLE, Solicitud::TIPO_COBRANZA_DEL_DIA])) {
			$usuariosToNotificar = User::listar(1, 0, ['confirmacion_pagos' => 1]);
		}
		else if ($solicitud->tipo === Solicitud::TIPO_ANTICIPO) {
    		$usuariosToNotificar = User::listar(1, 0, ['aprobacion_gerencia_comercial' => 1]);
		}

    	foreach ($usuariosToNotificar as $user) {
    		// Es necesario recrear el mail cada vez que se envía debido a que se añaden los recipients al to cada vez
			// que itera
			if (in_array($solicitud->tipo, [Solicitud::TIPO_DISPONIBLE, Solicitud::TIPO_COBRANZA_DEL_DIA])) {
				$mail = new NuevaSolicitudCobro($solicitud);
			}
			else if ($solicitud->tipo === Solicitud::TIPO_ANTICIPO) {
				$mail = new NuevaSolicitudCobroAnticipo($solicitud);
			}

			UserService::enviarMail($user, $mail);
		}
	}
    
    static public function listarPorEmpresasAsociadasAUsuario(
        string $token, 
        int    $offset   = 0, 
        int    $limit    = 0, 
        array  $filtros  = [], 
        array  $ordenes  = [],
        array  $opciones = []
    ) {

        $filtros = array_merge($filtros, static::obtenerFiltrosPorUsuario($token));

        $ordenes = array_merge($ordenes, [
            'created_at' => 'DESC',
        ]);

        return Solicitud::listar($offset, $limit, $filtros, $ordenes, $opciones);
    }
    
    static public function obtenerFiltrosPorUsuario(string $token): array {
        $filtros     = [];
        $accounts    = AuthService::obtenerEmpresasUsuario($token);
        $tipoUsuario = AuthService::obtenerTipoUsuario($token);
        
        $cuits = [];

        foreach ($accounts as $cuenta) {
            $cuits[] = $cuenta['CUIT'];
        }

        $filtros['cuits'] = $cuits;
        
        if ($tipoUsuario === '7') {
            $filtros['condiciones_rol_7'] = true;
        }
        
        return $filtros;
    }
    
    static public function listarPor($offset = 0, $limit = 0, array $filtros = [], array $ordenes = [], array $opciones = []) {
        return Solicitud::listar($offset, $limit, $filtros, $ordenes, $opciones);
    }

    static public function getById(string $token, int $id, array $filtros, array $opciones): Solicitud
    {

        $filtros = array_merge($filtros, static::obtenerFiltrosPorUsuario($token));
        
        $solicitud = Solicitud::getById($id, $filtros, $opciones);
        
        return $solicitud;
    }

    static public function cancelarEstado(Solicitud $solicitud) {
        return $solicitud->actualizar(['estado_id' => EstadoSolicitud::ID_CANCELADO]);
    }
}
