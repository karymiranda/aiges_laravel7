<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\PermisoRequest;
use App\MotivoPermiso;
use App\TipoPermiso;
use App\Empleado;
use App\Permiso;
use Carbon\Carbon;
use Laracasts\Flash\Flash;

class SolicitudespermisosrhController extends Controller
{
    public function index()
	{
    $hoy = Carbon::now();
    $hoy = $hoy->year;
    $permisos=Permiso::orderBy('f_fechasolicitud','ASC')->whereYear('f_fechasolicitud','=',$hoy)->whereHas('empleado', function($q)
    {
      $q->where('estado', '=', '1'); 
    })->with('empleado')->with('motivoPermiso')->where('estado','!=','Denegada')->get();
    foreach($permisos as $permiso)
    {
    $formato = Carbon::createFromFormat('Y-m-d',$permiso->f_fechasolicitud);
    $permiso->f_fechasolicitud = $formato->format('d/m/Y');
    }

$asesor = Empleado::select(DB::raw('CONCAT(v_nombres," ",v_apellidos) as nombrecompleto'),'id')->orderBy('v_numeroexp','ASC')->where([['estado','=','1'],['v_numeroexp','!=','RH0000-0']])->pluck('nombrecompleto','id');

    return view('admin.recursohumano.solicitudespermisos.listasolicitudespermiso',compact('permisos','asesor'));
	}

    public function versolicitud($id)
	{
    $permiso = Permiso::find($id);
    $formato = Carbon::createFromFormat('Y-m-d',$permiso->f_fechasolicitud);
    $permiso->f_fechasolicitud = $formato->format('d/m/Y');
    $formato = Carbon::createFromFormat('Y-m-d',$permiso->f_desde);
    $permiso->f_desde = $formato->format('d/m/Y');
    $formato = Carbon::createFromFormat('Y-m-d',$permiso->f_hasta);
    $permiso->f_hasta = $formato->format('d/m/Y');
    $motivos = MotivoPermiso::orderBy('id','ASC')->pluck('v_motivo','id');

     if($permiso->i_tiemposolicitado==0){
      $permiso->h_desde =  Carbon::createFromFormat('H:i:s', $permiso->h_desde)->format('h:i A');
      $permiso->h_hasta =  Carbon::createFromFormat('H:i:s', $permiso->h_hasta)->format('h:i A');
      }
    $permiso->each(function($permiso){ 
      $permiso->empleado;
    });
		return view('admin.recursohumano.solicitudespermisos.versolicitudpermiso')->with('permiso',$permiso)->with('motivos',$motivos);	
	}

    public function crearsolicitud()
	{
		$hoy = Carbon::now();
		$hoy = $hoy->format('d/m/Y');
		$motivos = MotivoPermiso::orderBy('v_motivo','ASC')->where('estado','=','1')->pluck('v_motivo','id');
	
    $empleados = Empleado::orderBy('id','ASC')->where('estado','=','1')->get();
		return view('admin.recursohumano.solicitudespermisos.crearsolicitudpermiso')->with('hoy',$hoy)->with('motivos',$motivos)->with('empleados',$empleados);	
	}

  public function agregarsolicitud(PermisoRequest $Request)
  {
   // dd($Request);
    $permiso = new Permiso($Request->all());
    $empleado = Empleado::where('v_numeroexp','LIKE','%'.$Request->expediente.'%')->first();
    $periodo = explode(' - ', $Request->periodo);
    $formato = Carbon::createFromFormat('d/m/Y',$periodo[0]);
    $formato2 = Carbon::createFromFormat('d/m/Y',$periodo[1]);
    $formato3 = Carbon::createFromFormat('d/m/Y',$Request->f_fechasolicitud);
    $permiso->f_desde = $formato->format('Y/m/d');
    $permiso->f_hasta = $formato2->format('Y/m/d');
    $permiso->f_fechasolicitud = $formato3->format('Y/m/d');
     if($Request->txthoraLE!=''){
        $permiso->h_desde = date('H:i:s',strtotime($Request->txthoraLE));
        $permiso->h_hasta = date('H:i:s',strtotime($Request->txthoraLS));
    }

    //$permiso->h_desde = $Request->txthoraLE;
    //$permiso->h_hasta = $Request->txthoraLS;
    $permiso->i_horas = $Request->i_horas;
    $permiso->i_minutos = $Request->i_minutos;
    $permiso->estado = 'Pendiente';
    $permiso->solicitante_id = $empleado->id;
 
    $hoy = Carbon::now();
    $hoy = $hoy->year;
    $cantidadpermisos = Permiso::where([['solicitante_id','=',$empleado->id],['estado','=','Aprobada']])->whereYear('f_fechasolicitud','=',$hoy)->count();
    $tipoPermiso = MotivoPermiso::find($Request->motivo_id);

    $cantidadsolicitudes = Permiso::where([['solicitante_id','=',$empleado->id],['estado','=','Pendiente']])->count();
    if($cantidadsolicitudes>=10){
      Flash::warning("El empleado " . $empleado->v_nombres . " " . $empleado->v_apellidos . " tiene una solicitud de permiso pendiente")->important();
          return redirect()->route('listapermisosrh');
    }else{
      if($tipoPermiso->i_maximodiasanual <= $cantidadpermisos){
        /*Flash::warning("Solicitud denegada, el máximo de permisos anuales para el empleado " . $empleado->v_nombres . " " . $empleado->v_apellidos . " ha sido alcanzado")->important();
          return redirect()->route('listapermisosrh');*/
      /*Flash::warning("El máximo de permisos anuales ha sido alcanzado. A partir de hoy los permisos agregados por el  motivo " . $tipoPermiso->v_motivo . " serán SIN GOCE DE SUELDO.")->important();*/

      Flash::warning("El máximo de permisos anuales por el motivo " . $tipoPermiso->v_motivo . " ha sido alcanzado .")->important();

      $permiso->save();
          Flash::success("La solicitud del empleado " . $empleado->v_nombres . " " . $empleado->v_apellidos . " ha sido guardada.")->important();
          return redirect()->route('listapermisosrh');
      }
        else{
          $permiso->save();
          Flash::success("La solicitud de permiso del empleado " . $empleado->v_nombres . " " . $empleado->v_apellidos . " ha sido guardada")->important();   
          return redirect()->route('listapermisosrh');
          
      }
    }
  }

    public function editarsolicitud($id)
	{
    $permiso = Permiso::find($id);
    //$hoy = Carbon::now();

$fecha = $permiso->f_fechasolicitud;  
  $formato = Carbon::createFromFormat('Y-m-d',$fecha);
  $fecha = $formato->format('d/m/Y');
    $permiso->f_fechasolicitud = $fecha;
    $formato = Carbon::createFromFormat('Y-m-d',$permiso->f_desde);
    $permiso->f_desde = $formato->format('d/m/Y');
    $formato = Carbon::createFromFormat('Y-m-d',$permiso->f_hasta);
    $permiso->f_hasta = $formato->format('d/m/Y');
    $motivos = MotivoPermiso::orderBy('v_motivo','ASC')->where('estado','=','1')->pluck('v_motivo','id');

     if($permiso->i_tiemposolicitado==0){
      $permiso->h_desde =  Carbon::createFromFormat('H:i:s', $permiso->h_desde)->format('h:i A');
      $permiso->h_hasta =  Carbon::createFromFormat('H:i:s', $permiso->h_hasta)->format('h:i A');
      }
    $permiso->each(function($permiso){ 
      $permiso->empleado;
    });
		return view('admin.recursohumano.solicitudespermisos.editarsolicitudpermiso')->with('permiso',$permiso)->with('motivos',$motivos);	
	}

  public function actualizarsolicitud(PermisoRequest $request, $id)
  {
    //dd($request);
    $permiso = Permiso::find($id);
    $permiso->fill($request->all()); 
    $formato = Carbon::createFromFormat('d/m/Y',$request->f_fechasolicitud);
    $permiso->f_fechasolicitud = $formato->format('Y/m/d');
    $periodo = explode(' - ', $request->periodo);
    $formato = Carbon::createFromFormat('d/m/Y',$periodo[0]);
    $formato2 = Carbon::createFromFormat('d/m/Y',$periodo[1]);
    $permiso->f_desde = $formato->format('Y/m/d');
    $permiso->f_hasta = $formato2->format('Y/m/d');

     if($request->txthoraLE!='' || $request->txthoraLE!=null){
        $permiso->h_desde = date('H:i:s',strtotime($request->txthoraLE));
        $permiso->h_hasta = date('H:i:s',strtotime($request->txthoraLS));
    }
    else
    {
     $permiso->h_desde =null;
     $permiso->h_hasta =null;
      
    }

    $tipoPermiso = MotivoPermiso::find($request->motivo_id);
    if($tipoPermiso->i_maximodiasanual< $request->i_tiemposolicitado){
     // Flash::warning("Actualización denegada, la cantidad de días solicitados supera la duración máxima permitida")->important();
     // return redirect()->route('listapermisosrh');
      Flash::warning("La cantidad de dias solicitados ha superado el máximo de dias permitidos.");
    }//else{
      $permiso->save();
      Flash::success("La solicitud de permiso del empleado " . $request->nombre . " ha sido actualizada")->important();   
      return redirect()->route('listapermisosrh');
      //}      
  }

  public function aprobarsolicitud($id)
  {
    $permiso = Permiso::find($id);
    $permiso->each(function($permiso){ 
      $permiso->empleado;
    });
   /* $hoy = Carbon::now();
    $hoy = $hoy->format('Y-m-d');
    if($hoy > $permiso->f_desde){ 
      Flash::warning("La solicitud del empleado " . $permiso->empleado->v_nombres . " " . $permiso->empleado->v_apellidos . " no puede ser aprobada, el periodo solicitado es incorrecto")->important();
       return redirect()->route('listapermisosrh'); 
    }else{*/
      $permiso->estado = 'Aprobada';
      $permiso->save();
      Flash::success("La solicitud del empleado " . $permiso->empleado->v_nombres . " " . $permiso->empleado->v_apellidos . " ha sido aprobada")->important();
      return redirect()->route('listapermisosrh'); 
   // }
  }

  public function denegarsolicitud($id)
  {
    $permiso = Permiso::find($id);
    $permiso->each(function($permiso){ 
      $permiso->empleado;
    });
    $permiso->estado = 'Denegada';
    $permiso->save();
    Flash::error("La solicitud del empleado " . $permiso->empleado->v_nombres . " " . $permiso->empleado->v_apellidos . " ha sido denegada")->important();
    return redirect()->route('listapermisosrh'); 
  }

  public function resumenpermisosrh(Request $request)
  {
if($request->f_permisos!=null){
    $hoy = Carbon::now();
    $hoy = $hoy->year;

      $periodo = explode(' - ', $request->f_permisos);
      $f_desde = Carbon::createFromFormat('d/m/Y',$periodo[0]);
      $f_hasta = Carbon::createFromFormat('d/m/Y',$periodo[1]);
      $f_desde = $f_desde->format('Y-m-d');
      $f_hasta = $f_hasta->format('Y-m-d');

$permisos=Permiso::orderBy('solicitante_id','ASC')->whereHas('empleado', function($q)
    {
      $q->where('estado',1); 
    })->with('empleado')->with('motivoPermiso')->where('estado','Aprobada')
    ->WhereBetween('f_desde',[$f_desde,$f_hasta])
    ->WhereBetween('f_hasta',[$f_desde,$f_hasta])
    ->get();

if(!count($permisos)>0)
{
dd('No hay informacion para mostrar');
}

 foreach($permisos as $permiso)
    {
    $formato = Carbon::createFromFormat('Y-m-d',$permiso->f_fechasolicitud);
    $permiso->f_fechasolicitud = $formato->format('d/m/Y');
    }
    
/*$empleados=Empleado::whereHas('permisos',function($q)use($f_desde,$f_hasta){
 $q->WhereBetween('f_desde',[$f_desde,$f_hasta])
  ->WhereBetween('f_hasta',[$f_desde,$f_hasta]);
})->where([['estado','1'],['v_numeroexp','!=','RH0000-0']])->get();*/
//$permisoslista=$this->permisos($empleados,$f_desde,$f_hasta);
//dd($permisoslista);
   
 
    return view('admin.recursohumano.solicitudespermisos.resumenpermisosrh',compact('empleados','permisos')); 
  }
  else
{

  Flash::warning('Debe seleccionar una fecha de búsqueda para iniciar')->important();
  return redirect()->route('listapermisosrh');
}
}

private function permisos($empleados=array(),$f_desde,$f_hasta)
{
$result=array();
foreach ($empleados as $key => $value)
 {
   $result[$value->v_nombres]=Permiso::orderBy('solicitante_id','ASC')->whereHas('empleado', function($q)use($value)
    {
      $q->where('solicitante_id',$value->id); 
    })->with('empleado')->with('motivoPermiso')->where('estado','Aprobada')
    ->WhereBetween('f_desde',[$f_desde,$f_hasta])
    ->WhereBetween('f_hasta',[$f_desde,$f_hasta])
    ->get();

}
return $result;
}

}
