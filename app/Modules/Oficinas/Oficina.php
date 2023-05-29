<?php

namespace App\Modules\Oficinas;

use App\Tools\ModelRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class Oficina extends ModelRepository
{    
    protected $table      = 'oficinas';
    public    $timestamps = false;
    
    protected $fillable = [
        'nombre',
        'oficina_madre_id',
    ];
    
    static public function crear(string $nombre, ?int $oficina_madre_id): Oficina {
        $row = new static;
        $row->nombre = $nombre;
        if ($oficina_madre_id) {
            $row->oficina_madre_id = $oficina_madre_id;
        }
        
        return $row->insertar();
    }
    
    public function actualizar(string $nombre, ?int $oficina_madre_id): Oficina {
        
        $this->nombre = $nombre;
        if ($oficina_madre_id) {
            $this->oficina_madre_id = $oficina_madre_id;
        }
        
        return $this->guardar();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function oficinaMadre()
    {
        return $this->hasOne(static::class, 'id', 'oficina_madre_id');
    }
    
    static public function aplicarFiltros(Builder $query, array $filtros) {
        
        parent::aplicarFiltros($query, $filtros);
        
        foreach($filtros as $nombre => $valor) {
            if ($nombre === 'busqueda') {
                $query->where(function($query) use($valor) {
                    $query->where('nombre', 'like', "%{$valor}%");    
                });
            }
        }
    }
}
