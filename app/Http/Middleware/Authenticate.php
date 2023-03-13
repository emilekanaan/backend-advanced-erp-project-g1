<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo($request)
    {
        return $request->expectsJson() ? null : route('authenticate');
    }

    public function handle($request, Closure $next, ...$guards)
    {
        $jwt_name = env("JWT_SECRET");
        if ($jwt = $request->cookie($jwt_name)) {
            try {
                // Validate the token
                JWTAuth::setToken($jwt)->authenticate();
            } catch (\Exception $e) {
                // If the token is not valid, redirect to the login page
                return redirect()->route('authenticate');
            }
            // If the token is valid, set the Authorization header
            $request->headers->set('Authorization', 'Bearer ' . $jwt);
        }
        return $next($request);
    }
}
