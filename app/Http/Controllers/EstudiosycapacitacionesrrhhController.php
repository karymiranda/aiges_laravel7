<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empleado;
use App\Estudiosrrhh;
use App\Http\Requests\EstudiosrrhhRequest;
use Carbon\Carbon;
use Laracasts\Flash\Flash;

class EstudiosycapacitacionesrrhhController extends Controller
{
    public function index($id)
    {
    	$exp=Empleado::find($id);
    	$estudio=Estudiosrrhh::where('empleado_id',$id)->get();
    	//dd($estudios);
return view('admin.recursohumano.expedientes.estudiosycapacitaciones',compact('exp','estudio'));
    }
    public function agregarestudios($id)
    {
return view('admin.recursohumano.expedientes.agregarestudios',compact('id'));
 
    }
    public function guardarestudios(EstudiosrrhhRequest $request)
    {
$estudio=new Estudiosrrhh($request->all());
//dd($estudio);
$empleado_id=$request->empleado_id;
$estudio->save();
Flash::success("La información ha sido guardada")->important();
return redirect()->route('estudiosycapacitacionesrrhh',compact('empleado_id'));
    }
    public function editarestudios($id)
    {
$estudios=Estudiosrrhh::find($id);
//dd($estudios);
return view('admin.recursohumano.expedientes.editarestudios',compact('estudios'));
    }

    public function actualizarestudios(Request $request)
    {
$estudios=Estudiosrrhh::find($request->id);
//dd($estudios);
$empleado_id=$estudios->empleado_id;
$estudios->fill($request->all());
$estudios->save();
Flash::success("Información  actualizada exitosamente")->important();
return redirect()->route('estudiosycapacitacionesrrhh',$empleado_id);
    }
}
