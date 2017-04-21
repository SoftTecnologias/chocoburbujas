<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{

    /**
     * IsAdmin constructor.
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
    public function handle($request, Closure $next, $guard = null)
    {

        if($this->auth->user()->isAdmin()) {
            return $next($request);
        }else{
           $this->auth->logout();
           return redirect()->route('user.login');
        }
    }
}
