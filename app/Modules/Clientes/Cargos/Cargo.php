<?php

/*namespace App\Modules\Clientes\Cargos;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Tools\ModelRepository;

class Cargo extends ModelRepository
{
    use SoftDeletes;
    
    protected $table = 'cargos';

    public const CARGO = 1;

    public const LOGISTICA = 2;

    public const ADMINISTRACION = 3;

    public const GERENCIA = 4;

    public const DIRECTOR = 5;

    public const ESTADOS = [
        self::CARGO,
        self::LOGISTICA,
        self::ADMINISTRACION,
        self::GERENCIA,
        self::DIRECTOR
    ];
    
    static public function crear(string $nombre): self {
        $row         = new static;
        $row->nombre = $nombre;
        return $row->insertar();
    }
    
    public function actualizar(string $nombre): self {
        $this->nombre = $nombre;
        return $this->guardar();
    }
    
    static public function aplicarFiltros(Builder $query, array $filtros) {
        
        parent::aplicarFiltros($query, $filtros);
        
        foreach($filtros as $nombre => $valor) {
            
            if ($nombre === 'nombre') {
                $query->where($nombre, $valor);
            }

            if ($nombre === 'busqueda') {
                $query->where(function(Builder $query) use ($valor) {
                    $query
                        ->orWhere('nombre', 'like', "%{$valor}%");
                });
            }
        }
    }
}
*/