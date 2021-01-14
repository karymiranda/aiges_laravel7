<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Usuario;

class RolesSesion extends Model
{
    public static function sesionRoles()
    {
    	$roles=[false,false,false,false,false,false,false,false];//represnta los 7 tipos de roles que existe en el sistema [0]=superusuario,[1]=administrador bono escolar, [2] admin activo fijo, [3] admin academico, [4] docente, [5] estudiante, [6] padre de familia, [7] admin recurso humano
    	$log;//variable para guardar el dato del usuario logeado
    	$usuario;
    	if (Auth::user()->personal_id!=null)
    	{
    		$log=Auth::user()->empleado;//SI ES EPMPLEADO
    		$usuario=Usuario::find($log->usuarios->first()->id);
    	} 
    	 else
    	{
    		if (Auth::user()->estudiante_id!=null)
    	   {
    		$log=Auth::user()->estudiante;//SI ES ESTUDIANTE
    		$usuario=Usuario::find($log->estudiante_usuario->first()->id);
    	    } 
    	   else
    	    {
            $log=Auth::user()->familiar;//SI ES FAMILIAR
            $usuario=Usuario::find($log->familiar_usuario->first()->id);
    	     }
    	}

    	
    	foreach ($usuario->usuario_rol as $rol) //saco los roles que pertenecen  a ese usuario
    	{
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
    	}//fin de switch
    	}//fin de foreach
    	return $roles;
    }
}
