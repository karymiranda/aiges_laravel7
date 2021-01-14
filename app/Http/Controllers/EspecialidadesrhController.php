<?php

namespace App\Http\Controllers;

use App\Http\Requests\EspecialidadRequest;
use App\Http\Controllers\Controller;

use App\Especialidad;
use Laracasts\Flash\Flash;


class EspecialidadesrhController extends Controller
{
    public function index()
	{
		$especialidades = Especialidad::orderBy('id','ASC')->where('estado','=','1')->get();
		return view('admin.configuraciones.recursohumano.especialidad.listaespecialidadrh')->with('especialidades',$especialidades);		
	}

	public function crearespecialidad()
	{
		$cont = Especialidad::count();
		if($cont!=0){
			$especialidades = Especialidad::all();
			$codigo = $especialidades->Last()->id+1;
		}else{
			$codigo = 1;
		}
		
		return view('admin.configuraciones.recursohumano.especialidad.crearespecialidadrh')->with('codigo',$codigo);		
	}

	public function editarespecialidad($id)
	{
		$especialidad = Especialidad::find($id);
		return view('admin.configuraciones.recursohumano.especialidad.editarespecialidadrh')->with('especialidad',$especialidad);		
	}

	public function actualizarespecialidad(EspecialidadRequest $request, $id)
	{
		$especialidad = Especialidad::find($id);
		$especialidad->v_especialidad = $request->v_especialidad;
		$especialidad->save();
		Flash::success("La especialidad " . $especialidad->v_especialidad . " ha sido actualizada")->important();
		return redirect()->route('listaespecialidadrh');		
	}

	public function eliminarespecialidad($id)
	{
		$especialidad = Especialidad::find($id);
		$especialidad->estado = 0;
		$especialidad->save();
		Flash::error("La especialidad " . $especialidad->v_especialidad . " ha sido eliminada")->important();
		return redirect()->route('listaespecialidadrh');
	}

	public function agregarespecialidad(EspecialidadRequest $Request)
	{
		$especialidad = new Especialidad($Request->all());
		$especialidad->save();
		Flash::success("La especialidad " . $especialidad->v_especialidad . " ha sido guardada")->important();
		return redirect()->route('listaespecialidadrh');		
	}
}
