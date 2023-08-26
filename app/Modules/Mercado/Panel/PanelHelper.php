<?php

namespace App\Modules\Mercado\Panel;

use App\Modules\Mercado\Ordenes\Orden;
use Illuminate\Database\Eloquent\Collection;

class PanelHelper
{
    public static function obtenerMejorOferta(Collection $ordenes)
    {
        //Orden inicial para la iteración
        $mejorOrden = self::obtenerOrdenInicial($ordenes);

        /** @var Orden $orden */
        foreach($ordenes as $orden) {
            if ($orden->isActiva() && $orden->getPrecio() < $mejorOrden->getPrecio()) {
                $mejorOrden = $orden;
            }
        }
        return $mejorOrden;
    }

    private static function obtenerOrdenInicial(Collection $ordenes)
    {
        /** @var Orden $orden */
        foreach ($ordenes as $orden) {
            if ($orden->isActiva()) {
                return $orden;
            }
        }
        return [];
    }

    public static function obtenerCampoToneladas(Collection $ordenes, $mejorOrden)
    {
        $mejoresToneladas = 0;
        $otrasToneladas = 0;

        if (!empty($mejorOrden)) {
            $mejorPrecioOrden = $mejorOrden->getPrecio();
        } else {
            $mejorPrecioOrden = 0;
        }

        /** @var Orden $orden */
        foreach ($ordenes as $orden) {

            //Volumen de la orden que va iterando
            $volumenOrden = $orden->getVolumen();

            if ($orden->isActiva() && $orden->getPrecio() === $mejorPrecioOrden) {
                $mejoresToneladas += $volumenOrden;
            } else {
                $otrasToneladas += $volumenOrden;
            }
        }

        return "$mejoresToneladas (+$otrasToneladas)";
    }

    public static function obtenerCampoOferta($mejorOferta)
    {
        if (!empty($mejorOferta)) {
            return $mejorOferta->getPrecio();
        }

        return '0';

    }
}
