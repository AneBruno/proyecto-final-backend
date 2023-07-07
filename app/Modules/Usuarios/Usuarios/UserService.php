<?php

namespace App\Modules\Usuarios\Usuarios;

use App\Factories\ModelFilesServiceFactory;
use App\Mail\UsuarioNuevoMail;
use App\Modules\Usuarios\Roles\Rol;
use App\Helpers\RolesHelper;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Mailable;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\URL;

class UserService
{

    /**
     *
     * @param string $email
     * @return User | null
     */
    static public function getByEmail(string $email)
    {
        return User::getOne(['email' => $email]);
    }

    /**
     * @param string $email
     * @param string $nombre
     * @param string $apellido
     * @param string|null $url
     * @return User
     */
    static public function create(string $email, string $nombre, string $apellido, ?string $url = null): User
    {
        $user = User::crear($email, $nombre, $apellido, RolesHelper::SOPORTE_EQUIPO_NDG);

        if($url) {
            $content = file_get_contents($url);
            $storage = ModelFilesServiceFactory::create(new User());
            $storage->storeContent($user->getKey(), $content);
        }

        $admins = UserService::listarAdministradores();

		foreach ($admins as $admin) {
			static::enviarMail($admin, new UsuarioNuevoMail($user));
		}

        return $user;
    }

    /**
     *
     * @param User $user
     * @param Rol $rol
     */
    static public function setRole(User $user, Rol $rol): User
    {
        return User::getById($user->id)->actualizarRol($rol->id);
    }

    /**
     *
     * @param int $usuario_id
     * @param int $rol_id
     * @param int|null $oficina_id
     */
    static public function actualizarDatosPorAdministrador(
    	int $usuario_id,
		int $rol_id
		//?int $oficina_id
		/*int $aprobacionCbu,
		int $aprobacionGerenciaComercial,
		int $aprobacionDptoCreditos,
		int $aprobacionDptoFinanzas,
		int $confirmacionPagos*/
	): User
    {
        $usuario = User::getById($usuario_id);
        $usuario->actualizarRol($rol_id);
        //$usuario->actualizarOficina($oficina_id);
		/*$usuario->actualizarPermisosGestionSaldos(
			$aprobacionCbu,
			$aprobacionGerenciaComercial,
			$aprobacionDptoCreditos,
			$aprobacionDptoFinanzas,
			$confirmacionPagos
		);*/

        return $usuario;
    }

    /**
     *
     * @param int $usuario_id
     * @param string $nombre
     * @param string $apellido
     * @param int $telefono
     * @return User
     */
    static public function actualizarDatosPersonales(
        int           $usuario_id,
        string        $nombre,
        string        $apellido,
        bool		  $suscripto_notificaciones,
        ?int          $telefono = null,
        ?UploadedFile $foto     = null
    ): User {
        $user = User::getById($usuario_id)->actualizarDatosPersonales($nombre, $apellido, $suscripto_notificaciones, $telefono);

        if ($foto) {
            $storage = ModelFilesServiceFactory::create(new User());
            $storage->storeUploadedFile($usuario_id, $foto);
        }

        return $user;
    }

    /**
     *
     * @param int $usuario_id
     * @param bool $habilitado
     * @return User
     */
    static public function habilitar(int $usuario_id, bool $habilitado): User
    {
        $user = User::getById($usuario_id);
        return $habilitado ? $user->habilitar() : $user->deshabilitar();
    }

    static public function getUrlImagen(int $id): string {
        return ModelFilesServiceFactory::create(new User())->getUrl($id);
    }

    static public function listarAdministrativos() {
        return User::listar(1, 0, [
            'rol_id'  => RolesHelper::ADMINISTRATIVO,
            'habilitado' => true,
        ]);
    }

    static public function listarAdministradores() {
    	return User::listar(1, 0, [
    		'rol_id' => RolesHelper::ADMINISTRADOR_DE_PLATAFORMA,
			'habilitado' => true,
			'!email' => config('magic.email')
		]);
	}

    static public function enviarMail(User $user, Mailable $mail): void {
    	if (!$user->suscripto_notificaciones) {
    		return;
		}

        Mail::to($user)->send($mail);
    }

    static public function unsusbcribeFromEmailNotifications(int $userId) {
    	$user = User::getById($userId);

    	$user->suscripto_notificaciones = false;
		$user->save();

		return $user;
	}

    static public function unsubscribeFromEmailsRoute(int $userId) {
		return URL::signedRoute('unsubscribed-from-emails', ['user_id' => $userId]);
	}
}
