<?php

namespace App\Modules\Extranet\Auth;

use App\Exceptions\BusinessException;

class AuthService {
    
    static private $datos = null;
    
    static public function login(string $token) {
        try {
            $response = MagicClient::get('/accounts/' . $token);
        } catch (\Exception $e) {
            throw new BusinessException('no se pudo hacer login');
        }
        return $response;
    }
    
    static public function obtenerDatos(string $token) {
        
        // Si a futuro se necesita limpiar un el caché,
        // se desarrolla un método para hacerlo
        if (static::$datos === null) {
            static::$datos = static::login($token);
        }

        return static::$datos;
    }
    
    static public function obtenerDatosCliente(string $token, string $cuit): array {
        $datos = static::obtenerDatos($token);
        foreach($datos['accounts'] as $account) {
        
            if ($account['CUIT'] === $cuit) {
                return $account;
            }
        }
        
        throw new \Exception('No se encontró la cuenta solicitada');    
    }
    
    static public function obtenerNombreUsuario(string $token): string {
        $datos = static::obtenerDatos($token);
        return $datos['Usuario']['Descripcion'];
    }
    
    static public function obtenerTipoUsuario(string $token): string {
        $datos = static::obtenerDatos($token);
        return (int) $datos['Usuario']['TipoUsuario'];
    }

    static public function obtenerEmailUsuario(string $token): ?string {
    	$datos = static::obtenerDatos($token);

    	return empty($datos['Usuario']['Email']) ? null : $datos['Usuario']['Email'];
	}

    static public function obtenerEmpresasUsuario(string $token) {
        $datos = static::obtenerDatos($token);

        return $datos['accounts'];
    }
}