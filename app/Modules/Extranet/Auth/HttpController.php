<?php

/*namespace App\Modules\Extranet\Auth;

use App\Exceptions\BusinessException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HttpController extends Controller {
    
    public function login(Request $request) {
        try {            
            $response = AuthService::login($request->get('token'));
        } catch (BusinessException $ex) {
            abort(401);
        }
        
        return $this->json($response);
    }
}
*/