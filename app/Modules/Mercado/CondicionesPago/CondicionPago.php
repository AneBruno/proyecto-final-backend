<?php

namespace App\Modules\Mercado\CondicionesPago;

use App\Tools\ModelRepository;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Builder;

class CondicionPago extends ModelRepository
{
    use SoftDeletes;

    protected $table = 'condiciones_pago';

    public $timestamps = true;

    static public function crear(string $descripcion): self {
        $row              = new static;
        $row->descripcion = $descripcion;
        return $row->insertar();
    }

    public function actualizar(string $descripcion): self {
        $this->descripcion = $descripcion;
        return $this->guardar();
    }

    static public function aplicarFiltros(Builder $query, array $filtros) {
        parent::aplicarFiltros($query, $filtros);

        foreach($filtros as $filtro => $valor) {
            if ($filtro === 'busqueda') {
                $query->where('descripcion', 'like', "%{$valor}%");
            }
        }
    }
}
