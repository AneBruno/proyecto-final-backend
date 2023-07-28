<?php

namespace App\Modules\Productos\Productos;

use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Modules\Productos\TiposProducto\TipoProducto;
use App\Tools\ModelRepository;
use Illuminate\Database\Eloquent\Builder;

class Producto extends ModelRepository
{
    use SoftDeletes;

    protected $table = 'productos';

    public $timestamps = true;

    protected $fillable = [
        'nombre',
        'tipo_producto_id',
        'deleted_at',
        'habilitado'
    ];

    /**
     * @return string
     */
    public function getNombre(): string
    {
        return $this->nombre;
    }

    static public function crear(string $nombre, int $tipo_producto_id): self {
        $row                   = new static;
        $row->nombre           = $nombre;
        $row->tipo_producto_id = $tipo_producto_id;
        $row->habilitado       = true;
        return $row->insertar();
    }

    public function actualizar(string $nombre, int $tipo_producto_id): self {
        $this->nombre           = $nombre;
        $this->tipo_producto_id = $tipo_producto_id;
        return $this->guardar();
    }

    public function habilitar(): self {
        $this->update(['habilitado' => 1]);
        return $this;
    }

    public function deshabilitar(): self {
        $this->update(['habilitado' => 0]);
        return $this;
    }

    /**
     * @return HasOne
     */
    public function tipoProducto()
    {
        return $this->hasOne(TipoProducto::class, 'id', 'tipo_producto_id')->withTrashed();
    }

    static public function aplicarFiltros(Builder $query, array $filtros) {

        parent::aplicarFiltros($query, $filtros);

        foreach($filtros as $nombre => $valor) {
            if ($nombre === 'busqueda') {
                $query->where('nombre', 'like', "%{$valor}%");
            }

            if ($nombre === 'habilitado') {
                if ($valor !== 'todas') {
                    $query->where('productos.habilitado', $valor);
                }
            }
        }
    }

    static public function aplicarOrdenes(Builder $query, array $ordenes) {

        parent::aplicarOrdenes($query, $ordenes);
        foreach($ordenes as $nombre => $sentido) {
            $direccion = strtolower($sentido);
            if (in_array($nombre, ['nombre'])) {
                $query->orderBy($nombre, $direccion);
            }
        }
    }
}
