<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RolUsuario;
use Laracasts\Flash\Flash;
use Carbon\Carbon;

class RolesController extends Controller
{
    public function index()
    {
    	$roles=RolUsuario::orderBy('id','ASC')->where('i_estado','=','1')->get();
    	//dd($roles);
return view('admin.seguridad.roles.rolesusuarios')->with('roles',$roles);
    }
}
