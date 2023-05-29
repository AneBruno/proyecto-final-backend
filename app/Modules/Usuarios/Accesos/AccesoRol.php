<?php

namespace App\Modules\Usuarios\Accesos;

use App\Tools\ModelRepository;
use Illuminate\Database\Eloquent\Builder;

class AccesoRol extends ModelRepository
{
    protected $table = 'accesos_roles';
    public $timestamps = false;
    
    static public function aplicarFiltros(Builder $query, array $filtros) {
        
        parent::aplicarFiltros($query, $filtros);
        
        foreach($filtros as $nombre => $valor) {
            if (in_array($nombre, ['nombre',])) {
                $query->join('accesos', 'accesos.id', '=', 'accesos_roles.acceso_id');
                $query->where('accesos.nombre', $valor);
            }
            if (in_array($nombre, ['rol_id', 'acceso_id', 'uri'])) {
                if (is_array($valor)) {
                    $query->whereIn($nombre, $valor);
                } else {
                    $query->where($nombre, $valor);
                }
            }
        }
    }
    
    static public function crear(int $acceso_id, int $rol_id) {
        $row = new static;
        $row->acceso_id = $acceso_id;
        $row->rol_id    = $rol_id;
        $row->guardar();
        return $row;
        
    }
}
