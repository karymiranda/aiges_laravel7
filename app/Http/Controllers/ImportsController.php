<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\ActivofijoImport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;


class ImportsController extends Controller
{
 public function subirarchivoactivofijo()
 {
return view('admin.activofijo.activos.excelaDBactivofijo');
 }

public function store(Request $request)
{

$file=$request->file('file')->store('import');
$import=new ActivofijoImport;
$import->import($file);
if($import->failures()->isNotEmpty())
{
return back()->withFailures($import->failures()); 
}
/*
$file=$request->file('file');
Excel::import(new ActivofijoImport,$file);*/
return redirect()->back()->with('message','Archivo subido exitosamente');

}

}
