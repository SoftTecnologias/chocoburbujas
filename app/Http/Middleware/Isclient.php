<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;

class Isclient
{
    /**
     * Isclient constructor.
     * @param Guard $auth
     */
    function __construct(Guard $auth){
        $this->auth = $auth;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard=null)
    {
        if (!Auth::guard($guard)->user()) {
            if(!Auth::guard($guard)->guest())
                Auth::guard($guard)->user().logout();
            return redirect()->route('cliente.login');
        }
        return $next($request);
    }
}
