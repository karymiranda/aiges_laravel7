<?php  

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Grados;
use App\Seccion;
use App\Asignaturas;
use App\HorarioClases;
use App\Empleados;
use App\Periodoactivo;
use App\Periodoevaluacion;
use App\Expedienteestudiante;
use App\EvaluacionesPeriodo;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;
use Carbon\Carbon;

class CalificacionesController extends Controller
{
  /*  
    public function listaseccionespordocente()
    {
$anio=Periodoactivo::periodoescolar()->first();//uso el scope para sacar el periodo activo
$anio=$anio->anio;
$secciones = $this->secciones_docente();//selecciono las secciones donde el docente es asesor 
//dd($secciones);


$anio=Periodoactivo::periodoescolar()->first();//uso el scope para sacar el periodo activo
$anio=$anio->anio;
$secciones = $this->secciones_docente_horario();//saca las secciones en las que el docente imarte asignaturas, segun su horario de clases establecido
return view('admin.personaldocente.gestionacademica.controlcalificaciones.listaseccionespordocente')->with('secciones',$secciones);   
    }
 
    public function listaasignaturasxseccion($id)
    {
 $b = Seccion::select(\DB::raw('CONCAT(tb_grados.grado, " ", tb_secciones.seccion) AS grado'), 'tb_secciones.id')
            ->join('tb_grados', 'tb_grados.id', '=', 'tb_secciones.grado_id')
            ->where('tb_secciones.id','=',$id)->first();
$a = $this->asignaturas_docente_horario($id);
return view('admin.personaldocente.gestionacademica.controlcalificaciones.listaasignaturasporseccion')->with('asignaturas',$a)->with('b',$b);
    }
*/
    protected function secciones_docente() //saca las secciones qu pertenecen al docente logeado
		{ 

		    $secciones = Seccion::select(\DB::raw('CONCAT(tb_grados.grado, " ", tb_secciones.seccion) AS grado'), 'tb_secciones.id')
            ->join('tb_grados', 'tb_grados.id', '=', 'tb_secciones.grado_id')
            ->where([['tb_secciones.empleado_id','=',Auth::user()->empleado->id],['tb_secciones.estado','=',1]])->get();
		    return $secciones; 
		}

   protected function secciones_docente_horario() //saca las secciones qu pertenecen al docente logeado y en las que imparte alguna materia
        { 
            $secciones = Seccion::select(\DB::raw('CONCAT(tb_grados.grado, " ", tb_secciones.seccion) AS grado'), 'tb_secciones.id')
            ->join('tb_grados', 'tb_grados.id', '=', 'tb_secciones.grado_id') 
            ->join('tb_horario_clases', 'tb_horario_clases.seccion_id', '=', 'tb_secciones.id')
            ->groupBy('tb_secciones.id')
            ->where('tb_horario_clases.docente_id','=',Auth::user()->empleado->id)->pluck('grado','id');
            return $secciones; 
        }


         protected function asignaturas_docente_horario($id) //saca las secciones qu pertenecen al docente logeado y en las que imparte alguna materia
        { 
             $a = Asignaturas::select('tb_asignaturas.asignatura','tb_asignaturas.id')
            ->join('tb_horario_clases', 'tb_horario_clases.asignatura_id', '=', 'tb_asignaturas.id')
            ->groupBy('tb_asignaturas.id')
            ->where([['tb_horario_clases.docente_id','=',Auth::user()->empleado->id],['tb_horario_clases.seccion_id','=',$id]])->get();

            return $a; 
        }

 public function registrarcalificaciones()
    {
//MUESTRA SOLO EL PERIODO DENTRO DEL CUAL CORRESPONDE LA FECHA ACTUAL, ES DECIR, NO MOSTRARA PERIODOS QUE YA HAYAN FINALIZADO SEGUN EL RANGO DE FECHA DE DURACION DEFINIDA 
$hoy=Carbon::now()->format('Y-m-d');
$periodos=Periodoevaluacion::with('periodoevaluacion_cicloescolar')->where(
    [['estado','=','1'],['fecha_inicio','<=',$hoy],['fecha_fin','>=',$hoy]])->pluck('descripcion','id');
//dd($periodos);
$secciones=$this->secciones_docente_horario();
 return view('admin.personaldocente.gestionacademica.controlcalificaciones.registrarcalificacion')->with('secciones',$secciones)->with('periodos',$periodos);

    }

    public function listadoasignaturas(Request $request,$id){
      $asignaturas = $this->asignaturas_docente_horario($id);
     return response()->json($asignaturas);   
    }
    
    public function listadoestudiantes($seccion_id){
$datos=Expedienteestudiante::orderBy('v_apellidos','ASC')->whereHas('estudiante_seccion',function ($q) use ($seccion_id){
    $q->where('seccion_id','=',$seccion_id);
})->where('estado','=',1)->get();
 return response()->json($datos);
    }

        public function guardarcalificaciones(Request $request)
        {
dd($request);
        }

}
