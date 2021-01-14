<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empleado;
use App\Permiso;
use App\AsistenciasRH;
use Carbon\Carbon;
use Laracasts\Flash\Flash;

class AsistenciasrhController extends Controller
{
    public function index()
	{
		$hoy = Carbon::now();
		$hoyc = $hoy->format('Y-m-d');
		$hoyf = $hoy->format('d/m/Y');
		$hoyt = $hoyf . ' - ' . $hoyf;
		$empleados = Empleado::orderBy('v_nombres','ASC')->where([['estado','=','1'],['v_numeroexp','!=','RH0000-0']])->get();
		$lista[]=null;
		$f=1;
		$n=0;
		foreach ($empleados as $empleado) {
			$lista[$n][0][0] = $empleado->v_nombres . ' ' . $empleado->v_apellidos;
			$permiso = Permiso::where([['solicitante_id','=',$empleado->id],['f_desde','<=',$hoyc],['f_hasta','>=',$hoyc],['estado','=','Aprobada']])->count();
			if($permiso!=0){
				$lista[$n][0][2] = 'Permiso';
			}else{
			$asistencias = AsistenciasRH::where([['expedientepersonal_id','=',$empleado->id],['fecha','=',$hoyc]])->get();


				if($asistencias->first()!=null){
					foreach ($asistencias as $asistencia) {
						if($asistencia->asistenciaSN=='S'){
							$lista[$n][0][2] = 'Asistencia';
						}else{
							if($asistencia->asistenciaSN=='N'){
								$lista[$n][0][2] = 'Ausencia';
							}
						}
					}
				}else{
					$lista[$n][0][2] = 'Pendiente';
				}
			}
			$lista[$n][0][1] = $hoyf;
			$n++;
		}
		//dd($hoy);
		return view('admin.recursohumano.asistencias.listaasistenciasrrhh')->with('empleado',$lista)->with('fecha',$hoy)->with('hoy',$hoyt)->with('n',$n)->with('f',$f);		
	} 

	public function tomarasistenciarh(){
		$hoy=Carbon::now();
		$hoyc=Carbon::parse($hoy)->format('Y-m-d');
		$hoyf = Carbon::parse($hoy)->format('d/m/Y');

	 $empleados = Empleado::orderBy('v_nombres','ASC')->where([['estado','=','1'],['v_numeroexp','!=','RH0000-0']])->get();
		$empleados->each(function($empleados){ 
			$empleados->cargo;
		});
		$lista[]=null;
		$n=0;
		foreach ($empleados as $empleado) {
			$lista[$n][0] = $empleado->v_numeroexp;
			$lista[$n][1] = $empleado->v_nombres . ' ' . $empleado->v_apellidos;
			$lista[$n][2] = $empleado->cargo->v_descripcion;
			$permiso = Permiso::where([['solicitante_id','=',$empleado->id],['f_desde','<=',$hoyc],['f_hasta','>=',$hoyc],['estado','=','Aprobada']])->count();
			if($permiso!=0){
				$lista[$n][3] = 'Permiso';
			}else{
				$asistencias = AsistenciasRH::where([['expedientepersonal_id','=',$empleado->id],['fecha','=',$hoyc]])->get();
				if($asistencias->first()!=null){
					foreach ($asistencias as $asistencia) {
						if($asistencia->asistenciaSN=='S'){
							$lista[$n][3] = 'Asistencia';
						}else{
							if($asistencia->asistenciaSN=='N'){
								$lista[$n][3] = 'Ausencia';
							}
						}
					}
				}else{
					$lista[$n][3] = 'Pendiente';
				}
			}
			$lista[$n][4] = $empleado->id;
			$n++;
		}
		//return view('admin.recursohumano.asistencias.tomarasistenciarrhh')->with('empleado',$lista)->with('hoy',$hoyf)->with('n',$n);

$verifyAsistencia=AsistenciasRH::where('fecha',$hoyc)->first();	
	if(count($verifyAsistencia)>0)//ya se registro la asistencia ese dia
	{
return view('admin.recursohumano.asistencias.rrhh_viewasistencia')->with('empleado',$lista)->with('hoy',$hoyf)->with('n',$n);
	}
	else
	{
		return view('admin.recursohumano.asistencias.rrhh_tomarasistencia')->with('empleado',$lista)->with('hoy',$hoyf)->with('n',$n);
	}
	//	}
	}

public function agregarasistenciarh(Request $request)
	  {

	  	$hoy = Carbon::createFromFormat('d/m/Y',$request->fecha);
		$fecha = $hoy->format('Y-m-d');

$Adocente=AsistenciasRH::where('fecha','2020-08-15')->first();

for ($i=0; $i < count($request->ids); $i++)
 { 
	$permiso = Permiso::where([['solicitante_id','=',$request->ids[$i]],['f_desde','<=',$fecha],['f_hasta','>=',$fecha],['estado','=','Aprobada']])->count();

	if($permiso==0)// No tiene permiso
		{
	$asistencia = new AsistenciasRH();	
	$asistencia->expedientepersonal_id =$request->ids[$i];
	$asistencia->fecha=$fecha;
	$f = Carbon::parse($fecha);
	$asistencia->anio=$f->year;
if(isset($request->falto))
{
if(array_key_exists($request->ids[$i], @$request->falto))
		{
		$asistencia->asistenciaSN='N';	
		}
		//asistio
else{
$asistencia->asistenciaSN='S';	
}
}//isset
else{$asistencia->asistenciaSN='S';}
$asistencia->save();
		}
 }
return redirect()->route('tomarasistenciarh');
//return redirect()->route('consultahistorialasistencia_docente');
	  }


	/*
	public function agregarasistenciarh(Request $request)
	  {
	  	$asistencia = new AsistenciasRH();
	    $asistencia->expedientepersonal_id = $request->id;
	    if($request->txthoraE!=''){
		    $asistencia->horaEntrada = date('H:i:s',strtotime($request->txthoraE));
		    $asistencia->horaSalida = date('H:i:s',strtotime($request->txthoraS));
		}
	    $hoy = Carbon::now();
	    $hoyg = $hoy->format('Y-m-d');
	    $asistencia->fecha = $hoyg;
	    $asistencia->anio = $hoy->year;	    
	    $asistencia->asistenciaSN = 'S';
	    $asistencia->save();
	    return redirect()->route('tomarasistenciarh');
	  }*/

	/*  public function agregarausenciarh($id)
	  {
	    $asistencia = new AsistenciasRH();
	    $asistencia->expedientepersonal_id = $id;
	    $hoy = Carbon::now();
	    $hoyg = $hoy->format('Y-m-d');
	    $asistencia->fecha = $hoyg;
	    $asistencia->anio = $hoy->year;	    
	    $asistencia->asistenciaSN = 'N';
	    $asistencia->save();
	    return redirect()->route('tomarasistenciarh',$hoy);
	  }
*/
	  public function listadoasistenciarh(Request $request){
	  	$periodo = explode(' - ', $request->f_asistencia);
	    $f_desde = Carbon::createFromFormat('d/m/Y',$periodo[0]);
	    $f_hasta = Carbon::createFromFormat('d/m/Y',$periodo[1]);
	    $f_desde = $f_desde->format('Y-m-d');
	    $f_hasta = $f_hasta->format('Y-m-d');
	  	
	  	$hoy = Carbon::now();
		$hoyc = $hoy->format('Y-m-d');
		$empleados = Empleado::orderBy('v_nombres','ASC')->where([['estado','=','1'],['v_numeroexp','!=','RH0000-0']])->get();
		$lista[]=null;
		$f=0;
		$n=0;
		foreach ($empleados as $empleado) {
			for($i=$f_desde;$i<=$f_hasta;$i = date("Y-m-d", strtotime($i ."+ 1 days"))){
				$lista[$n][$f][0] = $empleado->v_nombres . ' ' . $empleado->v_apellidos;
				$permiso = Permiso::where([['solicitante_id','=',$empleado->id],['f_desde','<=',$i],['f_hasta','>=',$i],['estado','=','Aprobada']])->count();
				if($permiso!=0){
					$lista[$n][$f][2] = 'Permiso';
				}else{
					$asistencias = AsistenciasRH::where('expedientepersonal_id','=',$empleado->id)->where('fecha', '=',$i)->get();
					if($asistencias->first()!=null){
						foreach ($asistencias as $asistencia) {
							if($asistencia->asistenciaSN=='S'){
								$lista[$n][$f][2] = 'Asistencia';
							}else{
								if($asistencia->asistenciaSN=='N'){
									$lista[$n][$f][2] = 'Ausencia';
								}
							}
							
						}

					}else{
						$lista[$n][$f][2] = 'Pendiente';
					}	
				}
				$fecha = Carbon::createFromFormat('Y-m-d',$i);
				$lista[$n][$f][1] = $fecha->format('d/m/Y');
				$f++;			
			}
			$f=0;
			$n++;
		}	
		$f_desde = Carbon::createFromFormat('d/m/Y',$periodo[0]);
	    $f_hasta = Carbon::createFromFormat('d/m/Y',$periodo[1]);
		$f=$this->generateDateRange($f_desde,$f_hasta);	
		if($f>7){ 
		  Flash::warning("El rango no puede excederse de 7 días")->important(); 
		  return redirect()->route('listaasistenciasrh');
		}else{ 	
			return view('admin.recursohumano.asistencias.listaasistenciasrrhh')->with('empleado',$lista)->with('hoy',$request->f_asistencia)->with('n',$n)->with('f',$f);
		}
	  }

	  protected function generateDateRange(Carbon $start_date, Carbon $end_date) 
		{ 
		    $f = 0; 
		    for($date = $start_date; $date->lte($end_date); $date->addDay()) { 
		     	$f++; 
		    } 
		    return $f; 
		} 

/////////////////////////////////////////////////////////////////////////////////

		public function consultahistorialasistencia_docente()
	{
		$fechahoy = Carbon::now();
		$f_desde = Carbon::now()->subWeek();//resto una semana a la fecha de hoy
		$f_desde = $f_desde->format('Y-m-d');
		$f_hasta = $fechahoy->format('Y-m-d');
		$hoyc = $fechahoy->format('Y-m-d');
		$hoy = $fechahoy->format('d-m-Y');
//if(Carbon::now()->isWeekend()){dd('si');}else{dd('no');}//VALIDO SI LA FECHA DE HOY ES FIN DE SEMANA

		$empleados = Empleado::orderBy('v_nombres','ASC')->where([['estado','=','1'],['v_numeroexp','!=','RH0000-0']])->get();
		
		$lista[]=null;
		$f=0;
		$n=0;
		foreach ($empleados as $empleado) {
			for($i=$f_desde;$i<=$f_hasta;$i = date("Y-m-d", strtotime($i ."+ 1 days"))){
				$lista[$n][$f][0] = $empleado->v_nombres . ' ' . $empleado->v_apellidos;
				$permiso = Permiso::where([['solicitante_id','=',$empleado->id],['f_desde','<=',$i],['f_hasta','>=',$i],['estado','=','Aprobada']])->count();
				if($permiso!=0){
					$lista[$n][$f][2] = 'Permiso';
				}else{
					$asistencias = AsistenciasRH::where('expedientepersonal_id','=',$empleado->id)->where('fecha', '=',$i)->get();
					if($asistencias->first()!=null){
						foreach ($asistencias as $asistencia) {
							if($asistencia->asistenciaSN=='S'){
								$lista[$n][$f][2] = 'Asistencia';
							}else{
								if($asistencia->asistenciaSN=='N'){
									$lista[$n][$f][2] = 'Ausencia';
								}
							}
							
						}

					}else{
						$lista[$n][$f][2] = 'Pendiente';
					}	
				}
				$fecha = Carbon::createFromFormat('Y-m-d',$i);
				$lista[$n][$f][1] = $fecha->format('d/m/Y');
				$f++;			
			}
			$f=0;
			$n++;
		}	
$f=7;//para que solo me despliegue maximo 7 dias
		return view('admin.recursohumano.asistencias.consultahistorialasistencia_docente')->with('empleado',$lista)->with('hoy',$hoy)->with('fechahoy',$fechahoy)->with('n',$n)->with('f',$f);
	}

	public function consultalistadoasistenciarh(Request $request){
	  	$periodo = explode(' - ', $request->f_asistencia);
	    $f_desde = Carbon::createFromFormat('d/m/Y',$periodo[0]);
	    $f_hasta = Carbon::createFromFormat('d/m/Y',$periodo[1]);
	    $f_desde = $f_desde->format('Y-m-d');
	    $f_hasta = $f_hasta->format('Y-m-d');
	  	
	  	$hoy = Carbon::now();
		$hoyc = $hoy->format('Y-m-d');
		$empleados = Empleado::orderBy('v_nombres','ASC')->where([['estado','=','1'],['v_numeroexp','!=','RH0000-0']])->get();
		$lista[]=null;
		$f=0;
		$n=0;
		foreach ($empleados as $empleado) {
			for($i=$f_desde;$i<=$f_hasta;$i = date("Y-m-d", strtotime($i ."+ 1 days"))){
				$lista[$n][$f][0] = $empleado->v_nombres . ' ' . $empleado->v_apellidos;
				$permiso = Permiso::where([['solicitante_id','=',$empleado->id],['f_desde','<=',$i],['f_hasta','>=',$i],['estado','=','Aprobada']])->count();
				if($permiso!=0){
					$lista[$n][$f][2] = 'Permiso';
				}else{
					$asistencias = AsistenciasRH::where('expedientepersonal_id','=',$empleado->id)->where('fecha', '=',$i)->get();
					if($asistencias->first()!=null){
						foreach ($asistencias as $asistencia) {
							if($asistencia->asistenciaSN=='S'){
								$lista[$n][$f][2] = 'Asistencia';
							}else{
								if($asistencia->asistenciaSN=='N'){
									$lista[$n][$f][2] = 'Ausencia';
								}
							}
							
						}

					}else{
						$lista[$n][$f][2] = 'Pendiente';
					}	
				}
				$fecha = Carbon::createFromFormat('Y-m-d',$i);
				$lista[$n][$f][1] = $fecha->format('d/m/Y');
				$f++;			
			}
			$f=0;
			$n++;
		}	
		$f_desde = Carbon::createFromFormat('d/m/Y',$periodo[0]);
	    $f_hasta = Carbon::createFromFormat('d/m/Y',$periodo[1]);
		$f=$this->generateDateRange($f_desde,$f_hasta);	
		if($f>7){ 
		  Flash::warning("El rango no puede excederse de 7 días")->important(); 
		  return redirect()->route('listaasistenciasrh');
		}else{ 	
			return view('admin.recursohumano.asistencias.consultahistorialasistencia_docente')->with('empleado',$lista)->with('hoy',$request->f_asistencia)->with('n',$n)->with('f',$f);
		}
	  }


}
