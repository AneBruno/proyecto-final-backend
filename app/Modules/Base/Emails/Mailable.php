<?php

namespace App\Modules\Base\Emails;

use App\Modules\Usuarios\Usuarios\User;
use App\Modules\Usuarios\Usuarios\UserService;

class Mailable extends \Illuminate\Mail\Mailable
{
	public function buildViewData() {
		$data = parent::buildViewData();
		return $data;
	}

}