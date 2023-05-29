<?php

namespace App\Modules\Mercado\Posiciones;

use App\Modules\Mercado\Cosechas\Cosecha;
use App\Modules\Productos\Productos\Producto;
use App\Modules\Productos\Calidades\Calidad;
use App\Modules\Puertos\Puerto;
use App\Modules\Clientes\Empresas\Empresa;
use App\Modules\Clientes\Establecimientos\Establecimiento;
use App\Modules\Mercado\CondicionesPago\CondicionPago;
use App\Modules\Usuarios\Usuarios\User;
use App\Tools\ModelRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Posicion extends ModelRepository
{
    use SoftDeletes;

    protected $table = 'mercado_posiciones';

    public $timestamps = true;

    protected $guarded = [];

    const ACTIVA = 'ACTIVA';
    const DENUNCIADA = 'DENUNCIADA';
    const RETIRADA = 'RETIRADA';
    const ELIMINADA = 'ELIMINADA';

    const ESTADOS = [
        self::ACTIVA,
        self::DENUNCIADA,
        self::RETIRADA,
        self::ELIMINADA,
    ];

    /**
     * @return HasOne
     */
    public function empresa() {
        return $this->hasOne(Empresa::class, 'id', 'empresa_id');
    }

    /**
     * @return HasOne
     */
    public function producto() {
        return $this->hasOne(Producto::class, 'id', 'producto_id')->withTrashed();
    }

    /**
     * @return HasOne
     */
    public function calidad() {
        return $this->hasOne(Calidad::class, 'id', 'calidad_id');
    }

    /**
     * @return HasOne
     */
    public function puerto() {
        return $this->hasOne(Puerto::class, 'id', 'puerto_id');
    }

    /**
     * @return HasOne
     */
    public function establecimiento() {
        return $this->hasOne(Establecimiento::class, 'id', 'establecimiento_id');
    }

    /**
     * @return HasOne
     */
    public function condicionPago() {
        return $this->hasOne(CondicionPago::class, 'id', 'condicion_pago_id');
    }

    /**
     * @return HasOne
     */
    public function cosecha()
    {
        return $this->hasOne(Cosecha::class, 'id', 'cosecha_id');
    }

    /**
     * @return HasOne
     */
    public function usuarioCarga()
    {
        return $this->hasOne(User::class, 'id', 'usuario_carga_id');
    }

    /**
     * @return mixed
     */
    public function getFechaEntregaInicio()
    {
        return $this->fecha_entrega_inicio;
    }

    /**
     * @return mixed
     */
    public function getFechaEntregaFin()
    {
        return $this->fecha_entrega_fin;
    }

    /**
     * @return mixed
     */
    public function getCondicionPagoId()
    {
        return $this->condicion_pago_id;
    }

    /**
     * @return mixed
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * @return mixed
     */
    public function getMoneda()
    {
        return $this->moneda;
    }

    /**
     * @return mixed
     */
    public function getEntrega()
    {
        return $this->entrega;
    }

    /**
     * @return mixed
     */
    public function getDestino()
    {
        if (!is_null($this->puerto_id)) {
            return $this->puerto;
        } else {
            return $this->establecimiento;
        }
    }

    public function getLocalidadDestino()
    {
        return $this->localidad_destino;
    }

    public function getDepartamentoDestino()
    {
        return $this->departamento_destino;
    }

    public function getProvinciaDestino()
    {
        return $this->provincia_destino;
    }

    public function getLatitudDestino()
    {
        return $this->latitud_destino;
    }

    public function getLongitudDestino()
    {
        return $this->longitud_destino;
    }

    /**
     * @return bool
     */
    public function isConsumoInterno(): bool
    {
        return is_null($this->puerto_id);
    }

    static public function aplicarFiltros(Builder $query, array $filtros) {
        parent::aplicarFiltros($query, $filtros);

        foreach($filtros as $columna => $valor) {
            if (in_array($columna, [
                'establecimiento_id',
                'fecha_entrega_inicio',
                'fecha_entrega_fin',
                'moneda',
            ])) {
                $query->where("mercado_posiciones.{$columna}", $valor);
            }

            if (in_array($columna, [
                'posicion_excepcional',
                'volumen_limitado',
                'a_trabajar',
                'a_fijar'
            ])) {
                $valores = is_array($valor) ? $valor : [$valor];
                $valorsFiltro = array_map(function($valor) {
                    return ($valor === 'true' || $valor == '1' || $valor === true) ? 1 : 0;
                }, $valores);

                $query->whereIn("mercado_posiciones.{$columna}", $valorsFiltro);
            }

            if (in_array($columna, ['empresa_id', 'entrega', 'condicion_pago_id'])) {
				$valores = is_array($valor) ? $valor : [$valor];

				$query->whereIn("mercado_posiciones.{$columna}", $valores);
			}

            if ($columna === 'fecha') {
                $query->whereDate('mercado_posiciones.created_at', $valor);
            }

            if ($columna === 'fecha_desde') {
                $query->whereDate('mercado_posiciones.created_at', '>=', $valor);
            }

            if ($columna === 'fecha_hasta') {
                $query->whereDate('mercado_posiciones.created_at', '<=', $valor);
            }

            if ($columna === 'estado') {
                if ($valor === 'todas') {
                    $query->whereIn('mercado_posiciones.estado', array(Posicion::ACTIVA, Posicion::DENUNCIADA));
                } else {
                    $valor = is_array($valor) ? $valor : array_filter([$valor]);
                    $query->whereIn('mercado_posiciones.estado', $valor);
                }
            }

            if ($columna === 'tipo') {
                if ($valor === 'exportacion') {
                    $query->whereNotNull('mercado_posiciones.puerto_id');
                } else if ($valor === 'consumos') {
                    $query->whereNotNull('mercado_posiciones.establecimiento_id');
                }
            }

            if ($columna == 'puerto_id') {
                $valor = is_array($valor) ? $valor : array_filter([$valor]);
                $query->whereIn('mercado_posiciones.puerto_id', $valor);
            }

            if ($columna == 'calidad_id') {
                $valor = is_array($valor) ? $valor : array_filter([$valor]);
                $query->whereIn('mercado_posiciones.calidad_id', $valor);
            }

            if ($columna == 'cosecha_id') {
                $valor = is_array($valor) ? $valor : array_filter([$valor]);
                $query->whereIn('mercado_posiciones.cosecha_id', $valor);
            }

            if ($columna == 'producto_id') {
                $valor = is_array($valor) ? $valor : array_filter([$valor]);
                $query->whereIn('mercado_posiciones.producto_id', $valor);
            }
            
            if ($columna === 'tipo_posicion') {
                $valor = is_array($valor) ? $valor : [$valor]; // Forzamos a un array
                if (array_intersect($valor, ['posicion_excepcional','a_trabajar','volumen_limitado'])) {
                    $query->where(function(Builder $query) use($valor) {
                        array_map(function($nombre_columna) use ($query) {
                            $query->orWhere("mercado_posiciones.{$nombre_columna}", '=', 1);
                        }, $valor);
                    });
                }
            }
        }
    }

    static public function aplicarOrdenes(Builder $query, array $ordenes) {
        foreach($ordenes as $columna => $sentido) {
            $direction = strtolower($sentido);
            if ($columna == 'exportacion') {
                $query->orderByRaw("IF(mercado_posiciones.moneda='USD', 1, 2)", $sentido);
            }
            if ($columna == 'producto_uso_frecuente') {
                $query->orderByPowerJoins('producto.uso_frecuente', $sentido);
            }
            if ($columna == 'producto_nombre') {
                $query->orderByPowerJoins('producto.nombre', $sentido);
            }
            if ($columna == 'destino_nombre') {
                $query->orderByLeftPowerJoins('puerto.nombre', $sentido);
                $query->orderByLeftPowerJoins('establecimiento.nombre', $sentido);
            }
            if (in_array($columna, ['id', 'precio', 'cosecha_id'])) {
                $query->orderBy("mercado_posiciones.{$columna}", $direction);
            }
        }
    }


}
