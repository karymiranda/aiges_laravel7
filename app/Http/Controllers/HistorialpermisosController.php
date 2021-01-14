<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Permiso;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\MotivoPermiso;
use App\TipoPermiso;
use App\Http\Requests\PermisoRequest;
use Laracasts\Flash\Flash;

class HistorialpermisosController extends Controller
{
    public function verhistorial()
	{
		$hoy = Carbon::now();
	    $hoy = $hoy->year;
	    $permisos=Permiso::orderBy('f_fechasolicitud','ASC')->whereYear('f_fechasolicitud','=',$hoy)->whereHas('empleado', function($q)
	    {
	      $q->where('id', '=', Auth::user()->empleado->id); 
	    })->with('motivoPermiso')->get();
	    foreach($permisos as $permiso)
	    {
	    	$formato = Carbon::createFromFormat('Y-m-d',$permiso->f_fechasolicitud);
	    	$permiso->f_fechasolicitud = $formato->format('d/m/Y');
	    	$formato = Carbon::createFromFormat('Y-m-d',$permiso->f_desde);
	    	$permiso->f_desde = $formato->format('d/m/Y');
	    	$formato = Carbon::createFromFormat('Y-m-d',$permiso->f_hasta);
	    	$permiso->f_hasta = $formato->format('d/m/Y');
	    }
    	return view('admin.personaldocente.permisos.historialsolicitudespermiso')->with('permisos',$permisos);
	}
	public function crearsolicitud() 
	{
		$hoy = Carbon::now();
		$hoy = $hoy->format('d/m/Y');
		$motivos = MotivoPermiso::orderBy('id','ASC')->where('estado','=','1')->pluck('v_motivo','id');
		
    	return view('admin.personaldocente.permisos.crearsolicitud')->with('hoy',$hoy)->with('motivos',$motivos);
	}

	public function agregarsolicitud(PermisoRequest $Request)
	{
		//dd($Request);
	  	$permiso = new Permiso($Request->all());
	    $periodo = explode(' - ', $Request->periodo);
	    $formato = Carbon::createFromFormat('d/m/Y',$periodo[0]);
	    $formato2 = Carbon::createFromFormat('d/m/Y',$periodo[1]);
	    $formato3 = Carbon::createFromFormat('d/m/Y',$Request->f_fechasolicitud);
	    $permiso->f_desde = $formato->format('Y/m/d');
	    $permiso->f_hasta = $formato2->format('Y/m/d');
	    $permiso->f_fechasolicitud = $formato3->format('Y/m/d');
	    $permiso->estado = 'Pendiente';
	    $permiso->solicitante_id = Auth::user()->empleado->id;

	    if($Request->txthoraLE!=''){
        $permiso->h_desde = date('H:i:s',strtotime($Request->txthoraLE));
        $permiso->h_hasta = date('H:i:s',strtotime($Request->txthoraLS));
    }
    $permiso->i_horas = $Request->i_horas;
    $permiso->i_minutos = $Request->i_minutos;

	    $hoy = Carbon::now();
	    $hoy = $hoy->year;
	    $cantidadpermisos = Permiso::where([['solicitante_id','=',Auth::user()->empleado->id],['estado','=','Aprobada']])->whereYear('f_fechasolicitud','=',$hoy)->count();
	    $cantidadsolicitudes = Permiso::where([['solicitante_id','=',Auth::user()->empleado->id],['estado','=','Pendiente']])->count();
	    $tipoPermiso = MotivoPermiso::find($Request->motivo_id);
	    if($cantidadsolicitudes>=10){
	      Flash::warning("Usted tiene una solicitud de permiso pendiente")->important();
	          return redirect()->route('historialpermisos');
	    }else{
	      if($tipoPermiso->i_maximodiasanual <= $cantidadpermisos){
	        /*Flash::warning("Solicitud denegada, el máximo de permisos anuales ha sido alcanzado")->important();
	          return redirect()->route('historialpermisos');*/
	  /*Flash::warning("El máximo de permisos anuales ha sido alcanzado. A partir de hoy los permisos agregados por el  motivo " . $tipoPermiso->v_motivo . " serán SIN GOCE DE SUELDO.")->important();*/
	   Flash::warning("El máximo de permisos anuales por el motivo " . $tipoPermiso->v_motivo . " ha sido alcanzado .")->important();

      $permiso->save();
          Flash::success("La solicitud de permiso ha sido guardada.")->important();
          return redirect()->route('historialpermisos');

	      }else{
	          $permiso->save();
	          Flash::success("La solicitud de permiso ha sido guardada")->important(); 
	         //$permiso_id=$permiso ->id; 
	         return redirect()->route('historialpermisos');
	       	          
	      }
	    }
	}

	public function editarsolicitud($id)
	{
		$hoy = Carbon::now();
		$hoy = $hoy->format('d/m/Y');
		$permiso=Permiso::find($id);
		$motivos = MotivoPermiso::orderBy('v_motivo','ASC')->where('estado','=','1')->pluck('v_motivo','id');
		$formato = Carbon::createFromFormat('Y-m-d',$permiso->f_desde);
    	$permiso->f_desde = $formato->format('d/m/Y');
    	$formato = Carbon::createFromFormat('Y-m-d',$permiso->f_hasta);
    	$permiso->f_hasta = $formato->format('d/m/Y');
    	return view('admin.personaldocente.permisos.editarsolicitud')->with('hoy',$hoy)->with('permiso',$permiso)->with('motivos',$motivos);
	}

	public function actualizarsolicitud(PermisoRequest $Request,$id)
	{
	  	$permiso = Permiso::find($id);
    	$permiso->fill($Request->all());
	    $periodo = explode(' - ', $Request->periodo);
	    $formato = Carbon::createFromFormat('d/m/Y',$periodo[0]);
	    $formato2 = Carbon::createFromFormat('d/m/Y',$periodo[1]);
	    $formato3 = Carbon::createFromFormat('d/m/Y',$Request->f_fechasolicitud);
	    $permiso->f_desde = $formato->format('Y/m/d');
	    $permiso->f_hasta = $formato2->format('Y/m/d');
	    $permiso->f_fechasolicitud = $formato3->format('Y/m/d');
	    $hoy = Carbon::now();
	    $hoy = $hoy->year;

	    if($request->txthoraLE!='' || $request->txthoraLE!=null){
        $permiso->h_desde = date('H:i:s',strtotime($request->txthoraLE));
        $permiso->h_hasta = date('H:i:s',strtotime($request->txthoraLS));
    }
    else
    {
     $permiso->h_desde =null;
     $permiso->h_hasta =null;
      
    }

	    $tipoPermiso = MotivoPermiso::find($Request->motivo_id);
	    if($tipoPermiso->i_maximodiasanual< $Request->i_tiemposolicitado){
	      Flash::warning("Actualización denegada, la cantidad de días solicitados supera la duración máxima permitida")->important();
	      return redirect()->route('historialpermisos');
	    }else{
	      $permiso->save();
	      Flash::success("La solicitud de permiso ha sido actualizada")->important();   
	      return redirect()->route('historialpermisos');
	      }
	}

	public function versolicitud($id)
	{
		$permiso=Permiso::find($id);
		$motivos = MotivoPermiso::orderBy('v_motivo','ASC')->where('estado','=','1')->pluck('v_motivo','id');
		$formato = Carbon::createFromFormat('Y-m-d',$permiso->f_fechasolicitud);
    	$permiso->f_fechasolicitud = $formato->format('d/m/Y');
    	$formato = Carbon::createFromFormat('Y-m-d',$permiso->f_desde);
    	$permiso->f_desde = $formato->format('d/m/Y');
    	$formato = Carbon::createFromFormat('Y-m-d',$permiso->f_hasta);
    	$permiso->f_hasta = $formato->format('d/m/Y');
    	return view('admin.personaldocente.permisos.verdetallesolicitud')->with('permiso',$permiso)->with('motivos',$motivos);
	}

	public function permisosacumuladosdocentes(Request $request,$iddocente)
	{
		if($request->f_permisos!=null){
    $hoy = Carbon::now();
    $hoy = $hoy->year;

      $periodo = explode(' - ', $request->f_permisos);
      $f_desde = Carbon::createFromFormat('d/m/Y',$periodo[0]);
      $f_hasta = Carbon::createFromFormat('d/m/Y',$periodo[1]);
      $f_desde = $f_desde->format('Y-m-d');
      $f_hasta = $f_hasta->format('Y-m-d');
/*
$permisos=Permiso::orderBy('solicitante_id','ASC')->whereHas('empleado', function($q)
    {
      $q->where('estado',1); 
    })->with('empleado')->with('motivoPermiso')->where('estado','Aprobada')
    ->WhereBetween('f_desde',[$f_desde,$f_hasta])
    ->WhereBetween('f_hasta',[$f_desde,$f_hasta])
    ->where('solicitante_id',$iddocente)
    ->get();

if(!count($permisos)>0)
{
Flash::warning('No hay informacion disponible')->important();
  return redirect()->route('historialpermisos');
}

 foreach($permisos as $permiso)
    {
    $formato = Carbon::createFromFormat('Y-m-d',$permiso->f_fechasolicitud);
    $permiso->f_fechasolicitud = $formato->format('d/m/Y');
    }

 */

$year=Carbon::now()->format('Y');
$sqlQuery="select m.v_motivo,sum(p.i_tiemposolicitado) as dias,sum(p.i_horas) as horas,sum(p.i_minutos) as minutos from tb_permisosempleados as p inner join tb_empleado as e on  e.id=p.solicitante_id and e.id=".$iddocente." inner join tb_motivopermisos as m on m.id=p.motivo_id where f_desde between '".$f_desde."' and '".$f_hasta."' and f_hasta between '".$f_desde."' and '".$f_hasta."' and p.estado like 'Aprobada' group by m.v_motivo ";	

	$consulta = DB::select( DB::raw($sqlQuery));


return view('admin.personaldocente.permisos.resumenpermisosrhindividual',compact('consulta'));

 }
  else
{
  Flash::warning('Debe seleccionar una fecha de búsqueda para iniciar')->important();
  return redirect()->route('historialpermisos');
}
	}
	
}
