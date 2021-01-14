<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Periodoactivo;
use App\Http\Requests\PeriodocontableRequest;
use App\Usuarios;
use Carbon\Carbon;
use Laracasts\Flash\Flash;

class PeriodocontableController extends Controller
{
    public function index()
	{
		$periodoactivo= Periodoactivo::where([['estado','=','1'],['tipo_periodo','like','CONTABLE']]);
return view('admin.configuraciones.bonoescolar.periodocontable.periodocontable');
	}

	public function listaperiodocontable()
	{
$ciclos=Periodoactivo::orderBy('anio','DESC')->where('tipo_periodo','like','CONTABLE')->get();
//$mostrarboton=Periodoactivo::where('estado','=','1')->count();
$mostrarboton=0;

return view('admin.configuraciones.bonoescolar.periodocontable.listadeperiodoscontable', compact('ciclos','mostrarboton'));
	}

	public function cerrarperiodocontable(Request $request)
	{
$datos=Periodoactivo::orderBy('anio','DESC')->where([['tipo_periodo','like','CONTABLE'],['id',$request->id]])->first();
$datos->estado=0;
$datos->save();
Flash::success($datos->nombre . " cerrado exitosamente")->important();
    return redirect()->route('listaperiodocontable');


	}

public function editarperiodocontable($id)
	{
$periodos=$this->anyos();
$ciclos=Periodoactivo::find($id);
return view('admin.configuraciones.bonoescolar.periodocontable.editarperiodocontable')->with('periodos',$periodos)->with('ciclos',$ciclos);
	}

	public function actualizarperiodocontable(Request $request,$id)
	{
$ciclos=Periodoactivo::find($id);
$ciclos->nombre = $request->nombre;
$ciclos->anio = $request->anio;
$ciclos->save();
Flash::success("El ciclo periodo contable ha sido actualizado")->important();
return redirect()->route('listaperiodocontable');
	}

public function guardarperiodocontable(Request $request)
	{

	$cicloacademico=new Periodoactivo($request->all());	
	$cicloacademico->tipo_periodo="CONTABLE";
	$fecha=Carbon::now();
    $cicloacademico->fechainiciociclo= $fecha->format('Y-m-d');
    $cicloacademico->fechacierreciclo=null;
    $cicloacademico->estado='1';		
	$cicloacademico->save();
    Flash::success($cicloacademico->nombre ." guardado exitosamente")->important();
    return redirect()->route('listaperiodocontable');	
	}


	public function registrarperiodocontable()
	{
$periodos=$this->anyos();
return view('admin.configuraciones.bonoescolar.periodocontable.regitrarperiodocontable')->with('periodos',$periodos);
	}

	protected function anyos()
	{
	$anio = Carbon::now()->year;
for ($i=$anio+1; $i >2015 ; $i--) { //ara qu me envie la lista de los años a partir del 2000 al año actual+1
	$periodos[$i]=$i;}	
	return $periodos;	
	}
}
