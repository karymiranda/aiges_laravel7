<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\RolesSesion;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('admin.menuprincipal',function($view){
            $view->with('roles',RolesSesion::sesionRoles());//cuando cargue vistas que tengan como raiz admin.menuprincipal se le agregara a esta vista, las variable global roles que contendra info del usuario y su sesion
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
