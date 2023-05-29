<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Modules\Usuarios\Accesos;

use App\Modules\Usuarios\Usuarios\User;
use Illuminate\Support\Facades\DB;

/**
 * Description of AccesosService
 *
 * @author salomon
 */
class AccesosService {
    
    static public function verificarAcceso(User $user, string $nombre_acceso): bool {
        $rol_id = $user->rol_id;
        $cant   = AccesoRol::contar([
            'rol_id' => $rol_id,
            'nombre' => $nombre_acceso,
            'tipo'   => 'accion',
        ]);
        
        return $cant > 0;
    }
    
    static public function asignarRolId(Acceso $acceso, $rol_id): AccesoRol {
        return AccesoRol::crear($acceso->id, $rol_id);
    }
    
    static public function listarAccesosPorRolId(int $rol_id, array $filtros = []) {
        return Acceso::listarTodos(array_merge($filtros, [
            'rol_id' => $rol_id,
        ]));
    }
    
    static public function borrarPorCoincidencia(array $filtros = []) {
        $rs = Acceso::listarTodos($filtros);
        foreach($rs as $row) {
            static::borrar($row->id);
        }
    }
    
    static public function borrar(int $acceso_id) {
        DB::beginTransaction();
        $rs2 = AccesoRol::listarTodos([
            'acceso_id' => $acceso_id
        ]);
        foreach($rs2 as $row2) {
            $row2->delete();
        }
        Acceso::getById($acceso_id)->delete();
        DB::commit();
    }
}
