<?php

namespace App\Modules\Clientes\Eventos\Archivos;

use App\Tools\ModelRepository;
use Illuminate\Database\Eloquent\Builder;

class Archivo extends ModelRepository {
    
    protected $table = 'eventos_archivo';

    public $fillable = [
        'evento_id'
    ];

    public const SUFFIX = 'evento_archivo';
    
    static public function crear(int $evento_id, string $nombre): self {
        $row = new static;
        $row->evento_id = $evento_id;
        $row->nombre    = $nombre;
        
        $row->guardar();
        
        return $row;
    }
    
    static public function aplicarFiltros(Builder $query, array $filtros) {
        parent::aplicarFiltros($query, $filtros);
        
        foreach($filtros as $nombre => $valor) {
            if ($nombre === 'evento_id') {
                $query->where($nombre, $valor);
            }
        }
    }
}
