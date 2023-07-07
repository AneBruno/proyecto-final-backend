<?php

namespace App\Modules\Mercado\Ordenes;

use App\Modules\Clientes\Empresas\Empresa;
use App\Modules\Clientes\Establecimientos\Establecimiento;
use App\Modules\Mercado\CondicionesPago\CondicionPago;
use App\Modules\Mercado\Ordenes\Dtos\CrearOrdenDto;
use App\Modules\Mercado\Ordenes\Estado\OrdenEstado;
use App\Modules\Mercado\Posiciones\Posicion;
use App\Modules\Productos\Calidades\Calidad;
use App\Modules\Productos\Productos\Producto;
use App\Modules\Puertos\Puerto;
use App\Modules\Usuarios\Usuarios\User;
use App\Tools\ModelRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kodear\Laravel\Repository\Exceptions\RepositoryException;

class Orden extends ModelRepository
{
    use SoftDeletes;

    protected $table = 'mercado_ordenes';

    public $timestamps = true;

    protected $fillable = [
        'empresa_id',
        'producto_id',
        //'calidad_id',
        'puerto_id',
        //'establecimiento_id',
        'condicion_pago_id',
        'moneda',
        'precio' ,
        'volumen',
        'fecha_vencimiento',
        'usuario_carga_id',
        'estado_id',
        /*'fecha_entrega_inicio',
        'fecha_entrega_fin',*/
        'observaciones',
        'posicion_id',
        //'entrega',
        'precio_cierre_slip'
    ];

    public function actualizar(array $data): self {
        $this->fill($data);
        return $this->guardar();
    }

    public function crear(CrearOrdenDto $data): self {

    }


    static public function aplicarFiltros(Builder $query, array $filtros) {
        parent::aplicarFiltros($query, $filtros);

        foreach($filtros as $filtro => $valor) {
            if ($filtro === 'ids') {
                $valor = is_array($valor) ? $valor : [$valor];
                $query->whereIn('id', $valor);
            }
            
            if ($filtro === 'id_not_in') {
                $query->whereNotIn('mercado_ordenes.id', $valor);
            }
            
            if ($filtro === 'empresas.usuario_comercial_id') {
                $query->joinRelation('empresa');
                $query->where('empresas.usuario_comercial_id', $valor);
            }

            if (in_array($filtro, [
            	'empresa_id',
				'condicion_pago_id',
				'estado_id',
				'moneda',
				//'entrega',
				'localidad_destino',
				'departamento_destino',
				'provincia_destino'
			])) {
                if($valor === 'null') {
					$query->whereNull($filtro);
				} else {
                    if (is_array($valor)){
                        $query->whereIn("mercado_ordenes.{$filtro}", $valor);
                    } else {
                        $query->where("mercado_ordenes.{$filtro}", $valor);
                    }
                }
            }

            if ($filtro === 'fecha') {
                $query->whereDate('mercado_ordenes.created_at', $valor);
            }

            if ($filtro === 'fechaDesde') {
                $query->whereDate('mercado_ordenes.created_at', '>=', $valor);
            }
            if ($filtro === 'fechaHasta') {
                $query->whereDate('mercado_ordenes.created_at', '<=', $valor);
            }

            if ($filtro === 'destino') {
				if ($valor === 'exportacion') {
					$query->whereNotNull('mercado_ordenes.puerto_id');
				} else if ($valor === 'consumo') {
					$query->whereNull('mercado_ordenes.puerto_id');
				}
			}

            /*if ($filtro === 'fechaEntregaInicioDesde') {
                $query->where('mercado_ordenes.fecha_entrega_inicio', '>=', $valor);
            }

            if ($filtro === 'fechaEntregaFinHasta') {
                $query->where('mercado_ordenes.fecha_entrega_fin', '<=', $valor);
            }*/

            if ($filtro === 'precioDesde') {
                $query->where('mercado_ordenes.precio', '>=', $valor);
            }
            if ($filtro === 'precioHasta') {
                $query->where('mercado_ordenes.precio', '<=', $valor);
            }

            if ($filtro === 'puertos') {
                $query->whereIn('mercado_ordenes.puerto_id', $valor);
            }

            if ($filtro === 'estados') {
                $query->whereIn('mercado_ordenes.estado_id', $valor);
            }

            if ($filtro == 'puerto_id') {
                // Este filtro debería estar junto con los de arriba.
                if ($valor === 'null') {
                    $query->whereNull('mercado_ordenes.puerto_id');
                } else {
                    $valor = is_array($valor) ? $valor : array_filter([$valor]);
                    $query->whereIn('mercado_ordenes.puerto_id', $valor);
                }
            }

            /*if ($filtro == 'calidad_id') {
                $valor = is_array($valor) ? $valor : array_filter([$valor]);
                $query->whereIn('mercado_ordenes.calidad_id', $valor);
            }*/

            if ($filtro == 'producto_id') {
                $valor = is_array($valor) ? $valor : array_filter([$valor]);
                $query->whereIn('mercado_ordenes.producto_id', $valor);
            }

            if ($filtro == 'usuario_carga_id') {
                $valor = is_array($valor) ? $valor : array_filter([$valor]);
                $query->whereIn('mercado_ordenes.usuario_carga_id', $valor);
            }
        }
    }

    static public function aplicarOrdenes(Builder $query, array $ordenes) {
        foreach($ordenes as $columna => $sentido) {
            if ($columna == 'producto.nombre') {
                $query->orderByPowerJoins($columna, $sentido);
            }

            if (in_array($columna, ['id', 'precio', 'estado_id'])) {
                $query->orderBy($columna, $sentido);
            }
        }
    }

    /**
     * @return BelongsTo
     */
    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'empresa_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'producto_id', 'id')->withTrashed();
    }

    /**
     * @return BelongsTo
     */
    /*public function calidad()
    {
        return $this->belongsTo(Calidad::class, 'calidad_id', 'id');
    }*/

    /**
     * @return BelongsTo
     */
    /*public function establecimiento()
    {
        return $this->belongsTo(Establecimiento::class, 'establecimiento_id', 'id');

    }

    /**
     * @return BelongsTo
     */
    public function puerto()
    {
        return $this->belongsTo(Puerto::class, 'puerto_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function condicionPago()
    {
        return $this->belongsTo(CondicionPago::class, 'condicion_pago_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function usuarioCarga()
    {
        return $this->belongsTo(User::class, 'usuario_carga_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function estado()
    {
        return $this->belongsTo(OrdenEstado::class, 'estado_id', 'id');
    }

    /**
     * @return HasOne
     */
    public function posicion()
    {
        return $this->hasOne(Posicion::class, 'id', 'posicion_id');
    }

    public function getPrecio()
    {
        return $this->getAttribute('precio');
    }

    public function getVolumen()
    {
        return $this->volumen;
    }
    
    public function isFirme(): bool
    {
        return $this->estado_id === OrdenEstado::ORDEN_FIRME;
    }

    public function getObtenerPrecioCierreSlip()
    {
        return $this->precioCierreSlip;
    }
    
    public function isConsumo(): bool
    {
        return is_null($this->puerto_id);
    }
    
    public function obtenerAbreviacion(): string {
        return implode(' - ', [
            date('DD-MM-YYY', strtotime($this->fecha_vencimiento)),
            $this->empresa()->obtenerAbreviacion(),
            $this->producto()->nombre,
            "{$this->volumen}tn",
            $this->moneda,
            $this->precio
        ]);
    }
}
