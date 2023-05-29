<?php

namespace App\Modules\Productos\Calidades;

use Illuminate\Database\Eloquent\SoftDeletes;
use App\Tools\ModelRepository;
use Illuminate\Database\Eloquent\Builder;

class Calidad extends ModelRepository
{
    use SoftDeletes;

    protected $table = 'calidades';

    public $timestamps = true;

    protected $fillable = [
        'nombre',
        'orden',
    ];

    /**
     * @return string
     */
    public function getNombre(): string
    {
        return $this->nombre;
    }

    static public function crear(string $nombre, int $orden): self {
        $row         = new static;
        $row->nombre = $nombre;
        $row->orden  = $orden;
        return $row->insertar();
    }

    public function actualizar(string $nombre, int $orden): self {
        $this->nombre = $nombre;
        $this->orden  = $orden;
        return $this->guardar();
    }

    static public function aplicarFiltros(Builder $query, array $filtros) {

        parent::aplicarFiltros($query, $filtros);

        foreach($filtros as $nombre => $valor) {
            if ($nombre === 'busqueda') {
                $query->where('nombre', 'like', "%{$valor}%");
            }
        }
    }
}
