<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TipocuentascatalogoController extends Controller
{
    public function index()
	{
	return view('admin.configuraciones.bonoescolar.tipocuentacatalogo.listatipocuenta');	
	}
	public function creartipocuenta()
	{
	return view('admin.configuraciones.bonoescolar.tipocuentacatalogo.creartipocuenta');	
	}
	public function editartipocuenta()
	{
	return view('admin.configuraciones.bonoescolar.tipocuentacatalogo.editartipocuenta');	
	}

}
