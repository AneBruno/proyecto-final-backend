<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/*namespace App\Modules\GestionDeSaldos\Empresas;

use App\Modules\Extranet\Auth\AuthService;

/**
 * Description of EmpresasService
 *
 * @author kodear
 *
class EmpresasService {
    
    static public function obtenerPorUsuario(string $token, string $busqueda = '') {
        $empresas = AuthService::obtenerEmpresasUsuario($token);
        
        if ($busqueda) {
            $empresas = array_filter($empresas, function($empresa) use ($busqueda) {
                return strpos(strtolower($empresa['Empresa']), strtolower($busqueda)) !== false;
            });
        }
        
        return $empresas;
    }
}
*/