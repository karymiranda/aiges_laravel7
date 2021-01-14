<?php

namespace App\Http\Controllers;

use App\Empleado;
use App\Http\Requests\HorariosEmpleadoRequest;
use App\HorariosEmpleado;
use Laracasts\Flash\Flash;

class HorariosEmpleadosController extends Controller
{
    public function index()
	{
		$empleados = Empleado::orderBy('id','ASC')->where('estado','=','1')->get();
		$empleados->each(function($empleados){ 
			$empleados->cargo;
			$empleados->tipoPersonal;
			$empleados->horarios;
		});
		return view('admin.recursohumano.horarios.listaempleados')->with('empleados',$empleados);	
	}

	public function crearhorario($id)
	{
		$empleado = Empleado::find($id);		
		return view('admin.recursohumano.horarios.crearhorario')->with('empleado',$empleado);	
	}

	public function agregarhorario(HorariosEmpleadoRequest $request)
	{
		
		$dias=['Lunes','Martes','Miercoles','Jueves','Viernes','Sabado','Domingo'];
		$i=null;
		for($i=0;$i<7;$i++){
			$horarios = new HorariosEmpleado;
			$horarios->empleado_id=$request->empleado_id;
			$horarios->dia=$dias[$i];
			switch ($i) {
				case '0':
					if($request->txthoraLE!=''){
						$horarios->entrada1=date('H:i:s',strtotime($request->txthoraLE));
						$horarios->salida1=date('H:i:s',strtotime($request->txthoraLS));
					}
					if($request->txthoraLE2!=''){
						$horarios->entrada2=date('H:i:s',strtotime($request->txthoraLE2));
						$horarios->salida2=date('H:i:s',strtotime($request->txthoraLS2));
					}
					$horarios->save();
					break;
				case '1':
					if($request->txthoraME!=''){
						$horarios->entrada1=date('H:i:s',strtotime($request->txthoraME));
						$horarios->salida1=date('H:i:s',strtotime($request->txthoraMS));
					}
					if($request->txthoraME2!=''){
						$horarios->entrada2=date('H:i:s',strtotime($request->txthoraME2));
						$horarios->salida2=date('H:i:s',strtotime($request->txthoraMS2));
					}
					$horarios->save();
					break;
				case '2':
					if($request->txthoraMiE!=''){
						$horarios->entrada1=date('H:i:s',strtotime($request->txthoraMiE));
						$horarios->salida1=date('H:i:s',strtotime($request->txthoraMiS));
					}
					if($request->txthoraMiE2!=''){
						$horarios->entrada2=date('H:i:s',strtotime($request->txthoraMiE2));
						$horarios->salida2=date('H:i:s',strtotime($request->txthoraMiS2));
					}
					$horarios->save();
					break;
				case '3':
					if($request->txthoraJE!=''){
						$horarios->entrada1=date('H:i:s',strtotime($request->txthoraJE));
						$horarios->salida1=date('H:i:s',strtotime($request->txthoraJS));
					}
					if($request->txthoraJE2!=''){
						$horarios->entrada2=date('H:i:s',strtotime($request->txthoraJE2));
						$horarios->salida2=date('H:i:s',strtotime($request->txthoraJS2));
					}
					$horarios->save();
					break;
				case '4':
					if($request->txthoraVE!=''){
						$horarios->entrada1=date('H:i:s',strtotime($request->txthoraVE));
						$horarios->salida1=date('H:i:s',strtotime($request->txthoraVS));
					}
					if($request->txthoraVE2!=''){
						$horarios->entrada2=date('H:i:s',strtotime($request->txthoraVE2));
						$horarios->salida2=date('H:i:s',strtotime($request->txthoraVS2));
					}
					$horarios->save();
					break;
				case '5':
					if($request->txthoraSE!=''){
						$horarios->entrada1=date('H:i:s',strtotime($request->txthoraSE));
						$horarios->salida1=date('H:i:s',strtotime($request->txthoraSS));
						
					}
					if($request->txthoraSE2!=''){
						$horarios->entrada2=date('H:i:s',strtotime($request->txthoraSE2));
						$horarios->salida2=date('H:i:s',strtotime($request->txthoraSS2));
					}
					$horarios->save();
					break;
				case '6':
					if($request->txthoraDE!=''){
						$horarios->entrada1=date('H:i:s',strtotime($request->txthoraDE));
						$horarios->salida1=date('H:i:s',strtotime($request->txthoraDS));
					}
					if($request->txthoraDE2!=''){
						$horarios->entrada2=date('H:i:s',strtotime($request->txthoraDE2));
						$horarios->salida2=date('H:i:s',strtotime($request->txthoraDS2));
					}
					$horarios->save();
					break;
				default:
					break;
			}			
		}
		Flash::success("El horario del empleado " . $request->empleado . " ha sido guardado")->important();
		return redirect()->route('listaempleados');
	}

	public function editarhorario($id)
	{
		$empleado = Empleado::find($id);
		$horarios = HorariosEmpleado::where('empleado_id','=',$id)->get();
		return view('admin.recursohumano.horarios.editarhorario')->with('empleado',$empleado)->with('horarios',$horarios);
	}

	public function actualizarhorario(HorariosEmpleadoRequest $request,$id)
	{
		$horarios = HorariosEmpleado::where('empleado_id','=',$id)->get();
		if($request->txthoraLE!=''){
			$horarios[0]->entrada1=date('H:i:s',strtotime($request->txthoraLE));
			$horarios[0]->salida1=date('H:i:s',strtotime($request->txthoraLS));
		}else{
			$horarios[0]->entrada1=null;
			$horarios[0]->salida1=null;
		}
		if($request->txthoraLE2!=''){
			$horarios[0]->entrada2=date('H:i:s',strtotime($request->txthoraLE2));
			$horarios[0]->salida2=date('H:i:s',strtotime($request->txthoraLS2));
		}else{
			$horarios[0]->entrada2=null;
			$horarios[0]->salida2=null;
		}
		$horarios[0]->save();
		if($request->txthoraME!=''){
			$horarios[1]->entrada1=date('H:i:s',strtotime($request->txthoraME));
			$horarios[1]->salida1=date('H:i:s',strtotime($request->txthoraMS));
		}else{
			$horarios[1]->entrada1=null;
			$horarios[1]->salida1=null;
		}
		if($request->txthoraME2!=''){
			$horarios[1]->entrada2=date('H:i:s',strtotime($request->txthoraME2));
			$horarios[1]->salida2=date('H:i:s',strtotime($request->txthoraMS2));
		}else{
			$horarios[1]->entrada2=null;
			$horarios[1]->salida2=null;
		}
		$horarios[1]->save();
		if($request->txthoraMiE!=''){
			$horarios[2]->entrada1=date('H:i:s',strtotime($request->txthoraMiE));
			$horarios[2]->salida1=date('H:i:s',strtotime($request->txthoraMiS));
		}else{
			$horarios[2]->entrada1=null;
			$horarios[2]->salida1=null;
		}
		if($request->txthoraMiE2!=''){
			$horarios[2]->entrada2=date('H:i:s',strtotime($request->txthoraMiE2));
			$horarios[2]->salida2=date('H:i:s',strtotime($request->txthoraMiS2));
		}else{
			$horarios[2]->entrada2=null;
			$horarios[2]->salida2=null;
		}
		$horarios[2]->save();
		if($request->txthoraJE!=''){
			$horarios[3]->entrada1=date('H:i:s',strtotime($request->txthoraJE));
			$horarios[3]->salida1=date('H:i:s',strtotime($request->txthoraJS));
		}else{
			$horarios[3]->entrada1=null;
			$horarios[3]->salida1=null;
		}
		if($request->txthoraJE2!=''){
			$horarios[3]->entrada2=date('H:i:s',strtotime($request->txthoraJE2));
			$horarios[3]->salida2=date('H:i:s',strtotime($request->txthoraJS2));
		}else{
			$horarios[3]->entrada2=null;
			$horarios[3]->salida2=null;
		}
		$horarios[3]->save();
		if($request->txthoraVE!=''){
			$horarios[4]->entrada1=date('H:i:s',strtotime($request->txthoraVE));
			$horarios[4]->salida1=date('H:i:s',strtotime($request->txthoraVS));
		}else{
			$horarios[4]->entrada1=null;
			$horarios[4]->salida1=null;
		}
		if($request->txthoraVE2!=''){
			$horarios[4]->entrada2=date('H:i:s',strtotime($request->txthoraVE2));
			$horarios[4]->salida2=date('H:i:s',strtotime($request->txthoraVS2));
		}else{
			$horarios[4]->entrada2=null;
			$horarios[4]->salida2=null;
		}
		$horarios[4]->save();
		if($request->txthoraSE!=''){
			$horarios[5]->entrada1=date('H:i:s',strtotime($request->txthoraSE));
			$horarios[5]->salida1=date('H:i:s',strtotime($request->txthoraSS));	
		}else{
			$horarios[5]->entrada1=null;
			$horarios[5]->salida1=null;
		}
		if($request->txthoraSE2!=''){
			$horarios[5]->entrada2=date('H:i:s',strtotime($request->txthoraSE2));
			$horarios[5]->salida2=date('H:i:s',strtotime($request->txthoraSS2));
		}else{
			$horarios[5]->entrada2=null;
			$horarios[5]->salida2=null;
		}
		$horarios[5]->save();
		if($request->txthoraDE!=''){
			$horarios[6]->entrada1=date('H:i:s',strtotime($request->txthoraDE));
			$horarios[6]->salida1=date('H:i:s',strtotime($request->txthoraDS));
		}else{
			$horarios[6]->entrada1=null;
			$horarios[6]->salida1=null;
		}
		if($request->txthoraDE2!=''){
			$horarios[6]->entrada2=date('H:i:s',strtotime($request->txthoraDE2));
			$horarios[6]->salida2=date('H:i:s',strtotime($request->txthoraDS2));
		}else{
			$horarios[6]->entrada2=null;
			$horarios[6]->salida2=null;
		}
		$horarios[6]->save();

		Flash::success("El horario del empleado " . $request->empleado . " ha sido actualizado")->important();
		return redirect()->route('listaempleados');
	}

	public function verhorario($id)
	{
		$empleado = Empleado::find($id);
		$horarios = HorariosEmpleado::where('empleado_id','=',$id)->get();
		foreach ($horarios as $horario) {
			if($horario->entrada1!=null){
				$horario->entrada1=date('g:i A',strtotime($horario->entrada1));
				$horario->salida1=date('g:i A',strtotime($horario->salida1));
			}
			if($horario->entrada2!=null){
				$horario->entrada2=date('g:i A',strtotime($horario->entrada2));
				$horario->salida2=date('g:i A',strtotime($horario->salida2));
			}
		}
		return view('admin.recursohumano.horarios.verhorario')->with('empleado',$empleado)->with('horarios',$horarios);
	}

}
