<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bitacora;

class BitacoraController extends Controller
{
    public function indexbitacora()
    {
    	$bitacora=Bitacora::all();

    	return view('admin.seguridad.bitacora.indexbitacora',compact('bitacora'));
    }

}
