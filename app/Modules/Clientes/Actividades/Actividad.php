<?php

namespace App\Modules\Clientes\Actividades;

use App\Tools\ModelRepository;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class Actividad extends ModelRepository
{
    use SoftDeletes;
    
    protected $table = 'actividades';
    
    public $timestamps = false;
    
    static public function crear(string $nombre): self {
        $row = new static;
        $row->nombre = $nombre;
        return $row->insertar();
    }
    
    public function actualizar(string $nombre): self {
        $this->nombre = $nombre;
        return $this->guardar();
    }
    
    public function habilitar(): self {
        $this->deleted_at = null;
        return $this->guardar();
    }
    
    static public function aplicarFiltros(Builder $query, array $filtros) {
        parent::aplicarFiltros($query, $filtros);

        foreach($filtros as $nombre => $valor) {
            if ($nombre === 'busqueda') {
                $query->where(function($query) use($valor) {
                    $query
                        ->orWhere('nombre', 'like', "%{$valor}%");
                });
            }
        }
    }
}
