<?php

namespace App\Modules\Indicadores\Posiciones;

use App\Tools\ModelRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kodear\Laravel\Repository\Exceptions\RepositoryException;

class PosicionIndicador extends ModelRepository
{
    use SoftDeletes;

    protected $table = 'mercado_posiciones';

    public $timestamps = true;

    static public function generarConsulta(array $filtros = [], array $ordenes = [], array $opciones = []): Builder {
        $query = parent::generarConsulta($filtros, $ordenes, $opciones);

        $tipoPeriodo = $filtros['tipo_periodo'] ?? '%Y-%m';
        $producto_id = $filtros['producto_id'] ?? null ;

        $query->selectRaw("
            DATE_FORMAT(created_at, '{$tipoPeriodo}') AS periodo,
            COUNT(id) AS 'Total',
            SUM(IF(estado = 'ACTIVA', 1, 0)) AS 'Activa',
            SUM(IF(estado = 'ELIMINADA', 1, 0)) AS 'Eliminada',
            SUM(IF(estado = 'CERRADA', 1, 0)) AS 'Confirmada'
        ");
        
        // Agregar la cláusula WHERE solo si $producto_id tiene un valor definido
        if ($producto_id !== null) {
            $query->where('producto_id', '=', $producto_id);
        }

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
                $query->whereNotIn('mercado_posiciones.id', $valor);
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
                        $query->whereIn("mercado_posiciones.{$filtro}", $valor);
                    } else {
                        $query->where("mercado_posiciones.{$filtro}", $valor);
                    }
                }
            }

            if ($filtro === 'fecha') {
                $query->whereDate('mercado_posiciones.created_at', $valor);
            }

            if ($filtro === 'fechaDesde') {
                $query->whereDate('mercado_posiciones.created_at', '>=', $valor);
            }
            if ($filtro === 'fechaHasta') {
                $query->whereDate('mercado_posiciones.created_at', '<=', $valor);
            }

            if ($filtro === 'precioDesde') {
                $query->where('mercado_posiciones.precio', '>=', $valor);
            }
            if ($filtro === 'precioHasta') {
                $query->where('mercado_posiciones.precio', '<=', $valor);
            }

            if ($filtro === 'puertos') {
                $query->whereIn('mercado_posiciones.puerto_id', $valor);
            }

            if ($filtro === 'estados') {
                $query->whereIn('mercado_posiciones.estado_id', $valor);
            }

            if ($filtro == 'puerto_id') {
                // Este filtro debería estar junto con los de arriba.
                if ($valor === 'null') {
                    $query->whereNull('mercado_posiciones.puerto_id');
                } else {
                    $valor = is_array($valor) ? $valor : array_filter([$valor]);
                    $query->whereIn('mercado_posiciones.puerto_id', $valor);
                }
            }

            if ($filtro == 'producto_id') {
                $valor = is_array($valor) ? $valor : array_filter([$valor]);
                $query->whereIn('mercado_posiciones.producto_id', $valor);
            }

            if ($filtro == 'cosecha_id') {
                $valor = is_array($valor) ? $valor : array_filter([$valor]);
                $query->whereIn('mercado_posiciones.cosecha_id', $valor);
            }

            /*if ($filtro == 'usuario_carga_id') {
                $valor = is_array($valor) ? $valor : array_filter([$valor]);
                $query->whereIn('mercado_posiciones.usuario_carga_id', $valor);
            }*/
        }

        // echo static::getRawBoundSql($query); echo "\n\n";
    }
    


}
