<?php

namespace App\Modules\Productos\TiposProducto;

use App\Modules\Productos\Productos\Producto;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Tools\ModelRepository;
use Illuminate\Database\Eloquent\Builder;

class TipoProducto extends ModelRepository
{
    use SoftDeletes;

    protected $table = 'tipos_producto';

    public $timestamps = true;

    protected $fillable = [
        'nombre',
        'habilitado'
    ];

    public function productos()
    {
        return $this->hasMany(Producto::class, 'tipo_producto_id', 'id');
    }

    static public function aplicarFiltros(Builder $query, array $filtros) {

        parent::aplicarFiltros($query, $filtros);

        foreach($filtros as $nombre => $valor) {
            if ($nombre === 'busqueda') {
                $query->where('nombre', 'like', "%{$valor}%");
            }
        }
    }

    static public function crear(string $nombre): self {
        $row         = new static;
        $row->nombre = $nombre;
        $row->habilitado =1;
        return $row->insertar();
    }

    public function actualizar(string $nombre): self {
        $this->nombre = $nombre;
        return $this->guardar();
    }

    public function habilitar(): self {
        $this->habilitado = true;
        $this->save();
        return $this;
    }

    public function deshabilitar(): self {
        $this->habilitado = false;
        $this->save();
        return $this;
    }
}
