<?php

namespace App\Http\Middleware;

use Closure;
use App\RolesSesion;

class RecursoHumanoAdminRol
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
        if($rols[7]==false && $rols[0]==false)//si es admin academico y superusuario
        {
            return redirect()->route('restringido');
        }
        return $next($request);
    }
}
