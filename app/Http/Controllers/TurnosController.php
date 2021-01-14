<?php

namespace App\Http\Controllers;
use App\Http\Requests\TurnoRequest;
use Illuminate\Http\Request;
use App\Turnos;
use Laracasts\Flash\Flash;
use Carbon\Carbon;

class TurnosController extends Controller
{
     public function index()
	{
	$turnos = Turnos::orderBy('id','ASC')->where('estado','=','1')->get();
	return view('admin.configuraciones.administracionacademica.turnos.listaturnos')->with('turnos',$turnos);		
	}

	public function agregarturno()
	{
return view('admin.configuraciones.administracionacademica.turnos.agregarturno');
	}

	public function guardarturno(TurnoRequest $request)
	{
		$turno= new Turnos($request->all());	    
	    $turno->horadesde = date('H:i:s',strtotime($request->horadesde));
	    $turno->horahasta = date('H:i:s',strtotime($request->horahasta)); 
	    $turno->estado = '1';
	    $turno->save();

Flash::success("Turno guardado correctamente")->important();
return redirect()->route('listaturnos');	
	}
	public function editarturno($id)
	{
		
$turnos=Turnos::find($id);
return view('admin.configuraciones.administracionacademica.turnos.editarturno')->with('turnos',$turnos);
	}

	public function actualizarturno(TurnoRequest $request,$id)
	{
$turno=Turnos::find($id);
$turno->turno= $request->turno;
$turno->horadesde = date('H:i:s',strtotime($request->horadesde));
$turno->horahasta = date('H:i:s',strtotime($request->horahasta)); 
$turno->save();
Flash::warning('Turno '. $turno->turno.' a sido actualizado exitosamente')->important();
		return redirect()->route('listaturnos');
	}

	public function desactivarturno($id)
	{
$turno=Turnos::find($id);
$turno->estado=0;
$turno->save();
Flash::error('El Turno '.$turno->turno.' a sido eliminado exitosamente')->important();
return redirect()->route('listaturnos');
	}
}
