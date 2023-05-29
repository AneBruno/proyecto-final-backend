<?php

namespace App\Modules\Direcciones;

use App\Modules\Google\Places\PlacesService;
use App\Factories\ModelFilesServiceFactory;

class Direcciones {

    static public function actualizarUbicacionPorPlaceId(
        ModeloConLocalizacion $modelo,
        string $placeId
    ): ModeloConLocalizacion {
        $detalles = PlacesService::obtenerDetalles($placeId);
        $modelo->actualizarUbicacion(
            $detalles->latitud,
            $detalles->longitud,
            $detalles->codigo_postal,
            $detalles->direccion,
            $detalles->localidad,
            $detalles->departamento,
            static::corregirNombreProvincia($detalles->provincia),
        );

        static::generarArchivoMapa($modelo, $detalles->mapcontent);

        return $modelo;
    }

    static public function generarArchivoMapa(ModeloConLocalizacion $modelo, string $content) {
        ModelFilesServiceFactory::create($modelo, 'mapa')->storeContent($modelo->id, base64_decode($content));
    }

    static public function getUrlImagen(ModeloConLocalizacion $modelo): string {
        return ModelFilesServiceFactory::create($modelo, 'mapa')->getUrl($modelo->id);
    }

    /**
     * @param string $nombre
     * @return string
     */
    public static function corregirNombreProvincia(string $nombre): string {
        /**
         * Si el valor contiene el nombre de una provincia, utiliza esa provincia.
         **/
        $resultado = DireccionesHelper::mapperNombresProvincia($nombre);

        if (!$resultado) { //si no pudo mappear el valor con la provincia
            $resultado = DireccionesHelper::mapperNombresAuxiliaresProvincia($nombre);
        }

        return $resultado ? $resultado : $nombre;
    }
}
