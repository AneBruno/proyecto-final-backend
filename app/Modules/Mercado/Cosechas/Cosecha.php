<?php

namespace App\Modules\Mercado\Cosechas;

use App\Tools\ModelRepository;
use Kodear\Laravel\Repository\Exceptions\RepositoryException;
use Illuminate\Database\Eloquent\Builder;

class Cosecha extends ModelRepository
{

    protected $table = 'mercado_cosechas';

    public $timestamps = true;

    protected $fillable = [
        'descripcion',
        'habilitado'
    ];

    /**
     * @param array $data
     * @return $this
     * @throws RepositoryException
     */
    public function actualizar(array $data): self
    {
        $this->fill($data);
        return $this->guardar();
    }

    /**
     * @param Builder $query
     * @param array $filtros
     */
    static public function aplicarFiltros(Builder $query, array $filtros)
    {
        parent::aplicarFiltros($query, $filtros);

        foreach($filtros as $filtro => $valor) {
            if ($filtro === 'descripcion') {
                $valor = '%' .  $valor . '%';
                $query->where('mercado_cosechas.descripcion', 'like', $valor);
            }

            if ($filtro === 'habilitado') {
                $query->where('mercado_cosechas.habilitado', '=', $valor);
            }
        }
    }

    /**
     * @param Builder $query
     * @param array $ordenes
     */
    static public function aplicarOrdenes(Builder $query, array $ordenes)
    {
        foreach($ordenes as $columna => $sentido) {
            if ($columna == 'descripcion') {
                $query->orderBy($columna, $sentido);
            }
        }
    }
}
