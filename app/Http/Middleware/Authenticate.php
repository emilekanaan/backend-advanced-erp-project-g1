<?php

namespace App\Http\Middleware;
use closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request)
    {
    
        return $request->expectsJson() ? null : route('authenticate');
      
    }
    public function handle($request, Closure $next, ...$guards)
    {
      
        $jwt_name = env("JWT_SECRET");
        if($jwt=$request->cookie($jwt_name)){
            $request->headers->set('Authorization','Bearer ' . $jwt);
        }  
        $this->authenticate($request, $guards);

        return $next($request);
   
    }
}
