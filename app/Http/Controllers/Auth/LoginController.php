<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Bitacora;
use App\Usuario;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    protected $redirectTo = '/admin/inicio';//redirecciona a inicio o menu pricipal despues de logeado
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

public function username(){
    return 'name';
}
protected function credentials(\Illuminate\Http\Request $request)//para filtrar que se pueda logear solamente usuarios activos
{
/*$name=$request->name;
 $this->bitacora(array(
            "operacion" => 'Inicio de sesión'
        ),$name);*/
    return['name'=>$request->{$this->username()},'password'=>$request->password, 'estado'=>1];
}


 /*
    public function bitacora($operacion = array(),$name)
    {       
        $user=Usuario::where('name',$name)->first();
        if()
        $usuarioname=$user->empleado->v_nombres ." ".$user->empleado->v_apellidos;
        $item = new Bitacora;
        $item->user_id = $user->id;
        $item->usuario_nombre = $usuarioname;
        $item->operacion = json_encode($operacion);
        $item->save();
    }*/


}