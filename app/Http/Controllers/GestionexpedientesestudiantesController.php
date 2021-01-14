<?php

namespace App\Http\Controllers;
use App\Http\Requests\ExpedienteEstudianteDatosPersonalesRequest;
use App\Http\Requests\ExpedienteEstudianteDatosMedicosRequest;
use App\Http\Requests\UsuarioAcademicoRequest;
 
use Illuminate\Http\Request;
use App\Expedienteestudiante;
use App\Departamentos;
use App\Municipios;
use App\Familiares;
use App\RolUsuario;
use App\Datosmedicosestudiante;
use App\Usuario;
use App\Seccion;
use App\Periodoactivo;
use App\CuadroFinalNota;
use Laracasts\Flash\Flash;
use Carbon\Carbon;
use App\Bitacora;
use App\Faltasestudiantes;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class GestionexpedientesestudiantesController extends Controller
{ 

	public function bitacora($operacion = array())
	{
		$usuario = Auth::user()->id;
		$item = new Bitacora;
		$item->user_id = $usuario;
		$item->operacion = json_encode($operacion);
		$item->save();
	}

    public function index()
	{
		$this->bitacora(array(
			"operacion" => 'Consultar lista de estudiantes activos'
		));
	
		$expedientes =Expedienteestudiante::orderBy('id','ASC')
			->where('estado','=','1')
			->get();

		return view('admin.academica.expedientesestudiantes.listadeexpedientesactivos')
			->with('expedientes',$expedientes);	
	}

	 public function listadeexpedientesinactivos()
	{
	$expedientes=Expedienteestudiante::orderBy('id','ASC')->where('estado','=','0')->get();
	return view('admin.academica.expedientesestudiantes.listaexpedientesinactivos')->with('expedientes',$expedientes);	
	}

	public function activarexpedientesinactivosest($id)
	{
$estudiante=Expedienteestudiante::find($id);
$estudiante->estado=1;
$estudiante->save();
$usuario =  Usuario::where('estudiante_id','=',$estudiante->id)->first();
$usuario->estado = 1;
$usuario->save();
Flash::success('El estudiante '.$estudiante->v_nombres.' '. $estudiante->v_apellidos.' a sido habilitado exitosamente')->important();
	return redirect()->route('listadeexpedientesinactivos');
	}


	public function registrardatospersonales()
	{
		$departamentos = Departamentos::orderBy('v_departamento','ASC')->pluck('v_departamento','id');
		$contador=Expedienteestudiante::count();
		if($contador!=0)//la base no esta vacia
		{
			$contExp=Expedienteestudiante::all();
			$correlativo=$contExp->Last()->id+1;
		}else{
			$correlativo=1;//si la base esta vacia el correlativo del numero expediente sera 1
		}
		
		$fecha = Carbon::create();
		$expediente = 'ES' . '' . $fecha->year . '-' . $correlativo;
		return view('admin.academica.expedientesestudiantes.registrardatospersonalestudiante')->with('expediente',$expediente)->with('departamentos',$departamentos);	
	}

	public function municipios($id)
	{	
		$id=$id;
		$municipios = Municipios::orderBy('v_municipio','ASC')->where('departamento_id','=',$id)->get();
		return response()->json($municipios);
	}


	public function guardardatospersonalesestudiante(ExpedienteEstudianteDatosPersonalesRequest $request)
	{
		//dd($request);
	$estudiante=new Expedienteestudiante($request->all());
	$fechanac = $estudiante->f_fnacimiento;
	$formato = Carbon::createFromFormat('d/m/Y',$fechanac);
	$estudiante->f_fnacimiento = $formato->format('Y/m/d');	
	$fechaingreso = $estudiante->f_fechaIngresoCE;
	if($fechaingreso!=null){
	$format = Carbon::createFromFormat('d/m/Y',$fechaingreso);
	$estudiante->f_fechaIngresoCE = $format->format('Y/m/d');}
	$estudiante->estado='1';
	$sacramentos=implode(',',$request->sacramentos);
	$estudiante->sacramentos=$sacramentos;
	$estudiante->save();
return redirect()->route('registrarcuentadeusuarioestudiante',$estudiante->id);
	} 

	public function registrarcuentausuarioestudiante($id)
	{
		
		$estudiante=Expedienteestudiante::find($id);
		$clave=str_random(8);
		$rol=RolUsuario::orderBy('v_nombrerol')->where('i_estado','=','1')->where('v_nombrerol','Like','estudiante')->pluck('v_nombrerol','id');	
	return view('admin.academica.expedientesestudiantes.registrarusuarioestudiante')->with('estudiante',$estudiante)->with('clave',$clave)->with('rol',$rol);	
	}

public function guardarcuentausuarioestudiante(UsuarioAcademicoRequest $request)
	{
		
//dd($request);
		$idestudiante=$request->id;
		$usuario = new Usuario($request->all());
		$datos = Expedienteestudiante::find($idestudiante);
		$usuario->email = $datos->v_correo;
		$usuario->estudiante_id = $datos->id;
		$usuario->estado = '1';
		$usuario->password = bcrypt($request->password);
		
		if($request->file('txtfoto'))
		{
			$file = $request->file('txtfoto');
			$extension = $file->getClientOriginalExtension();
			$nombre = 'ES_' . time() . '.' . $extension;
			$path = public_path('/imagenes/Administracionacademica/Estudiantes');
			$file->move($path,$nombre);
			$usuario->foto = $nombre;

		}else{
				$usuario->foto = 'nofound.jpg';
			}
		$usuario->save();
		$usuario->usuario_rol()->attach($request->rolusuario_id);
		return redirect()->route('registrardatosmedicosestudiante',$idestudiante);
	}

	public function registrardatosmedicos($idestudiante)
	{		
$idestudiante=$idestudiante;		
return view('admin.academica.expedientesestudiantes.registrardatosmedicosestudiante')->with('idestudiante',$idestudiante);	
	}

	 public function guardardatosmedicosestudiante(ExpedienteEstudianteDatosMedicosRequest $request)
	 {
//guardo las discapacidades seleccionadas en la base de datos
$idestudiante=$request->expedienteestudiante_id;	 	
//$estudianteexp=Expedienteestudiante::find($idestudiante);
/*
foreach($request->nombre as $discapacidad)
{//utilizo foreach xq es un arreglo el que traigo en el request
$estudianteexp->estudiante_discapacidad()->attach($discapacidad);//guardo en la tabla estudiante_discapacidad el id de discapacidad
}*/

$datosmedicosestudiante=new Datosmedicosestudiante($request->all());
//funcion implode sirve para convertir un array en un string, separados por un simbolo determinado en el primer parametro, en este caso es ,
$datosmedicosestudiante->discapacidades=implode(',',$request->discapacidades);
$datosmedicosestudiante->alimentos_consume=implode(',',$request->alimentos_consume);
$datosmedicosestudiante->tiempos_comida=implode(',',$request->tiempos_comida);
$datosmedicosestudiante->save();

return redirect()->route('registrarfamiliares',$idestudiante);
	 }

	public function registrarfamiliares($idestudiante)
	{
		$idestudiante=$idestudiante;
		$exp=Expedienteestudiante::find($idestudiante);
		$familiaresasignados=Expedienteestudiante::with('estudiante_familiares')->whereHas('estudiante_familiares')->where('id','=',$idestudiante)->get();//obtengo la informacion de los familiares que estan relaciondos con ese estudiante en particular
		$familiaresasignados->each(function($familiar){
	$familiar->parentesco;
		});
		//dd($familiaresasignados);
				
		return view('admin.academica.expedientesestudiantes.registrarfamiliaresestudiantes')->with('exp',$exp)->with('familiaresasignados',$familiaresasignados);	
	}

	public function guardarfamiliaresestudiantes(Request $request)
	{
		//dd($request);
		$idestudiante=$request->estudiante_id;
		$estudiante=Expedienteestudiante::find($idestudiante);
		$estudiante->estudiante_familiares()->attach($request->familiar_id,['parentesco'=>$request->parentesco,'encargado'=>$request->encargado,'autorizacion'=>$request->autorizacion]);
		//Flash::success("Familiar asignado exitosamente")->important();
		return redirect()->route('registrarfamiliares',$idestudiante);
	}
	

	public function verexpedienteestudiantes($id)
	{
		$estudiante=Expedienteestudiante::find($id);
		$user=Usuario::where('estudiante_id','=',$id)->get();
		$familiares=Expedienteestudiante::with('estudiante_familiares')->whereHas('estudiante_familiares')->where('id','=',$id)->get();//obtengo la informacion de los familiares que estan relaciondos con ese estudiante en particular
		
$datosmedicos=$estudiante->estudiante_datosmedicos()->first();
$datosmedicos->discapacidades=explode(',',$datosmedicos->discapacidades);
$datosmedicos->alimentos_consume=explode(',',$datosmedicos->alimentos_consume);
$datosmedicos->tiempos_comida=explode(',', $datosmedicos->tiempos_comida);

		$estudiante->sacramentos=explode(',',$estudiante->sacramentos);
		$formato = Carbon::createFromFormat('Y-m-d',$estudiante->f_fnacimiento);
		$edad=Carbon::parse($formato)->age;
		$estudiante->f_fnacimiento = $formato->format('d/m/Y');
 
		
		if($estudiante->f_fechaIngresoCE!=null)
			{
				$formato2 = Carbon::createFromFormat('Y-m-d',$estudiante->f_fechaIngresoCE);
				$estudiante->f_fechaIngresoCE=$formato2->format('d/m/Y');
			}
		
		$muni = Municipios::orderBy('id','ASC')->where('id','=',$estudiante->municipio_id)->first();
		$municipios=$muni->pluck('v_municipio','id'); 
		$dept = Departamentos::orderBy('v_departamento','ASC')->where('id','=',$muni->id)->pluck('v_departamento','id');	

$datos=Expedienteestudiante::with(['estudiante_seccion'=>function($q) {
$q->where('tb_matriculaestudiante.v_estadomatricula','like','aprobada');
}])->where('id',$id)->get();
#dd($datos);

$anios=Periodoactivo::where('tipo_periodo','ACADEMICO')->get();
$datos=array();
foreach ($anios as $key => $value) {
	$query="SELECT  s.anio,s.descripcion,e.v_nombres,e.v_apellidos,cfn.promovido from tb_secciones as s inner join tb_empleado as e  on s.empleado_id=e.id inner join cuadro_final as cf on s.id=cf.seccion_id inner join cuadro_final_notas as cfn on cf.id=cfn.cuadro_final_id and cfn.alumno_id={$id} inner join tb_matriculaestudiante as mt on s.id=mt.seccion_id where mt.anio={$value->anio} and mt.estudiante_id={$id}";

	$historial=DB::select($query);
	if(count($historial)>0)
		{
			//$historial=collect($historial);
			array_push($datos,$historial);
		}

}
//$datos=collect($datos);
//dd($datos);

/*

foreach ($historialacademico as $value) 
{
$datos=Expedienteestudiante::with('estudiante_seccion')->whereHas('estudiante_seccion',function($q) use ($value){
$q->where([['tb_matriculaestudiante.v_estadomatricula','like','aprobada'],['tb_matriculaestudiante.anio',$value->anio]]);
})->where('id',$id)->first();

array_push($datoshistorial, $datos);
}*/

#dd($datos);


$faltas=Faltasestudiantes::orderBy('fecha')->where('estudiante_id',$id)->get();
foreach($faltas as $f)
	    {
 $formato = Carbon::createFromFormat('Y-m-d',$f->fecha);
 $f->fecha = $formato->format('d/m/Y');
 #$f->fecha = $formato->toFormattedDateString();
	    }

//dd($faltas);
return view('admin.academica.expedientesestudiantes.verexpedienteestudiantes')->with('estudiante',$estudiante)->with('edad',$edad)->with('datosmedicos',$datosmedicos)->with('familiares',$familiares)->with('user',$user)->with('municipios',$municipios)->with('dept',$dept)->with('datos',$datos)->with('faltas',$faltas);	
	}

	public function  editardatospersonalesestudiante($id)
	{
		$estudiante=Expedienteestudiante::find($id);
		$user=Usuario::where('estudiante_id','=',$id)->get();	
		$estudiante->sacramentos=explode(',',$estudiante->sacramentos);
		//dd($estudiante->sacramentos);
		$formato = Carbon::createFromFormat('Y-m-d',$estudiante->f_fnacimiento);
		$edad=Carbon::parse($formato)->age;
		$estudiante->f_fnacimiento = $formato->format('d/m/Y');
		if($estudiante->f_fechaIngresoCE!=null){
		$formato2 = Carbon::createFromFormat('Y-m-d',$estudiante->f_fechaIngresoCE);
		$estudiante->f_fechaIngresoCE=$formato2->format('d/m/Y');}	

		$muni = Municipios::orderBy('id','ASC')->where('id','=',$estudiante->municipio_id)->get();
		$municipios=$muni->pluck('v_municipio','id');	 			 
	 	foreach($muni as $muni){			
		$dept = Departamentos::orderBy('v_departamento','ASC')->where('id','=',$muni->id)->first();	
	 	}	
		
		$listamunicipios=Municipios::orderBy('id','ASC')->where('departamento_id','=',$dept->id)->pluck('v_municipio','id');
		
		$departamentos = Departamentos::orderBy('v_departamento','ASC')->pluck('v_departamento','id');
		
		return view('admin.academica.expedientesestudiantes.editardatospersonalesestudiante')->with('estudiante',$estudiante)->with('edad',$edad)->with('user',$user)->with('departamentos',$departamentos)->with('dept',$dept)->with('municipios',$municipios)->with('listamunicipios',$listamunicipios);
	}

	public function  actualizardatospersonalesestudiante(ExpedienteEstudianteDatosPersonalesRequest $request, $id)
	{
		$estudiante=Expedienteestudiante::find($id);
		$estudiante->fill($request->all());
		$f_fnacimiento = $request->f_fnacimiento;
		$formato = Carbon::createFromFormat('d/m/Y',$f_fnacimiento);
		$estudiante->f_fnacimiento = $formato->format('Y-m-d');
		$f_fechaIngresoCE = $request->f_fechaIngresoCE;

		if($f_fechaIngresoCE!=null){
			$formato = Carbon::createFromFormat('d/m/Y',$f_fechaIngresoCE);
			$estudiante->f_fechaIngresoCE = $formato->format('Y-m-d');
		}
		$sacramentos=implode(',',$request->sacramentos);
	    $estudiante->sacramentos=$sacramentos;

		if($request->file('txtfoto')!=null)
		{
			$usuario = Usuario::where('estudiante_id','=',$request->id)->first();
			$file=$request->file('txtfoto');
			$extension=$file->getClientOriginalExtension();
			$nombre = 'ES_' . time() . '.' . $extension;
			$path = public_path('/imagenes/Administracionacademica/Estudiantes');
			$file->move($path,$nombre);
			$usuario->foto = $nombre;	
			$usuario->save();
		}

		if($request->v_correo!=null)
		{
		$usuario = Usuario::where('estudiante_id','=',$request->id)->first();
			$usuario->email=$request->v_correo;
			$usuario->save();
		}

		$estudiante->save();
		$this->bitacora(array(
			"operacion" => "Editar el estudiante con el ".$id,
			"parametro" => $request->all()
		));
		return redirect()->route('editardatosmedicosestudiante',$id);	
	}

		public function editardatosmedicosestudiante($id)
	{	
		$estudiante=Expedienteestudiante::find($id);
		$datosmedicos=$estudiante->estudiante_datosmedicos()->first();

$datosmedicos->discapacidades=explode(',',$datosmedicos->discapacidades);
$datosmedicos->alimentos_consume=explode(',',$datosmedicos->alimentos_consume);
$datosmedicos->tiempos_comida=explode(',', $datosmedicos->tiempos_comida);

//dd($datosmedicos);
return view('admin.academica.expedientesestudiantes.editardatosmedicosestudiante')->with('estudiante',$estudiante)->with('datosmedicos',$datosmedicos);
}


	public function actualizardatosmedicosestudiante(ExpedienteEstudianteDatosMedicosRequest $request, $id)
	{
$estudiante=Expedienteestudiante::find($id);
$datosmedicos=Datosmedicosestudiante::where('expedienteestudiante_id','=',$id)->first();
//dd($request);
$datosmedicos->fill($request->all());

/*foreach($request->nombre as $discapacidad){//utilizo foreach xq es un arreglo el que traigo en el request
		$estudiante->estudiante_discapacidad()->attach($discapacidad);//guardo en la tabla estudiante_discapacidad el id de discapacidad
		}*/

		$datosmedicos->discapacidades=implode(',',$request->discapacidades);
		$datosmedicos->alimentos_consume=implode(',',$request->alimentos_consume);
		$datosmedicos->tiempos_comida=implode(',',$request->tiempos_comida);
	
	$datosmedicos->save();
    return redirect()->route('registrarfamiliares',$id);	
	}
	
	public function eliminarexpedienteestudiante(Request $request)
	{
$id=$request->id;
$estudiante=Expedienteestudiante::find($id);
$estudiante->estado=0;
$formato=Carbon::createFromFormat('d/m/Y',$request->deshabilitadofecha);
$estudiante->deshabilitadofecha=$formato->format('Y-m-d');
$estudiante->deshabilitadomotivo=$request->deshabilitadomotivo;
$estudiante->deshabilitadoobservaciones=$request->deshabilitadoobservaciones;
$estudiante->save();
//desactivo la matricula 
$matricula=Expedienteestudiante::with('estudiante_seccion')->whereHas('estudiante_seccion', function($query){
$query->where('tb_matriculaestudiante.estado','=','1');
})->where('id',$id)->first();
//dd($matricula);
if(count($matricula)>0)//tiene matricula
{
//desactivar matricula de estudiante y ponerle retirada y en estado 0
	foreach ($matricula->estudiante_seccion as $key => $value) {
	$idrow=$value->pivot->id;	
	}
Expedienteestudiante::find($id)->estudiante_seccion()->updateExistingPivot($idrow, ['v_estadomatricula'=>'retirada','estado'=>'0']);

}

$usuario =  Usuario::where('estudiante_id','=',$id)->first();
$usuario->estado = 0;
$usuario->save();

Flash::success('El estudiante'.$estudiante->v_nombres.' '. $estudiante->v_apellidos.' a sido deshabilitado exitosamente')->important();
	return redirect()->route('listaexpedientes');
	}

public function listadofamiliares()
{

	$familiares=Familiares::orderBy('id','ASC')->where('estado','=','1')->get();
	$familiares->each(function($familiar){
	$familiar->parentesco;
		});
	return response()->json($familiares);
}


	public function eliminarrelacionfamiliarestudiante(Request $request,$id)
	{
	
		$estudiante=Expedienteestudiante::find($request->idestu);
		$estudiante->estudiante_familiares()->detach($request->id);
		 return redirect()->route('registrarfamiliares',$request->idestu);
	}	

}
