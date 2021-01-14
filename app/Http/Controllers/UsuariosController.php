<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Usuario;
use App\RolUsuario;
use Illuminate\Http\UploadedFile;
use Laracasts\Flash\Flash;
use Carbon\Carbon;
use App\Http\Requests\UsuarioRHRequest;
use App\Empleado;
use App\Expedienteestudiante;
use App\Familiares;
use Illuminate\Support\Facades\Auth;
use App\RolesSesion;
use App\Http\Requests\CuentaUsuarioRequest;
use Validator;

class UsuariosController extends Controller
{
    public function index()
	{
		$usuarios=Usuario::orderBy('id','ASC')->where('estado','=','1')->get();
		$usuarios->each(function($usuarios){ 
			$usuarios->usuario_rol;
			$usuarios->familiar; 
			$usuarios->empleado;
			$usuarios->estudiante; 
		});

		return view('admin.seguridad.listausuariosactivos')->with('usuarios',$usuarios);	
	}

	public function verusuario($id)
	{
		$roles=$this->usuario_roles($id);
	    $usuario=Usuario::find($id);	
	    $usuario->each(function($usuario){ 
			$usuario->familiar; 
			$usuario->empleado;
			$usuario->estudiante; 
		});	    
	    
	    return view('admin.seguridad.verusuario')->with('roles',$roles)->with('usuario',$usuario);
	}

	public function editarusuario($id)
	{
		$roles=$this->usuario_roles($id);
	    $usuario=Usuario::find($id);	
	    $usuario->each(function($usuario){ 
			$usuario->familiar; 
			$usuario->empleado;
			$usuario->estudiante; 
		});
	    
	    return view('admin.seguridad.editarusuario')->with('roles',$roles)->with('usuario',$usuario);
	}

	public function actualizarusuario(UsuarioRHRequest $Request, $id)
	{
		$usuario = Usuario::where('id','=',$Request->id_usuario)->first();
		if($Request->password!=''){
			$usuario->password = bcrypt($Request->password);
		}
		
		$usuario->save();
		$usuario->usuario_rol()->sync($Request->nivel);
		Flash::success("La cuenta del usuario " . $Request->usuario . " ha sido actualizado")->important();
		return redirect()->route('listausuariosactivos');	
	}

	public function eliminarusuario($id)
	{
		$usuario = Usuario::find($id);
		$usuario->estado = 0;
		$usuario->save();
		$nombre;
		if ($usuario->empleado!=null) {
			$empleado = Empleado::find($usuario->personal_id);
			$empleado->estado = 0;
			$empleado->save();
			$nombre = $empleado->v_nombres . ' ' . $empleado->v_apellidos;
		}
		if ($usuario->estudiante!=null) {
			$estudiante = Expedienteestudiante::find($usuario->estudiante_id);
			$estudiante->estado = 0;
			$estudiante->save();
			$nombre = $estudiante->v_nombres . ' ' . $estudiante->v_apellidos;
		}
		if ($usuario->familiar!=null) {
			$familiar = Familiares::find($usuario->familiar_id);
			$familiar->estado = 0;
			$familiar->save();
			$nombre = $familiar->nombres . ' ' . $familiar->apellidos;
		}
		
		Flash::error("La cuenta del usuario " . $nombre . " ha sido deshabilitada")->important();
		return redirect()->route('listausuariosactivos');	
	}

	protected function usuario_roles($id)
	{
		$roles=[false,false,false,false,false,false,false,false];
	    $usuario=Usuario::find($id);	
	    $usuario->each(function($usuario){ 
			$usuario->usuario_rol; 
		});	    
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
	    		case '6':
	    			$roles[5]=true;
	    			break;
	    		case '7':
	    			$roles[6]=true;
	    			break;
	    		case '8':
	    			$roles[7]=true;
	    			break;
	    		default:
	    			break;
	    	}
	    }
	    return $roles;
	}

	public function editarcuenta()
	{
		$roles=RolesSesion::sesionRoles();
	    
	    return view('admin.seguridad.editarcuenta')->with('roles',$roles);
	}

	public function actualizarcuenta(CuentaUsuarioRequest $request)
	{
		$usuario = Usuario::where('id','=',$request->id_usuario)->first();
		
		if (\Hash::check($request->oldpassword, $usuario->password))
		{
			if($request->newpassword!=''){
				$usuario->password = bcrypt($request->newpassword);
			}
			$prefijo;
			$ruta;
			if($usuario->empleado!=null){
				$prefijo='RH_';
				$ruta='/imagenes/Recursohumano';
			}else{
				if($usuario->estudiante!=null){
					$prefijo='ES_';
					$ruta='/imagenes/Administracionacademica/Estudiantes';
				}else{
					$prefijo='PF_';
					$ruta='/imagenes/Administracionacademica/Padresdefamilia';
				}
			}
			if($request->file('txtfoto')!=null)
			{
				$file = $request->file('txtfoto');
				$extension = $file->getClientOriginalExtension();
				$nombre = $prefijo . time() . '.' . $extension;
				$path = public_path($ruta);
				$file->move($path,$nombre);
				$usuario->foto = $nombre;
			}
			$usuario->save();
			Flash::success("La cuenta de usuario ha sido actualizada")->important();
			return redirect()->route('editarcuenta');
		}else{
			Flash::warning("La contraseña anterior es incorrecta")->important();
			return redirect()->route('editarcuenta');
		}		
	}

	public function passwordchange($id)
	{
		$usuario=Usuario::find($id); 
		return view('admin.seguridad.passwordchange',compact('usuario'));
	}

	 public function myaccountchangepassword(Request $request)
	{
		//dd($request);
		$id=$request->id_usuario;
		$usuario=Usuario::find($id);
		if(\Hash::check($request->oldpassword,$usuario->password))//la clave anterior debe coincidir con la guardada en la base.
		{		
		//create the validation rules ------------------------
		 $rules = [
		 'newpassword' => 'required| min:8| max:25|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/', 
		 'password_confirm' => 'same:newpassword'

				]; // required and has to match the password field ); // do the validation  // validate against the inputs from our form 
		 $messages= [
	'newpassword.min' => 'Su nueva contraseña debe tener por lo menos :min caracteres.',
    'newpassword.max' => 'Su nueva contraseña debe tener máximo :max caracteres.',
    'newpassword.regex' => 'Su nueva contraseña debe contener más de 8 caracteres, por lo menos una letra mayúscula, una letra minúscula, un número y un caracter especial.',
    'password_confirm.same' => 'La verificación de la nueva contraseña falló. Contraseña no coincide.'
 		 ];

		 $validator = Validator::make($request->all(), $rules,$messages); // check if the validator failed 
		 if ($validator->fails()) { // get the error messages from the validator 
		 $messages = $validator->messages(); // redirect our user back to the form with the errors from the validator 
		 return redirect()->route('passwordchange',$id)->withErrors($validator);
								   
		} //fin if validatror
		else{
		$usuario->password = bcrypt($request->newpassword);
		$usuario->save();
		Flash::success("Su contraseña ha sido cambiada. Cerrar sesión en todos los dispositivos para ingresar con la nueva clave.")->important();
		 return redirect()->route('passwordchange',$id);
		//dd('contraseña cambiada con exito');	
		}
	}
else{
Flash::error("No se pudo verificar su identidad, la contraseña actual es incorrecta. Inténtelo nuevamente.")->important();
 return redirect()->route('passwordchange',$id);
} //fin else , clave antigua no coincide


	}
}
