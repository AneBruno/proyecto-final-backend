<?php

namespace App\Modules\Google\StaticMaps;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use GuzzleHttp\Client as GuzzleClient;

/**
 * Description of PlacesService
 *
 * @author salomon
 */
class StaticMap {
    
    private static GuzzleClient $client;
    
    private static function getClient(): GuzzleClient {
        if (!isset(static::$client)) {
            static::$client = new GuzzleClient([
                'base_uri' => 'https://maps.googleapis.com/maps/api/',
            ]);
        }
        
        return static::$client;
    }
    
    public static function getImageFromParams(array $params): string {
        return static::getClient()->get('staticmap', [
            'query' => array_merge($params, [
                'key' => config('google.places_api_key'),
            ])
        ])->getBody()->getContents();
    }
}
