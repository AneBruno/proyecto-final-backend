<?php

namespace App\Modules\Clientes\TiposEvento;

use App\Tools\ModelRepository;
use Illuminate\Database\Eloquent\Builder;

class TipoEvento extends ModelRepository
{
    protected $table = 'tipos_evento';

    public $timestamps = true;

    public $fillable = [
        'nombre',
        'cantidad_dias_alerta_1',
        'cantidad_dias_alerta_2',
        'habilitado'
    ];

    /**
     * @param Builder $query
     * @param array $filtros
     */
    static public function aplicarFiltros(Builder $query, array $filtros)
    {
        parent::aplicarFiltros($query, $filtros);

        foreach($filtros as $nombre => $valor) {
            if ($nombre == 'busqueda') {
                $query->where('nombre', 'like', "%{$valor}%");
            }

            if ($nombre == 'habilitado') {
                $query->where('habilitado', '=', $valor);
            }
        }
    }

    /**
     * @param Builder $query
     * @param array $ordenes
     */
    static public function aplicarOrdenes(Builder $query, array $ordenes)
    {
        foreach ($ordenes as $columna => $sentido) {
            if ($columna == 'id') {
                $query->orderBy($columna, $sentido);
            }
        }
    }
    
    static public function crear(string $nombre, ?int $cantidad_dias_alerta_1, ?int $cantidad_dias_alerta_2): self {
        $row = new static([
            'nombre'                 => $nombre,
            'habilitado'             => true,
            'cantidad_dias_alerta_1' => $cantidad_dias_alerta_1,
            'cantidad_dias_alerta_2' => $cantidad_dias_alerta_2,
        ]);

        $row->insertar();
        
        return $row;        
    }
    
    public function actualizar(string $nombre, ?int $cantidad_dias_alerta_1, ?int $cantidad_dias_alerta_2): self {
        $this->nombre                 = $nombre;
        $this->cantidad_dias_alerta_1 = $cantidad_dias_alerta_1;
        $this->cantidad_dias_alerta_2 = $cantidad_dias_alerta_2;
        $this->guardar();
        
        return $this;
    }
    
    public function habilitar(): self {
        $this->habilitado = 1;
        $this->guardar();
        
        return $this;
    }
    
    public function deshabilitar(): self {
        $this->habilitado = 0;
        $this->guardar();
        
        return $this;
    }
}
