<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
//primer lugar donde ingresa al hacer post para logearse al sistema 
        if (Auth::guard($guard)->check())
        {
           // dd('cuatro');
            return redirect('menu');
        }
//dd('uno');
        return $next($request);
    }
}
