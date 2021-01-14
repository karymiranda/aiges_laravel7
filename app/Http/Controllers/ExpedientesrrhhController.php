<?php

namespace App\Http\Controllers;
use App\Http\Requests\UsuarioRHRequest;
use App\Http\Requests\EmpleadoRequest;
use App\Http\Requests\CargoRequest;
use App\Http\Requests\EspecialidadRequest;
use App\Http\Requests\TipoPersonalRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;

use App\TipoPersonal;
use App\Cargo;
use App\Especialidad;
use App\Empleado;
use App\RolUsuario;
use Carbon\Carbon;
use App\Usuario;
use Laracasts\Flash\Flash;

class ExpedientesrrhhController extends Controller
{
	
	public function index()
	{
		$empleados = Empleado::orderBy('id','ASC')->where('estado','=','1')->get();
		$empleados->each(function($empleados){ 
			$empleados->cargo;
			$empleados->tipoPersonal; 
		});
		
		return view('admin.recursohumano.expedientes.listaexpedientesrrhh')->with('empleados',$empleados);	
	}

	public function listadodesactivado()
	{
		$empleados = Empleado::orderBy('id','ASC')->where('estado','=','0')->get();
		$empleados->each(function($empleados){ 
			$empleados->cargo;
			$empleados->tipoPersonal; 
		});
		return view('admin.recursohumano.expedientes.listaexpedientesdesactivadosrrhh')->with('empleados',$empleados);		
	}

    public function crearexpedienterh()
	{
		$contC = Cargo::count()+1;
		$contT = TipoPersonal::count()+1;
		$contE = Especialidad::count()+1;
		if($contC!=0){
			$cargosCodigo = Cargo::all();
			$codigoC = $cargosCodigo->Last()->id+1;
		}else{
			$codigoC = 1;
		}
		if($contE!=0){
			$especialidadesCodigo = Especialidad::all();
			$codigoE = $especialidadesCodigo->Last()->id+1;
		}else{
			$codigoE = 1;
		}
		if($contT!=0){
			$tipoCodigo = TipoPersonal::all();
			$codigoT = $tipoCodigo->Last()->id+1;
		}else{
			$codigoT = 1;
		}
		$tiposPersonal = TipoPersonal::orderBy('v_tipopersonal','ASC')->where('estado','=','1')->pluck('v_tipopersonal','id');
		$cargos = Cargo::orderBy('v_descripcion','ASC')->where('estado','=','1')->pluck('v_descripcion','id');
		$especialidades = Especialidad::orderBy('v_especialidad','ASC')->where('estado','=','1')->pluck('v_especialidad','id');
		//$numeroEmpleados = Empleado::count()+1;
		$numeroEmpleados=Empleado::max('id')+1;
		//dd($numeroEmpleados);
		$fecha = Carbon::create();
		$expediente = 'RH' . '' . $fecha->year . '-' . $numeroEmpleados;
		
		return view('admin.recursohumano.expedientes.crearexpedientesrrhh')->with('tiposPersonal',$tiposPersonal)->with('cargos',$cargos)->with('especialidades',$especialidades)->with('expediente',$expediente)->with('codigoC',$codigoC)->with('codigoE',$codigoE)->with('codigoT',$codigoT);	
	}

	public function crearusuariorh($id)
	{
		$contraseña = str_random(8);
		$empleado = Empleado::find($id);
		
		return view('admin.recursohumano.expedientes.crearcuentausuariorrhh')->with('contraseña',$contraseña)->with('empleado',$empleado);	
	}

	public function agregarexpedienterh(EmpleadoRequest $Request)
	{
		//dd($Request);
		$empleado = new Empleado($Request->all());
		$fechanac = $empleado->f_fechanaci;
		$formato = Carbon::createFromFormat('d/m/Y',$fechanac);
		$empleado->f_fechanaci = $formato->format('Y/m/d');

		if($empleado->f_fechaingresoalCE!=null)
		{
			$formato2 = Carbon::createFromFormat('d/m/Y',$empleado->f_fechaingresoalCE);
			$empleado->f_fechaingresoalCE = $formato2->format('Y/m/d');
		}
		if($empleado->f_fechaingresoministerio!=null)
		{
			$formato3 = Carbon::createFromFormat('d/m/Y',$empleado->f_fechaingresoministerio);
			$empleado->f_fechaingresoministerio = $formato3->format('Y/m/d');
		}
		$empleado->save();		
		Flash::success("El empleado " . $empleado->v_nombres . " " . $empleado->v_apellidos . " ha sido guardado")->important();
		$id = $empleado->id;
		return redirect()->route('crearusuariorh',$id);
	}

	public function agregarusuariorh(UsuarioRHRequest $Request)
	{
	
		$usuario = new Usuario($Request->all());
		$datos = Empleado::find($Request->id);
		$usuario->email = $datos->v_correo;
		$usuario->personal_id = $datos->id;
		$usuario->estado=1;
		$usuario->password = bcrypt($Request->password);
		if($Request->file('txtfoto'))
		{
			$file = $Request->file('txtfoto');
			$extension = $file->getClientOriginalExtension();
			$nombre = 'RH_' . time() . '.' . $extension;
			$path = public_path('/imagenes/Recursohumano');
			$file->move($path,$nombre);
			$usuario->foto = $nombre;
		}else{
				$usuario->foto = 'nofound.jpg';
			}
		$usuario->save();
		foreach ($Request->nivel as $val) {
			$usuario->usuario_rol()->attach($val);
		}
		
		Flash::success("El usuario " . $usuario->name . " ha sido guardado")->important();
		//return redirect()->route('listaexpedientesrh');
		return redirect()->route('estudiosycapacitacionesrrhh',$datos->id);		
	}

	public function verexpedienterh($id)
	{
		$tiposPersonal = TipoPersonal::orderBy('v_tipopersonal','ASC')->where('estado','=','1')->pluck('v_tipopersonal','id');
		$cargos = Cargo::orderBy('v_descripcion','ASC')->where('estado','=','1')->pluck('v_descripcion','id');
		$especialidades = Especialidad::orderBy('v_especialidad','ASC')->where('estado','=','1')->pluck('v_especialidad','id');
		$empleado = Empleado::find($id);
		$genero=$empleado->v_genero;
		$formato = Carbon::createFromFormat('Y-m-d',$empleado->f_fechanaci);
		$empleado->f_fechanaci = $formato->format('d/m/Y');
		if($empleado->f_fechaingresoalCE!=null)
		{
			$formato2 = Carbon::createFromFormat('Y-m-d',$empleado->f_fechaingresoalCE);
			$empleado->f_fechaingresoalCE = $formato2->format('d/m/Y');
		}
		if($empleado->f_fechaingresoministerio!=null)
		{
			$formato3 = Carbon::createFromFormat('Y-m-d',$empleado->f_fechaingresoministerio);
			$empleado->f_fechaingresoministerio = $formato3->format('d/m/Y');
		}
		$edad = Carbon::parse($formato)->age;
		
		$empleado->each(function($empleado){ 
			$empleado->cargo;
			$empleado->especialidad;
			$empleado->tipoPersonal;
			$empleado->usuarios;
			$empleado->permisos;
		}); 

		foreach($empleado->permisos as $permiso)
	    {
		    $formato = Carbon::createFromFormat('Y-m-d',$permiso->f_fechasolicitud);
		    $permiso->f_fechasolicitud = $formato->format('d/m/Y');
		    $formato = Carbon::createFromFormat('Y-m-d',$permiso->f_desde);
		    $permiso->f_desde = $formato->format('d/m/Y');
		    $formato = Carbon::createFromFormat('Y-m-d',$permiso->f_hasta);
		    $permiso->f_hasta = $formato->format('d/m/Y');
	    }

	    
	    $roles=[false,false,false,false,false,false];
	    if ($empleado->usuarios->first()!=null) {
	    	$usuario=Usuario::find($empleado->usuarios->first()->id);		    
		    foreach ($usuario->usuario_rol as $rol) {
		    	switch ($rol->id) {
		    		case '1':
		    			$roles[0]=true;
		    			break;
		    		case '2':
		    			$roles[1]=true;
		    			break;
	    			case '3':
		    			$roles[2]=true;
		    			break;
	    			case '4':
		    			$roles[3]=true;
		    			break;
	    			case '5':
		    			$roles[4]=true;
		    			break;
		    		case '8':
		    			$roles[5]=true;
		    			break;
		    		default:
		    			break;
		    	}
		    }
	    }
	    
	    return view('admin.recursohumano.expedientes.verexpedienterrhh')->with('roles',$roles)->with('edad',$edad)->with('genero',$genero)->with('empleado',$empleado)->with('tiposPersonal',$tiposPersonal)->with('cargos',$cargos)->with('especialidades',$especialidades);
	}

	public function verexpedientedesactivadorh($id)
	{
		$tiposPersonal = TipoPersonal::orderBy('v_tipopersonal','ASC')->where('estado','=','1')->pluck('v_tipopersonal','id');
		$cargos = Cargo::orderBy('v_descripcion','ASC')->where('estado','=','1')->pluck('v_descripcion','id');
		$especialidades = Especialidad::orderBy('v_especialidad','ASC')->where('estado','=','1')->pluck('v_especialidad','id');
		
		$empleado = Empleado::find($id);
		$genero=$empleado->v_genero;
		$formato = Carbon::createFromFormat('Y-m-d',$empleado->f_fechanaci);
		$empleado->f_fechanaci = $formato->format('d/m/Y');
		if($empleado->f_fechaingresoalCE!=null)
		{
			$formato2 = Carbon::createFromFormat('Y-m-d',$empleado->f_fechaingresoalCE);
			$empleado->f_fechaingresoalCE = $formato2->format('d/m/Y');
		}
		if($empleado->f_fechaingresoministerio!=null)
		{
			$formato3 = Carbon::createFromFormat('Y-m-d',$empleado->f_fechaingresoministerio);
			$empleado->f_fechaingresoministerio = $formato3->format('d/m/Y');
		}
		$edad = Carbon::parse($formato)->age;
		
		$empleado->each(function($empleado){ 
			$empleado->cargo;
			$empleado->especialidad;
			$empleado->tipoPersonal;
			$empleado->usuarios;
			$empleado->permisos;
		});
		foreach($empleado->permisos as $permiso)
	    {
		    $formato = Carbon::createFromFormat('Y-m-d',$permiso->f_fechasolicitud);
		    $permiso->f_fechasolicitud = $formato->format('d/m/Y');
		    $formato = Carbon::createFromFormat('Y-m-d',$permiso->f_desde);
		    $permiso->f_desde = $formato->format('d/m/Y');
		    $formato = Carbon::createFromFormat('Y-m-d',$permiso->f_hasta);
		    $permiso->f_hasta = $formato->format('d/m/Y');
	    }
	    $roles=[false,false,false,false,false,false];
	    if ($empleado->usuarios->first()!=null) {
	    	$usuario=Usuario::find($empleado->usuarios->first()->id);		    
		    foreach ($usuario->usuario_rol as $rol) {
		    	switch ($rol->id) {
		    		case '1':
		    			$roles[0]=true;
		    			break;
		    		case '2':
		    			$roles[1]=true;
		    			break;
	    			case '3':
		    			$roles[2]=true;
		    			break;
	    			case '4':
		    			$roles[3]=true;
		    			break;
	    			case '5':
		    			$roles[4]=true;
		    			break;
		    		case '8':
		    			$roles[5]=true;
		    			break;
		    		default:
		    			break;
		    	}
		    }
	    }
		return view('admin.recursohumano.expedientes.verexpedientedesactivadorrhh')->with('edad',$edad)->with('roles',$roles)->with('genero',$genero)->with('empleado',$empleado)->with('tiposPersonal',$tiposPersonal)->with('cargos',$cargos)->with('especialidades',$especialidades);
	}

	public function editarexpedienterh($id)
	{
	$user=Usuario::where('personal_id','=',$id)->first();
		$tiposPersonal = TipoPersonal::orderBy('v_tipopersonal','ASC')->where('estado','=','1')->pluck('v_tipopersonal','id');
		$cargos = Cargo::orderBy('v_descripcion','ASC')->where('estado','=','1')->pluck('v_descripcion','id');
		$especialidades = Especialidad::orderBy('v_especialidad','ASC')->where('estado','=','1')->pluck('v_especialidad','id');
		$empleado = Empleado::find($id);
		$genero=$empleado->v_genero;
		$formato = Carbon::createFromFormat('Y-m-d',$empleado->f_fechanaci);
		$empleado->f_fechanaci = $formato->format('d/m/Y');
		if($empleado->f_fechaingresoalCE!=null)
		{
			$formato2 = Carbon::createFromFormat('Y-m-d',$empleado->f_fechaingresoalCE);
			$empleado->f_fechaingresoalCE = $formato2->format('d/m/Y');
		}
		if($empleado->f_fechaingresoministerio!=null)
		{
			$formato3 = Carbon::createFromFormat('Y-m-d',$empleado->f_fechaingresoministerio);
			$empleado->f_fechaingresoministerio = $formato3->format('d/m/Y');
		}
		$edad = Carbon::parse($formato)->age;
		
		$empleado->each(function($empleado){ 
			$empleado->cargo;
			$empleado->especialidad;
			$empleado->tipoPersonal;			
		});
		
		return view('admin.recursohumano.expedientes.editarexpedienterrhh')->with('edad',$edad)->with('genero',$genero)->with('empleado',$empleado)->with('tiposPersonal',$tiposPersonal)->with('cargos',$cargos)->with('user',$user)->with('especialidades',$especialidades);	
	}

	public function actualizarexpedienterh(EmpleadoRequest $request, $id)
	{
		$empleado = Empleado::find($id);
		$empleado->fill($request->all());	
		$fechanac = $request->f_fechanaci;
		$formato = Carbon::createFromFormat('d/m/Y',$fechanac);
		$empleado->f_fechanaci = $formato->format('Y/m/d');

		if($request->f_fechaingresoalCE!=null)
		{
			$formato2 = Carbon::createFromFormat('d/m/Y',$request->f_fechaingresoalCE);
			$empleado->f_fechaingresoalCE = $formato2->format('Y/m/d');
		}
		if($request->f_fechaingresoministerio!=null)
		{
			$formato3 = Carbon::createFromFormat('d/m/Y',$request->f_fechaingresoministerio);
			$empleado->f_fechaingresoministerio = $formato3->format('Y/m/d');
		}
		if($request->file('txtfoto')!=null)//si ha modificado la fotografia 
		{
			$usuario = Usuario::where('personal_id','=',$request->id)->first();
			$file=$request->file('txtfoto');
			$extension=$file->getClientOriginalExtension();
			$nombre= 'PF_' . time() .'.'.$extension;
			$path= public_path('/imagenes/Recursohumano');
			$file->move($path,$nombre);
			$usuario->foto=$nombre;		
			$usuario->save();
		}
		$empleado->save();
		Flash::success("El empleado " . $empleado->v_nombres . " " . $empleado->v_apellidos . " ha sido actualizado")->important();
		return redirect()->route('listaexpedientesrh');	
		//return redirect()->route('editarusuariorh',$id);	
	}

	public function editarusuariorh($id)
	{
		$empleado = Empleado::find($id);
		$empleado->each(function($empleado){ 
			$empleado->usuarios;
		});
		$roles=[false,false,false,false,false,false];
	    if ($empleado->usuarios->first()!=null) {
	    	$usuario=Usuario::find($empleado->usuarios->first()->id);		    
		    foreach ($usuario->usuario_rol as $rol) {
		    	switch ($rol->id) {
		    		case '1':
		    			$roles[0]=true;
		    			break;
		    		case '2':
		    			$roles[1]=true;
		    			break;
	    			case '3':
		    			$roles[2]=true;
		    			break;
	    			case '4':
		    			$roles[3]=true;
		    			break;
	    			case '5':
		    			$roles[4]=true;
		    			break;
		    		case '8':
		    			$roles[5]=true;
		    			break;
		    		default:
		    			break;
		    	}
		    }
	    }
	   	if($empleado->usuarios->first()!=null){
		return view('admin.recursohumano.expedientes.editarcuentausuariorrhh')->with('roles',$roles)->with('empleado',$empleado)->with('user',$usuario);
		}else{
			return redirect()->route('crearusuariorh',$id);
		}
	}

	public function actualizarusuariorh(UsuarioRHRequest $Request, $id)
	{
		$usuario = Usuario::where('personal_id','=',$id)->first();
		$datos = Empleado::find($Request->id);
		$usuario->email = $datos->v_correo;
		if($Request->password!=''){
			$usuario->password = bcrypt($Request->password);
		}
		
		if($Request->file('txtfoto')!=null)
		{
			$file = $Request->file('txtfoto');
			$extension = $file->getClientOriginalExtension();
			$nombre = 'RH_' . time() . '.' . $extension;
			$path = public_path('/imagenes/Recursohumano');
			$file->move($path,$nombre);
			$usuario->foto = $nombre;
		}
		
		$usuario->save();
		$usuario->usuario_rol()->sync($Request->nivel);
		Flash::success("El usuario " . $usuario->name . " ha sido actualizado")->important();
		return redirect()->route('listaexpedientesrh');	
	}

	public function eliminarexpedienterh($id)
	{
		$empleado = Empleado::find($id);
		$empleado->estado = 0;
		$empleado->save();
		$usuario = Usuario::where('personal_id','=',$empleado->id)->first();
		$usuario->estado = 0;
		$usuario->save();
		Flash::error("El expediente del empleado " . $empleado->v_nombres . " " . $empleado->v_apellidos . " ha sido eliminado")->important();
		return redirect()->route('listaexpedientesrh');	
	}

	public function activarexpedienterh($id)
	{
		$empleado = Empleado::find($id);
		$empleado->estado = 1;
		$empleado->save();
		$usuario = Usuario::where('personal_id','=',$empleado->id)->first();
		$usuario->estado = 1;
		$usuario->save();
		Flash::success("El expediente del empleado " . $empleado->v_nombres . " " . $empleado->v_apellidos . " ha sido activado")->important();
		return redirect()->route('listaexpedientesdesactivadosrh');
	}

	public function cargo(CargoRequest $Request)
	{
		$cargo = new Cargo($Request->all());
		$cargo->save();
		Flash::success("El cargo " . $cargo->v_descripcion . " ha sido guardado")->important();
		return redirect()->route('crearexpedientesrh');		
	}

	public function espe(EspecialidadRequest $Request)
	{
		$especialidad = new Especialidad($Request->all());
		$especialidad->save();
		Flash::success("La especialidad " . $especialidad->v_especialidad . " ha sido guardada")->important();
		return redirect()->route('crearexpedientesrh');		
	}

	public function tipo(TipoPersonalRequest $Request)
	{
		$tipo = new TipoPersonal($Request->all());
		$tipo->save();
		Flash::success("El tipo de personal " . $tipo->v_tipopersonal . " ha sido guardado")->important();
		return redirect()->route('crearexpedientesrh');		
	}

	public function  horariodeclases_docente($id)
	{
dd('horarioc docente');
	}

	public function historialasistencia_docente(Request $request)
	{
		dd('asistencia docente');
	}



}
