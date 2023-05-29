<?php

namespace App\Modules\Usuarios\Accesos;

use App\Tools\ModelRepository;
use Illuminate\Database\Eloquent\Builder;

class Acceso extends ModelRepository
{
    protected $table = 'accesos';
    public $timestamps = false;
    
    static public function aplicarFiltros(Builder $query, array $filtros) {
        
        parent::aplicarFiltros($query, $filtros);
        
        foreach($filtros as $nombre => $valor) {
            if (in_array($nombre, ['nombre','tipo','grupo','uri'])) {
                if (!is_array($valor)) {
                    $valor = [$valor];
                }
                $query->whereIn($nombre, $valor);
            }
        }
    }
    
    static public function crearAccion(string $nombre, string $grupo): self {
        $row = new static;
        $row->nombre = $nombre;
        $row->grupo  = $grupo;
        $row->tipo   = 'accion';
        $row->guardar();
        return $row;
    }
    
    static public function crearMenu(string $nombre, string $grupo, string $uri): self {
        $row = new static;
        $row->nombre = $nombre;
        $row->grupo  = $grupo;
        $row->uri    = $uri;
        $row->tipo   = 'menu';
        $row->guardar();
        return $row;
    }
}
