<?php

namespace App\Modules\Auth;

use App\Modules\Usuarios\Usuarios\User;
use App\Modules\Usuarios\Usuarios\UserService;
use Carbon\Carbon;
use App\Mail\UsuarioNuevoMail;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\App;
use Kodear\Laravel\Repository\Exceptions\RepositoryException;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    
    static public function createToken(User $user)
    {
        $tokenResult = $user->createToken('Personal Access Token');

        $tokenResult->token->save();

        return $tokenResult;
    }

    static public function logout(User $user)
    {
        $user->token()->delete();
    }

    static public function login(string $email, string $password): array {

        /** @var User $user */
        try{
            $user = UserService::getByEmail($email);
        }catch (\Exception $e){
            throw new AuthenticationException(
                "Usuario y/o contraseña inválidos"
            );
        }
        
        if(!Hash::check($password, $user->password)){
            throw new AuthenticationException(
                "Usuario y/o contraseña inválidos"
            );
        }
        if ($user->habilitado == 0) {
            throw new AuthenticationException(
                "El usuario \"{$user->email}\" no está habilitado.\n" .
                "Comunicarse con el administrador."
            );
        }
        if ($user->rol_id== 6) {
            throw new AuthenticationException(
                "El usuario aún está pendiente de validación.\n" .
                "Comunicarse con el administrador."
            );
        }

        $tokenResult = static::createToken($user);

        return [
            'access_token' => $tokenResult->accessToken,
            'token_type'   => "Bearer",
            'expires_at'   => $tokenResult->token->getAttributeValue('expires_at'),
            'me'           => $user
        ];
    }
    
    static public function obtenerAccesos(User $user): array {
        $accesos = $user->rol->accesos->toArray();  
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

    static public function registro(
        string $nombre, 
        string $apellido, 
        string $telefono, 
        string $email,
        string $password,
        string $empresa_registro
    ): User{
        $password_hash = Hash::make($password);
        $usuario = User::crear($nombre,$apellido,$telefono,$email,$password_hash,$empresa_registro);
        
        $admins = UserService::listarAdministradores();

		foreach ($admins as $admin) {
			UserService::enviarMail($admin, new UsuarioNuevoMail($usuario));
		}

        return $usuario;

    }
}
