<?php

namespace App\Http\Middleware;

use Closure;

class VerifyGoogleAuthToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->hasHeader('X-go-token')) {
            return $next($request);
        }

        return response()->json([
            'message' => 'X-go-token required'
        ], 403);
    }
}
