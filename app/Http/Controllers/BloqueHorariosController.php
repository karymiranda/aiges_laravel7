<?php

namespace App\Http\Controllers;
use App\Http\Requests\BloqueHorarioRequest;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use Carbon\Carbon;
use App\BloqueHorarios;

class BloqueHorariosController extends Controller
{
     public function index()
	{
		$bloquehorario=BloqueHorarios::OrderBy('correlativo_clase','Asc')->where('estado','=','1')->get();
	return view('admin.configuraciones.administracionacademica.horariodeclases.listabloquehorarios')->with('bloquehorario',$bloquehorario);	
	}

	 public function agregarbloquehorarios()
	{
		$correlativo=BloqueHorarios::max('correlativo_clase');
		if($correlativo==null){
			$correlativo=1;
		}
			else{
$correlativo=$correlativo+1;
			}		
	return view('admin.configuraciones.administracionacademica.horariodeclases.agregarbloquehorarios')->with('correlativo',$correlativo);	
	}

	public function guardarbloquehorarios(BloqueHorarioRequest $request)
	{
		$bloquehorario=new BloqueHorarios($request->all());
		$bloquehorario->estado='1';
		$bloquehorario->hora_inicio=date('H:i:s',strtotime($request->hora_inicio));
		$bloquehorario->hora_fin=date('H:i:s',strtotime($request->hora_fin));
		$bloquehorario->save();
		Flash::success("El bloque " . $bloquehorario->correlativo_clase . " correspondiente al horario de clases ha sido creado exitosamente")->important();
		return redirect()->route('listabloquehorarios');
	}
	public function editarbloquehorarios($id)
	{
		$bloquehorario=BloqueHorarios::where('id','=',$id)->first();

return view('admin.configuraciones.administracionacademica.horariodeclases.editarbloquehorarios')->with('bloquehorario',$bloquehorario);
	}
	public function actualizarbloquehorarios(BloqueHorarioRequest $request,$id)
	{
		$bloquehorario=BloqueHorarios::find($id);
		$bloquehorario->fill($request->all());
		$bloquehorario->hora_inicio=date('H:i:s',strtotime($request->hora_inicio));
		$bloquehorario->hora_fin=date('H:i:s',strtotime($request->hora_fin));
		$bloquehorario->save();
		Flash::success("El bloque " . $bloquehorario->correlativo_clase . " ha sido actualizado")->important();
		return redirect()->route('listabloquehorarios');
	}
	public function eliminarbloquehorarios($id)
	{
$bloquehorario=BloqueHorarios::find($id);
//dd($bloquehorario);
$bloquehorario->delete();
Flash::error("El bloque " . $bloquehorario->correlativo_clase . " ha sido eliminado")->important();
return redirect()->route('listabloquehorarios');
	}
}
