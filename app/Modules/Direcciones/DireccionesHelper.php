<?php


namespace App\Modules\Direcciones;


class DireccionesHelper
{
    const NOMBRES_PROVINCIAS = [
        'Buenos Aires',
        'Capital Federal',
        'Catamarca',
        'Chaco',
        'Chubut',
        'Córdoba',
        'Corrientes',
        'Entre Ríos',
        'Formosa',
        'Jujuy',
        'La Pampa',
        'La Rioja',
        'Mendoza',
        'Misiones',
        'Neuquén',
        'Río Negro',
        'Salta',
        'San Juan',
        'San Luis',
        'Santa Cruz',
        'Santa Fe',
        'Santiago del Estero',
        'Tierra del Fuego',
        'Tucumán',
    ];

    /**
     * Aquí deberían agregarse valores de mapeo para corregir.
     * Ejemplo:
     * NOMBRES_PROVINCIAS_AUX = [
     *  'StaFe' => 'Santa Fe',
     *  'Cba'   => 'Córdoba',
     * ]
     **/
    const NOMBRES_PROVINCIAS_AUX = [];

    /**
     * @param string $nombre
     * @return false|string
     */
    static public function mapperNombresProvincia(string $nombre)
    {
        foreach(self::NOMBRES_PROVINCIAS as $provincia) {
            if (preg_match("/{$provincia}/i", $nombre)) {
                return $provincia;
            }
        }
        return false;
    }

    /**
     * @param string $nombre
     * @return false|mixed
     */
    static public function mapperNombresAuxiliaresProvincia(string $nombre)
    {
        /**
         * Si está mapeado devuelve el valor de corrección.
         **/
        if (isset(self::NOMBRES_PROVINCIAS_AUX[$nombre])) {
            return self::NOMBRES_PROVINCIAS_AUX[$nombre];
        }
        return false;
    }
}
