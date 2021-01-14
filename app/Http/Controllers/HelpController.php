<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelpController extends Controller
{
    public function index()
    {
    	return view('admin.ayuda.ayuda');
    }
    public function ayuda_estudiante()
    {
    	return view('admin.ayuda.ayuda_estudiante');
    }
    public function ayuda_docente()
    {
    	return view('admin.ayuda.ayuda_docente');
    }
     public function ayuda_bonoescolar()
    {
    	return view('admin.ayuda.ayuda_adminbonoescolar');
    }
    public function ayuda_adminacademica()
    {
    	return view('admin.ayuda.ayuda_adminacademica');
    }
     public function ayuda_adminactivofijo()
    {
    	return view('admin.ayuda.ayuda_adminactivofijo');
    }
    public function ayuda_padredefamilia()
    {
    	return view('admin.ayuda.ayuda_padredefamilia');
    }
     public function ayuda_adminrrhh()
    {
    	return view('admin.ayuda.ayuda_adminrrhh');
    }
}
