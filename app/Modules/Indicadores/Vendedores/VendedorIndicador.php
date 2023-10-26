<?php

namespace App\Modules\Indicadores\Vendedores;

use App\Tools\ModelRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kodear\Laravel\Repository\Exceptions\RepositoryException;

class VendedorIndicador extends ModelRepository
{
    use SoftDeletes;

    protected $table = 'mercado_ordenes';

    public $timestamps = true;

    public static function generarConsulta(array $filtros = [], array $ordenes = [], array $opciones = []): Builder
    {
        $query = parent::generarConsulta($filtros, $ordenes, $opciones);

        $tipoPeriodo = $filtros['tipo_periodo'] ?? '%Y-%m';
        $producto_id = $filtros['producto_id'] ?? null ;

        $query->selectRaw("
        DATE_FORMAT(mercado_ordenes.created_at, '{$tipoPeriodo}') AS periodo,
        e.cuit AS 'cuit',
        e.razon_social,
        COUNT(mercado_ordenes.id) as Total,
        SUM(IF(mercado_ordenes.estado_id = 1, 1, 0)) AS 'Activa',
        SUM(IF(mercado_ordenes.estado_id = 5, 1, 0)) AS 'Eliminada',
        SUM(IF(mercado_ordenes.estado_id = 3, 1, 0)) AS 'Cerrada',
        SUM(IF(mercado_ordenes.estado_id = 3 AND mercado_ordenes.moneda = 'USD', mercado_ordenes.precio_cierre_slip*mercado_ordenes.toneladas_cierre, 0)) AS 'Monto_USD',
        SUM(IF(mercado_ordenes.estado_id = 3 AND mercado_ordenes.moneda = 'AR$', mercado_ordenes.precio_cierre_slip*mercado_ordenes.toneladas_cierre, 0)) AS 'Monto_ARS'
        ");

        $query->join('empresas as e', 'e.id', '=', 'mercado_ordenes.empresa_id');
        $query->join('productos as p', 'p.id', '=', 'mercado_ordenes.producto_id');
        
        // Agregar la cláusula WHERE solo si $producto_id tiene un valor definido
        if ($producto_id !== null) {
            $query->where('p.id', '=', $producto_id);
        }

        $query->groupByRaw('mercado_ordenes.empresa_id');
        $query->groupByRaw("DATE_FORMAT(mercado_ordenes.created_at, '{$tipoPeriodo}')");
        
        $query->orderByRaw("DATE_FORMAT(mercado_ordenes.created_at, '{$tipoPeriodo}') DESC");
        $query->orderByRaw("Cerrada DESC");


        return $query;
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
				'localidad_destino',
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

            if ($filtro == 'producto_id') {
                $valor = is_array($valor) ? $valor : array_filter([$valor]);
                $query->whereIn('mercado_ordenes.producto_id', $valor);
            }

            /*if ($filtro == 'usuario_carga_id') {
                $valor = is_array($valor) ? $valor : array_filter([$valor]);
                $query->whereIn('mercado_ordenes.usuario_carga_id', $valor);
            }*/
        }

        // echo static::getRawBoundSql($query); echo "\n\n";
    }

    
}
