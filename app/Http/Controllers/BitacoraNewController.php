<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bitacora;

class BitacoraNewController extends Controller
{
    public function index()
    {
    	$bitacora=Bitacora::all();
    	return view('admin.seguridad.bitacora.indexbitacora',compact('bitacora'));
    }
}
