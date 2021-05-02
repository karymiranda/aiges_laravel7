<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bitacora;
use Carbon\Carbon;

class BitacoraNewController extends Controller
{
    public function index()
    {
    	$bitacora=Bitacora::orderBy('created_at','DESC')->get();

    	return view('admin.seguridad.bitacora.indexbitacora',compact('bitacora'));
    }
}
