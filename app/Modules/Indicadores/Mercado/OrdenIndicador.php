<?php

namespace App\Modules\Indicadores\Mercado;

use App\Tools\ModelRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kodear\Laravel\Repository\Exceptions\RepositoryException;

class OrdenIndicador extends ModelRepository
{
    use SoftDeletes;

    protected $table = 'mercado_ordenes';

    public $timestamps = true;

    static public function generarConsulta(array $filtros = [], array $ordenes = [], array $opciones = []): Builder {
        $query = parent::generarConsulta($filtros, $ordenes, $opciones);

        $tipoPeriodo = $filtros['tipo_periodo'] ?? '%Y-%m';

        $query->selectRaw("
            DATE_FORMAT(created_at, '{$tipoPeriodo}') AS periodo,
            COUNT(id) AS 'Total',
            SUM(IF(estado_id = 1, 1, 0)) AS 'Activa',
            SUM(IF(estado_id = 3, 1, 0)) AS 'Confirmada',
            SUM(IF(estado_id = 5, 1, 0)) AS 'Eliminada'
        ");
        $query->groupByRaw("DATE_FORMAT(created_at, '{$tipoPeriodo}')");
        $query->orderByRaw("DATE_FORMAT(created_at, '{$tipoPeriodo}') ASC");
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
}
