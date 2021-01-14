<?php

namespace App\Http\Controllers;
use App\Http\Requests\DatosPersonalesFamiliaresRequest;
use App\Http\Requests\UsuarioAcademicoRequest;
use App\Familiares;
use App\Usuario;
use App\RolUsuario;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Laracasts\Flash\Flash;
use Carbon\Carbon;


class GestionpadresdefamiliaController extends Controller
{
    public function index()
	{
		$listapadres=Familiares::orderBy('expediente','ASC')->where('estado','=','1')->get();
		return view('admin.academica.padresdefamilia.gestionarpadresdefamilia')->with('listapadres',$listapadres);	
	}
	public function agregarfamiliar()
	{
		//$listaparentesco=Parentesco::orderBy('parentesco','ASC')->pluck('parentesco','id');
		$contador=Familiares::count();
		$fecha = Carbon::create();
		if($contador!=0)//la base no esta vacia
		{
			$contExp=Familiares::all();
			$correlativo=$contExp->Last()->id+1;
		}else{
			$correlativo=1;//si la base esta vacia el correlativo del numero expediente sera 1
		}
		$expediente = 'PF' . '' . $fecha->year . '-' . $correlativo;
		return view('admin.academica.padresdefamilia.agregarpadredefamilia')->with('expediente',$expediente);	
	}
	public function guardarfamiliar(DatosPersonalesFamiliaresRequest $request)
	{

$familiar=new Familiares($request->all());
if($familiar->fechanacimiento!=null)
{
		$fecha = $familiar->fechanacimiento;		
		$formato = Carbon::createFromFormat('d/m/Y',$fecha);
		$familiar->fechanacimiento = $formato->format('Y/m/d');
	}
		$familiar->estado='1';
		$familiar->save();
		Flash::success("El familiar " . $familiar->nombres .' '. $familiar->apellidos . " ha sido creado exitosamente")->important();
		return redirect()->route('agregarusuariofamiliar',$familiar->id);
		
	}

	public function agregarusuariofamiliar($id)
	{
		$familiar=Familiares::find($id);
		$clave=str_random(8);
		$rol=RolUsuario::orderBy('v_nombrerol')->where('i_estado','=','1')->where('v_nombrerol','Like','Padre de familia')->pluck('v_nombrerol','id');
		
		return view('admin.academica.padresdefamilia.agregarusuariofamiliar')->with('familiar',$familiar)->with('clave',$clave)->with('rol',$rol);	
	}
	
	public function guardarusuariofamiliar(UsuarioAcademicoRequest $request)
	{

		$idfamiliar=$request->id;
		$usuario = new Usuario($request->all());

		$datos = Familiares::find($idfamiliar);
		$usuario->email = $datos->correo;
		$usuario->estado='1';
		$usuario->familiar_id = $idfamiliar;
		$usuario->password = bcrypt($request->password);
		if($request->file('txtfoto'))
		{
			$file = $request->file('txtfoto');
			$extension = $file->getClientOriginalExtension();
			$nombre = 'PF_' . time() . '.' . $extension;
			$path = public_path('/imagenes/Administracionacademica/Padresdefamilia');
			$file->move($path,$nombre);
			$usuario->foto = $nombre;
			//dd($request);
		}else{
				$usuario->foto = 'nofound.jpg';
			}
			
		$usuario->save();
		$usuario->usuario_rol()->attach($request->rolusuario_id);//en la muchos a muchos le indico que roles de usuario tiene el usuario
		
		Flash::success("La cuenta de usuario de " . $datos->nombres ." ". $datos->apellidos . " ha sido creado exitosamente")->important();
		return redirect()->route('listafamiliares');
	}

	public function editarpadredefamilia($id)
	{
		$familiar=Familiares::find($id);
		$user=Usuario::where('familiar_id','=',$id)->get();
	
		if($familiar->fechanacimiento!=null)
		{
		$formato = Carbon::createFromFormat('Y-m-d',$familiar->fechanacimiento);
		$edad=Carbon::parse($formato)->age;
		$familiar->fechanacimiento = $formato->format('d/m/Y');
			}
			else{$edad=null;}

		return view('admin.academica.padresdefamilia.editarpadresdefamilia')->with('familiar',$familiar)->with('edad',$edad)->with('user',$user);		
	}

	public function actualizarpadredefamilia(DatosPersonalesFamiliaresRequest $request, $id)
	{
		
		$familiar=Familiares::find($id);
		$familiar->fill($request->all());
		if($familiar->fechanacimiento!=null)
		{
		$fechanacimiento = $request->fechanacimiento;
		$formato = Carbon::createFromFormat('d/m/Y',$fechanacimiento);
		$familiar->fechanacimiento = $formato->format('Y/m/d');
	    }
		if($request->file('txtfoto')!=null)//si ha modificado la fotografia 
		{
			$usuario = Usuario::where('familiar_id','=',$request->id)->first();
			$file=$request->file('txtfoto');
			$extension=$file->getClientOriginalExtension();
			$nombre= 'PF_' . time() .'.'.$extension;
			$path= public_path('/imagenes/Administracionacademica/Padresdefamilia');
			$file->move($path,$nombre);
			$usuario->foto=$nombre;		
			$usuario->save();
		}
		$familiar->save();
		Flash::success("El expediente del familiar " . $familiar->nombres . $familiar->apellidos . " ha sido actualizado exitosamente")->important();
		return redirect()->route('listafamiliares');	
	}

	public function verpadredefamilia($id)
	{ 
		$familiar=Familiares::find($id);
		$user=Usuario::where('familiar_id','=',$id)->get();
	
		if($familiar->fechanacimiento!=null)
		{
		$formato = Carbon::createFromFormat('Y-m-d',$familiar->fechanacimiento);
		$edad=Carbon::parse($formato)->age;
		$familiar->fechanacimiento = $formato->format('d/m/Y');
	    }
	else {$edad=null;}
		return view('admin.academica.padresdefamilia.verpadredefamilia')->with('familiar',$familiar)->with('edad',$edad)->with('user',$user);	
	}
	
	public function eliminarpadredefamilia($id)
	{		
$familiar=Familiares::find($id);
$familiar->estado=0;
$familiar->save();
$usuario = Usuario::where('familiar_id','=',$familiar->id)->first();
$usuario->estado=0;
$usuario->save();
Flash::error('El familiar '.$familiar->nombres.' '. $familiar->apellidos.' a sido deshabilitado exitosamente')->important();
	return redirect()->route('listafamiliares');
		
	}

	public function gestiondepadresdefamiliainactivos()
	{
	$listapadres=Familiares::orderBy('expediente','ASC')->where('estado','=','0')->get();
		//$listapadres->each(function($listapadres){$listapadres->parentesco;});//SACO EL NOMBRE DEL parentesco
		return view('admin.academica.padresdefamilia.gestionpadresdefamiliainactivos')->with('listapadres',$listapadres);	
	}

	public function activarexpedientesinactivos($id)
	{
$familiar=Familiares::find($id);
$familiar->estado=1;
$familiar->save();
$usuario = Usuario::where('familiar_id','=',$familiar->id)->first();
$usuario->estado=1;
$usuario->save();
Flash::success('El familiar '.$familiar->nombres.' '. $familiar->apellidos.' a sido habilitado exitosamente')->important();
		return redirect()->route('listafamiliaresinactivos');
	}
}
