<?php

namespace App\Modules\Clientes\Categorias;

use App\Tools\ModelRepository;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class CategoriaCliente extends ModelRepository
{
    use SoftDeletes;
    
    protected $table = 'categorias_cliente';
    
    public $timestamps = true;
    
    static public function crear(string $nombre, string $perfil): self {
        $row = new static;
        $row->nombre = $nombre;
        $row->perfil = $perfil;
        return $row->insertar();
    }
    
    public function actualizar(string $nombre, string $perfil): self {
        $this->nombre = $nombre;
        $this->perfil = $perfil;
        return $this->guardar();
    }
    
    public function habilitar(): self {
        $this->deleted_at = null;
        return $this->guardar();
    }
    
    static public function aplicarFiltros(Builder $query, array $filtros) {
        
        parent::aplicarFiltros($query, $filtros);
        
        foreach($filtros as $nombre => $valor) {
            if ($nombre === 'perfil') {
                $query->where($nombre, $valor);
            }
            if ($nombre === 'busqueda') {
                $query->where(function(Builder $query) use ($valor) {
                    $query
                        ->orWhere('nombre', 'like', "%{$valor}%")
                        ->orWhere('perfil', 'like', "%{$valor}%");
                });
            }
        }
    }
}
