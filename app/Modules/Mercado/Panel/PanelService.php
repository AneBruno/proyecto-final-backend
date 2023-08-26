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
        foreach($rs as $row){
            $row->cantidad_ofertas=$this->obtenerCantidadOfertas($row);
        }
        return $rs;
    }

    public function obtenerCantidadOfertas(Posicion $posicion): int
    {
        $filtros = [
            'estados' => [1],
            'fecha' => date('Y-m-d'),
            'precioDesde' => 0
        ];

        $ordenes = [
          'precio' => 'desc' //para obtener facilmente el precio mayor
        ];

        /**
         * 
         * @var  Posicion $posicion
         */
        $filtros['producto_id'] = $posicion->producto->id;
        $filtros['condicion_pago_id'] = $posicion->condicionPago->id;

        //Filtro para el destino.
        $filtros['puerto_id'] = $posicion->puerto->id;

        if (!is_null($posicion->precio)) {
            $filtros['moneda'] = $posicion->moneda;
        } else {
            unset($filtros['moneda']);
        }

        //$ofertas = $this->ordenesService->obtenerOfertas(1, 0, $filtros, $ordenes);
        //$mejorOferta = PanelHelper::obtenerMejorOferta($ofertas);
        $ofertas = $this->ordenesService->obtenerOfertas(1, 0, $filtros, $ordenes);
        return count($ofertas);
        //$resumen[$clave]['toneladas'] = PanelHelper::obtenerCampoToneladas($ofertas, $mejorOferta);
        //$resumen[$clave]['ofertas'] = PanelHelper::obtenerCampoOferta($mejorOferta);
        
        //return $resumen;
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

        /*if ($posicion->isConsumoInterno() || $posicion->a_fijar) {
            return $posicion->getKey();
        } else {*/
            /**
             * El agrupador es por:
             * - moneda
             * - producto
             * - destino
             * - condicion pago
             * - cosecha
             */
        return "{$posicion->moneda}_{$posicion->producto_id}_{$posicion->puerto_id}_{$posicion->condicion_pago_id}_{$posicion->cosecha_id}";
    }
    

    /**
     * @param array $filtros
     * @return Collection
     */
    private function getPosicionesAgrupadasFiltradasPorFecha($filtros = [])
    {
        $filtros = array_merge(['fecha' => date('Y-m-d'), 'productoTrashed' => true], $filtros);
        $ordenamiento = [
            'producto_nombre'        => 'ASC',
            'destino_nombre'         => 'ASC',
            'precio'                 => 'ASC',
            'cosecha_id'             => 'ASC',
        ];
        $opciones = ["with_relation" =>['empresa','producto','puerto', 'condicionPago', 'cosecha']];

        return Posicion::listarTodos($filtros, $ordenamiento, $opciones);
    }

    /**
     * @param $empresas
     * @param $empresa
     * @return mixed
     */
    static private function addEmpresa($empresa, $empresas)
    {
        $empresa = static::atributos($empresa, ['id', 'razon_social']);

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
            $filtros = self::addFiltroUbicacion($filtros, $valores[2]);
            $filtros = self::addFiltro($filtros, 'condicion_pago_id', $valores[3]);
            $filtros = self::addFiltro($filtros, 'cosecha_id', $valores[4]);

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
     * @param $valor
     * @return mixed
     */
    static private function addFiltroUbicacion($filtros, $valor)
    {
        $filtros['puerto_id'] = $valor;
        return $filtros;
    }


}
