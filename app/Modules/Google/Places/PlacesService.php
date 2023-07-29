<?php
/*
namespace App\Modules\Google\Places;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 *

use App\Modules\Google\StaticMaps\StaticMap;
use Illuminate\Support\Collection;
use SKAgarwal\GoogleApi\PlacesApi;

/**
 * Description of PlacesService
 *
 * @author salomon
 *
class PlacesService {

    private static PlacesApi $api;

    private static function getInstance(): PlacesApi {
        if (empty(static::$api)) {
            static::$api = new PlacesApi(config('google.places_api_key'), true);
        }

        return static::$api;
    }

    public static function buscar(string $text, ?string $sessionToken = null): Collection {

        return static::getInstance()->placeAutocomplete($text, [
            'location'     => '-34.438136,-65.036764',
            'radius'       => 1300000,
            'strictbounds' => 1,
            'types'        => ['establishment','address','geocode'],
            'sessiontoken' => $sessionToken,
            'language'     => 'es'
        ])->get('predictions');
    }

    public static function obtenerDetalles(string $placeId, ?string $sessionToken = null): \stdClass {

        $response = static::getInstance()->placeDetails($placeId, [
            'sessiontoken' => $sessionToken,
        ])->get('result');

        $detalles = json_decode(json_encode($response));
        $latitud  = $detalles->geometry->location->lat;
        $longitud = $detalles->geometry->location->lng;

        $claves   = ['street_number','route','postal_code','locality','administrative_area_level_2','administrative_area_level_1'];
        $datos    = new \stdClass;
        foreach($claves as $clave) {
            $datos->$clave = ''; // para inicalizar todos los valores.
        }
        foreach($detalles->address_components as $component) {
            foreach($claves as $clave) {
                if (in_array($clave, $component->types)) {
                    $datos->$clave = $component->long_name;
                }
            }
        }

        return (object) [
            'nombre'        => $detalles->name,
            'latitud'       => $latitud,
            'longitud'      => $longitud,
            'codigo_postal' => $datos->postal_code,
            'direccion'     => trim("{$datos->route} {$datos->street_number}"),
            'localidad'     => $datos->locality,
            'departamento'  => self::limpiarDepartamento($datos->administrative_area_level_2),
            'provincia'     => self::limpiarProvincia($datos->administrative_area_level_1),
            'viewport'      => (object) [
                'ne_lat' => $detalles->geometry->viewport->northeast->lat,
                'ne_lng' => $detalles->geometry->viewport->northeast->lng,
                'sw_lat' => $detalles->geometry->viewport->southwest->lat,
                'sw_lng' => $detalles->geometry->viewport->southwest->lng,
            ],
            'mapcontent' => base64_encode(static::obtenerImagenMapa($latitud, $longitud)),
        ];
    }

    public static function obtenerImagenMapa(float $latitud, float $longitud): string {
        return StaticMap::getImageFromParams([
            'zoom'    => 13,
            'size'    => '600x300',
            'maptype' => 'roadmap',
            'markers' => "color:red|{$latitud},{$longitud}",
        ]);
    }

    public static function limpiarDepartamento(string $departamento): string
    {
        return str_replace(['Departamento', 'Department'], '',$departamento);
    }

    public static function limpiarProvincia(string $provincia): string
    {
        return str_replace(['Provincia de', 'Province'], '',$provincia);
    }
}*/
