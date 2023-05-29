<?php

namespace App\Modules\Base\Emails;

use App\Modules\Usuarios\Usuarios\User;
use App\Modules\Usuarios\Usuarios\UserService;

class Mailable extends \Illuminate\Mail\Mailable
{
	public function buildViewData() {
		$data = parent::buildViewData();

		$data['unsuscribeRoute'] = $this->unsubscribeRoute();

		return $data;
	}

	public function unsubscribeRoute() {
		if (count($this->to) > 1) {
			return null;
		}

		$email = $this->to[0]['address'];

		$user = User::where(['email' => $email, 'suscripto_notificaciones' => 1])->first();

		if (!$user) {
			return null;
		}

		return UserService::unsubscribeFromEmailsRoute($user->id);
	}
}