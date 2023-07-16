<?php

namespace App\Modules\Mercado\Panel;

use App\Exceptions\EmailException;
use App\Helpers\DateHelper;
use App\Modules\Mercado\Ordenes\Orden;
use App\Modules\Mercado\Ordenes\OrdenesService;
use App\Modules\Mercado\Posiciones\Posicion;
use App\Modules\Mercado\Posiciones\PosicionesService;
use App\Modules\Usuarios\Usuarios\User;
use App\Tools\ModelRepository;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Kodear\Laravel\Repository\Exceptions\RepositoryException;
use Kodear\Laravel\Repository\Repository;


class PanelService {

    protected OrdenesService $ordenesService;

    public function __construct(OrdenesService $ordenesService)
    {
        $this->ordenesService = $ordenesService;
    }

    public function listar(array $filtros = []) {
        $rs = $this->getPosicionesAgrupadasFiltradasPorFecha($filtros);

        $resumen = [];
        /** @var Posicion $posicion */
        foreach($rs as $posicion) {

            $clave = static::obtenerClave($posicion);

            if (empty($resumen[$clave])) {
                $resumen[$clave] = [
                    'empresas' => []
                ];
            }

            $resumen[$clave]['clave'] = $clave;
            $resumen[$clave]['producto'            ]   = static::atributos($posicion->producto,        ['id', 'nombre'      ]);
            //$resumen[$clave]['calidad'             ]   = static::atributos($posicion->calidad,         ['id', 'nombre'      ]);
            //$resumen[$clave]['establecimiento'     ]   = static::atributos($posicion->establecimiento, ['id', 'nombre'      ]);
            $resumen[$clave]['puerto'              ]   = static::atributos($posicion->puerto,          ['id', 'nombre'      ]);
            $resumen[$clave]['condicion_pago'      ]   = static::atributos($posicion->condicionPago,   ['id', 'descripcion' ]);
            $resumen[$clave]['cosecha'			   ]   = static ::atributos($posicion->cosecha, 		  ['descripcion'	   ]);
            //$resumen[$clave]['fecha_entrega_inicio']   = $posicion->fecha_entrega_inicio;
            //$resumen[$clave]['fecha_entrega_fin'   ]   = $posicion->fecha_entrega_fin;
            $resumen[$clave]['precio'              ]   = $posicion->precio;
            $resumen[$clave]['moneda'              ]   = $posicion->moneda;
            $resumen[$clave]['cosecha_id'          ]   = $posicion->cosecha_id;
            //$resumen[$clave]['entrega'             ]   = $posicion->entrega;
            $resumen[$clave]['localidad_destino'   ]   = $posicion->getLocalidadDestino();
            //$resumen[$clave]['departamento_destino']   = $posicion->getDepartamentoDestino();
            $resumen[$clave]['provincia_destino'   ]   = $posicion->getProvinciaDestino();

            $resumen[$clave]['posiciones'          ][] = [
                    'id' => $posicion->id,
                    'estado' => $posicion->estado,
                    'precio' => $posicion->precio,
                    /*'volumen_limitado' => $posicion->volumen_limitado,
                    'posicion_excepcional' => $posicion->posicion_excepcional,
                    'a_trabajar' => $posicion->a_trabajar,*/
                    'empresa' => static::atributos($posicion->empresa, ['id', 'razon_social'/*, 'abreviacion'*/]),
					//'calidad_observaciones' => $posicion->calidad_observaciones,
					'observaciones' => $posicion->observaciones,
                    'usuario_carga' => $posicion->usuarioCarga
                ];

            $resumen[$clave]['empresas'] = self::addEmpresa($posicion->empresa, $resumen[$clave]['empresas']);

        }

        if (!empty($resumen)) {
            $resumen = $this->agregarDatosOferta($resumen);
        }

        return array_values($resumen);
    }


    private function agregarDatosOferta($resumen): array
    {
        $filtros = [
            'estados' => [1, 2],
            'fecha' => date('Y-m-d'),
            'precioDesde' => 0
        ];

        $ordenes = [
          'precio' => 'desc' //para obtener facilmente el precio mayor
        ];

        /**
         * @var  $clave
         * @var  Posicion $posicion
         */
        foreach ($resumen as $clave => $posicion) {
            $filtros['producto_id'] = $posicion['producto']['id'];
            //$filtros['fechaEntregaInicioDesde'] = DateHelper::sumarDias($posicion['fecha_entrega_inicio'], -30);
            //$filtros['fechaEntregaFinHasta'] = DateHelper::sumarDias($posicion['fecha_entrega_fin'], 30);
            $filtros['condicion_pago_id'] = $posicion['condicion_pago']['id'];
            //$filtros['entrega'] = $posicion['entrega'];

            //Filtro para el destino.
            if ($posicion['puerto']['id'] !== '') {
                $filtros['puerto_id'] = $posicion['puerto']['id'];
                unset($filtros['localidad_destino'], /*$filtros['departamento_destino'],*/$filtros['provincia_destino']);
            } else {
                $filtros['localidad_destino'] = $posicion['localidad_destino'];
                //$filtros['departamento_destino'] = $posicion['departamento_destino'];
                $filtros['provincia_destino'] = $posicion['provincia_destino'];
                $filtros['puerto_id'] = 'null';
            }

            if (!is_null($posicion['precio'])) {
                $filtros['moneda'] = $posicion['moneda'];
            } else {
                unset($filtros['moneda']);
            }

            $ofertas = $this->ordenesService->obtenerOfertas(1, 0, $filtros, $ordenes);

            $mejorOferta = PanelHelper::obtenerMejorOferta($ofertas);

            $resumen[$clave]['toneladas'] = PanelHelper::obtenerCampoToneladas($ofertas, $mejorOferta);
            $resumen[$clave]['ofertas'] = PanelHelper::obtenerCampoOferta($mejorOferta);

        }
        return $resumen;
    }

    /**
     * @param $clave
     * @return mixed
     */
    public function getByClave($clave) {
            $filtros = self::obtenerFiltros($clave);
            $posiciones = $this->listar( $filtros);

            return $posiciones ? $posiciones[0] : [];

    }

    /**
     * @param $row
     * @param array $atributos
     * @return array
     */
    static public function atributos($row, array $atributos): array {
        $result = [];
        foreach($atributos as $nombre) {
            $result[$nombre] = ($row??(object)[])->$nombre??'';
        }

        return $result;
    }

    /**
     * @param $fechaInicio
     * @param $fechaFin
     * @return array
     * @throws Exception
     */
    static public function obtenerPeriodos($fechaInicio, $fechaFin): array {
        $fecha1     = new \DateTime($fechaInicio);
        $fecha2     = new \DateTime($fechaFin   );

        $diff       = $fecha2->diff($fecha1);
        $meses      = $diff->m;
        $periodos   = [];
        $periodos[] = $fecha1->format('m-Y');

        for($i = 0; $i < $meses; $i++) {
            $periodos[] = $fecha1->add(new \DateInterval("P1M"))->format('m-Y');
        }
        return $periodos;
    }

    /**
     * @param Posicion $posicion
     * @return string
     */
    static public function obtenerClave(Posicion $posicion): string {

        if ($posicion->isConsumoInterno() || $posicion->a_fijar) {
            return $posicion->getKey();
        } else {
            /**
             * El agrupador es por:
             * - moneda
             * - producto
             * - calidad
             * - destino
             * - condicion pago
             * - entrega
             * - cosecha
             * - a fijar
             */
            return "{$posicion->moneda}_{$posicion->producto_id}_{$posicion->puerto_id}_{$posicion->condicion_pago_id}_{$posicion->cosecha_id}";
        }
    }

    /**
     * @param array $filtros
     * @return Collection
     */
    private function getPosicionesAgrupadasFiltradasPorFecha($filtros = [])
    {
        $filtros = array_merge(['fecha' => date('Y-m-d'), 'productoTrashed' => true], $filtros);
        $ordenamiento = [
            //'producto_uso_frecuente' => 'DESC',
            'producto_nombre'        => 'ASC',
            'destino_nombre'         => 'ASC',
            'exportacion'            => 'ASC',
            'precio'                 => 'ASC',
            'cosecha_id'             => 'ASC',
        ];

        return Posicion::listarTodos($filtros, $ordenamiento);
    }

    /**
     * @param $empresas
     * @param $empresa
     * @return mixed
     */
    static private function addEmpresa($empresa, $empresas)
    {
        $empresa = static::atributos($empresa, ['id', 'razon_social', 'abreviacion']);

        if (!in_array($empresa, $empresas)) {
            $empresas[] = $empresa;
        }
        return $empresas;
    }

    /**
     * @param $clave
     * @return mixed
     */
    static private function obtenerFiltros($clave)
    {
        $filtros = [];

        if (is_numeric($clave)) {
            $filtros = ['id' => $clave];
        } else {
            $valores = explode('_', $clave);

            $filtros = self::addFiltro($filtros, 'moneda', $valores[0]);
            $filtros = self::addFiltro($filtros, 'producto_id', $valores[1]);
           // $filtros = self::addFiltro($filtros, 'calidad_id', $valores[2]);
            $filtros = self::addFiltroUbicacion($filtros, $valores[3], $valores[4]);
            $filtros = self::addFiltro($filtros, 'condicion_pago_id', $valores[5]);
            /*$filtros = self::addFiltro($filtros, 'fecha_entrega_inicio', $valores[6]);
            $filtros = self::addFiltro($filtros, 'fecha_entrega_fin', $valores[7]);*/
            $filtros = self::addFiltro($filtros, 'cosecha_id', $valores[8]);
            //$filtros = self::addFiltro($filtros, 'entrega', $valores[9]);
           // $filtros = self::addFiltro($filtros, 'a_fijar', $valores[10]);

            $filtros = self::addFiltro($filtros, 'estado', 'todas');
        }
        return $filtros;
    }

    static private function addFiltro($filtros, string $nombre, $valor)
    {
        if ($valor !== '') {
            $filtros[$nombre] = $valor;
        }
        return $filtros;
    }

    /**
     * @param $filtros
     * @param $destino
     * @param $valor
     * @return mixed
     */
    static private function addFiltroUbicacion($filtros, $destino, $valor)
    {
        if ($destino === 'establecimiento') {
            $filtros['establecimiento_id'] = $valor;
        } else {
            $filtros['puerto_id'] = $valor;
        }
        return $filtros;
    }

    /**
     * @param array $posicionesIds
     * @param string $estado
     * @throws RepositoryException
     * @throws EmailException
     */
    static public function cambiarEstados(array $posicionesIds, string $estado): void
    {
        try {
            DB::beginTransaction();
            foreach ($posicionesIds as $posicionId) {
                $posicion = PosicionesService::getById($posicionId);
                PosicionesService::cambiarEstado($posicion, $estado);
            }
            DB::commit();
        } catch (Exception $e) {
            throw new Exception("No se pudieron cambiar los estados de las posiciones a '$estado'" . $e->getMessage(), $e->getCode(), $e->getPrevious());
        }

    }
}
