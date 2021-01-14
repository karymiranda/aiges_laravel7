<?php

namespace App\Http\Controllers;

use App\Http\Requests\CargoRequest;
use App\Http\Controllers\Controller;

use App\Cargo;
use Laracasts\Flash\Flash;

class CargosrhController extends Controller
{
    public function index()
	{
		$tipocargos = Cargo::orderBy('id','ASC')->where('estado','=','1')->get();
		return view('admin.configuraciones.recursohumano.tipocargospersonal.listatipocargorh')->with('cargos',$tipocargos);		
	}

	public function creartipocargo()
	{
		$cont = Cargo::count();
		if($cont!=0){
			$cargos = Cargo::all();
			$codigo = $cargos->Last()->id+1;
		}else{
			$codigo = 1;
		}
		return view('admin.configuraciones.recursohumano.tipocargospersonal.creartipocargorh')->with('codigo',$codigo);		
	}

	public function editartipocargo($id)
	{
		$cargo = Cargo::find($id);
		return view('admin.configuraciones.recursohumano.tipocargospersonal.editartipocargorh')->with('cargo',$cargo);		
	}

	public function actualizartipocargo(CargoRequest $request, $id)
	{
		$cargo = Cargo::find($id);
		$cargo->v_descripcion = $request->v_descripcion;
		$cargo->save();
		Flash::success("El cargo " . $cargo->v_descripcion . " ha sido actualizado")->important();
		return redirect()->route('listatipocargorh');		
	}

	public function eliminartipocargo($id)
	{
		$cargo = Cargo::find($id);
		$cargo->estado = 0;
		$cargo->save();
		Flash::error("El cargo " . $cargo->v_descripcion . " ha sido eliminado")->important();
		return redirect()->route('listatipocargorh');
	}

	public function agregartipocargo(CargoRequest $Request)
	{
		$cargo = new Cargo($Request->all());
		$cargo->save();
		Flash::success("El cargo " . $cargo->v_descripcion . " ha sido guardado")->important();
		return redirect()->route('listatipocargorh');		
	}	
}
