<?php

namespace App\Http\Middleware;

use Closure;
use App\RolesSesion;

class EstudianteRol
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
        $rols=RolesSesion::sesionRoles();
        if($rols[5]==false && $rols[0]==false)//si es estudiante y superusuario
        {
            return redirect()->route('restringido');
        }
        return $next($request);
    }
}
