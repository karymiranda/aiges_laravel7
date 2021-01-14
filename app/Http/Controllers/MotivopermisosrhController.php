<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MotivoPermiso;
use Laracasts\Flash\Flash;
use Carbon\Carbon;


class MotivopermisosrhController extends Controller
{ 
   
   	public function index()
	{
		$motivoPermisos = MotivoPermiso::orderBy('id','ASC')->where('estado','=','1')->get();
		return view('admin.configuraciones.recursohumano.motivopermisos.listamotivopermisos',compact('motivoPermisos'));		
	}

	public function crearmotivopermisos()
	{
dd('exito');
	}
	
}
