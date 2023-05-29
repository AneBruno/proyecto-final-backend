<?php

namespace App\Modules\Auth;

use App\Http\Controllers\Controller;
use App\Modules\Auth\AuthService;
use App\Modules\Usuarios\Usuarios\UserResource;
use Illuminate\Http\Request;

class HttpController extends Controller
{
    public function login(Request $request)
    {
        $loginInfo  = AuthService::login(
            $request->header('X-go-token'), 
            $request->get('remember_me')
        );
        
        return response()->json([
            'access_token' => $loginInfo['access_token'],
            'token_type'   => $loginInfo['token_type'  ],
            'expires_at'   => $loginInfo['expires_at'  ],
            'me'           => new UserResource($loginInfo['me']),
        ]);
    }
    
    public function getUser(Request $request) {
        $user = $request->user();
        return new UserResource($user);
    }

    public function logout(Request $request)
    {
        AuthService::logout($request->user());

        return response()->json();
    }
}
