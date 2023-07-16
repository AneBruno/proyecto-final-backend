<?php

/*namespace App\Modules\Extranet\Auth;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

class MagicClient {
    
    static $token = '';
    
    static public function get(string $uri) {
        $response = static::getClient()->get($uri, [
            'headers' => [
                'Authorization' => 'Bearer ' . static::getToken(),
            ]
        ]);
        
        return static::parseResponse($response);
    }
    
    static public function getToken() {
        if (!static::$token) {
            static::$token = static::login();
        }
        
        return static::$token;
    }
    
    static public function login() {
        $response = static::getClient()->post('/token', [
            'auth' => [ 
                config('magic.api.username'), 
                config('magic.api.password'),
            ],
            'form_params' => [
                'grant_type' => 'client_credentials',
            ]
        ]);
        
        $parsed = static::parseResponse($response);
        
        return $parsed[0]['token'];
    }
    
    static public function getClient() {
        return new Client([
            'base_uri' => config('magic.api.base_uri'),
        ]);
    }
    
    static public function parseResponse(ResponseInterface $response) {
        $content = $response->getBody()->getContents();
        $json = json_decode($content, true);
        
        return $json['data'];
    }
}*/