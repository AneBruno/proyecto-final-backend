<?php

namespace App\Modules\Auth;

use App\Modules\Usuarios\Usuarios\User;
use App\Modules\Usuarios\Usuarios\UserService;
use Carbon\Carbon;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\App;
use Kodear\Laravel\Repository\Exceptions\RepositoryException;

class AuthService
{

    static public function createToken(User $user, $rememberMe)
    {
        $tokenResult = $user->createToken('Personal Access Token');

        if ($rememberMe) {
            $tokenResult->token->expires_at = Carbon::now()->addWeek();
        }

        $tokenResult->token->save();

        return $tokenResult;
    }

    static public function logout(User $user)
    {
        $user->token()->delete();
    }

    static public function login($gooToken, $rememberMe = false): array {
        $rawUser = App::make(GoogleService::class)->login($gooToken);

        /** @var User $user */
        try {
            $user = UserService::getByEmail($rawUser['email']);
        } catch (RepositoryException $e) {
            $user = UserService::create(
                $rawUser['email'      ],
                $rawUser['given_name' ],
                $rawUser['family_name'],
                $rawUser['picture'    ]
            );
        }

        if ($user->getAttributeValue('habilitado') == 0) {
            throw new AuthenticationException(
                "El usuario \"{$user->email}\" no está habilitado para ingresar al sistema. <br />\n" .
                "Para solicitar la habilitación comuníquese con el administrador de la plataforma"
            );
        }

        $tokenResult = static::createToken($user, $rememberMe);

        return [
            'access_token' => $tokenResult->accessToken,
            'token_type'   => "Bearer",
            'expires_at'   => $tokenResult->token->getAttributeValue('expires_at'),
            'me'           => $user
        ];
    }
    
    static public function obtenerAccesos(User $user): array {
        $accesos = $user->rol->accesos->toArray();
        if (
            $user->aprobacion_gerencia_comercial || 
            $user->aprobacion_dpto_creditos      || 
            $user->aprobacion_dpto_finanzas      ||
            $user->confirmacion_pagos
        ) {
            $accesos[] = static::crearRegistro('Solicitudes de cobro', 'Saldos', 1001, 'menu', 'gestion-saldos/solicitudes-cobro');
        }
        
        if ($user->aprobacion_cbu) {
            $accesos[] = static::crearRegistro('Solicitudes de CBU',   'Saldos', 1002, 'menu', 'gestion-saldos/solicitudes-cbu'  );
        }
        
        
        return $accesos;
    }
    
    static private function crearRegistro(string $nombre, ?string $grupo, ?int $orden, string $tipo, ?string $uri) {
        return [
            'id'          => null,
            'nombre'      => $nombre,
            'descripcion' => null,
            'grupo'       => $grupo,
            'orden'       => $orden,
            'tipo'        => $tipo,
            'uri'         => $uri,
        ];
    }
}
