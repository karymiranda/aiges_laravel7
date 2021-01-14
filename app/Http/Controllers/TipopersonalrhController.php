<?php

namespace App\Http\Controllers;

use App\Http\Requests\TipoPersonalRequest;
use App\Http\Controllers\Controller;

use App\TipoPersonal;
use Laracasts\Flash\Flash;
use Carbon\Carbon;

class TipopersonalrhController extends Controller
{
     public function index()
	{
		$tiposPersonal = TipoPersonal::orderBy('id','ASC')->where('estado','=','1')->get();
		return view('admin.configuraciones.recursohumano.tipopersonal.listatipopersonalrh')->with('tipos',$tiposPersonal);		
	}
	
	public function creartipopersonal()
	{
		$cont = TipoPersonal::count();
		if($cont!=0){
			$tipos = TipoPersonal::all();
			$codigo = $tipos->Last()->id+1;
		}else{
			$codigo = 1;
		}
		
		return view('admin.configuraciones.recursohumano.tipopersonal.creartipopersonalrh')->with('codigo',$codigo);		
	}

	public function editartipopersonal($id)
	{
		$tipo = TipoPersonal::find($id);
		return view('admin.configuraciones.recursohumano.tipopersonal.editartipopersonalrh')->with('tipo',$tipo);		
	}

	public function agregartipopersonal(TipoPersonalRequest $Request)
	{
		$tipo = new TipoPersonal($Request->all());
		$tipo->save();
		Flash::success("El tipo de personal " . $tipo->v_tipopersonal . " ha sido guardado")->important();
		return redirect()->route('listatipopersonalrh');		
	}

	public function actualizartipopersonal(TipoPersonalRequest $request, $id)
	{
		$tipo = TipoPersonal::find($id);
		$tipo->v_tipopersonal = $request->v_tipopersonal;
		$tipo->save();
		Flash::success("El tipo de personal " . $tipo->v_tipopersonal . " ha sido actualizado")->important();
		return redirect()->route('listatipopersonalrh');		
	}

	public function eliminartipopersonal($id)
	{
		$tipo = TipoPersonal::find($id);
		$tipo->estado = 0;
		$tipo->save();
		Flash::error("El tipo de personal " . $tipo->v_tipopersonal . " ha sido eliminado")->important();
		return redirect()->route('listatipopersonalrh');
	}
}
