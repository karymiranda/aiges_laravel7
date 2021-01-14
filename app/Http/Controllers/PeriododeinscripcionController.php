<?php

namespace App\Http\Controllers;
use Laracasts\Flash\Flash;
use Carbon\Carbon;
use App\Periodohabilmatriculaonline;
use App\InfoCentroEducativo;

use Illuminate\Http\Request;

class PeriododeinscripcionController extends Controller
{
    public function index()
    {
$periodohabil=Periodohabilmatriculaonline::orderBy('id','Asc')->where('estado','=','1')->get();
$hoy=Carbon::now();

    return view('admin.configuraciones.administracionacademica.matriculaenlinea.controlperiodosdeinscripcion')->with('periodohabil',$periodohabil)->with('hoy',$hoy);
    }

    public function agregarperiodo()
    {
        $anios=$this->anyos();
    return view('admin.configuraciones.administracionacademica.matriculaenlinea.periododeinscripcion',compact('anios'));	
    }

    public function guardarperiodoinscripcion(Request $request)
    {
    $periodomatricula=new Periodohabilmatriculaonline($request->all());
    $centroescolar=InfoCentroEducativo::first(); 
    if($centroescolar!=null)//si hay informacion registrada del centro escoalr
    { 
    $anio=$request->anio;   
    $periodo = explode(' - ', $request->periodo);
    $desde = Carbon::createFromFormat('d/m/Y',$periodo[0]);
    $hasta = Carbon::createFromFormat('d/m/Y',$periodo[1]);
    $periodomatricula->f_fechadesde = $desde->format('Y/m/d');
    $periodomatricula->f_fechahasta = $hasta->format('Y/m/d');
    $periodomatricula->estado='1';
    $periodomatricula->centroescolar_id=$centroescolar->id;
   $periodomatricula->save();
   Flash::success("Periodo para matricula en linea habilitado exitosamente")->important();
    
    }
    else{
    		Flash::success("No existe información del Centro Escolar")->important();
    	}

    	return redirect()->route('periododeinscripcionenlinea');	  	
    }

    public function editarperiododeinscripcion($id)
    {
$anios=$this->anyos();
 $periodohabil=Periodohabilmatriculaonline::find($id);
 $desde = Carbon::createFromFormat('Y-m-d',$periodohabil->f_fechadesde);
 $hasta = Carbon::createFromFormat('Y-m-d',$periodohabil->f_fechahasta);
 $desde=$desde->format('d/m/Y');
 $hasta=$hasta->format('d/m/Y');
 $periodo=implode(' - ',[$desde,$hasta]);
    return view('admin.configuraciones.administracionacademica.matriculaenlinea.editarperiododeinscripcion')->with('periodohabil',$periodohabil)->with('periodo',$periodo)->with('anios',$anios);	
    }

     public function actualizarperiododeinscripcion(Request $request,$id)
    {
    $periodomatricula=Periodohabilmatriculaonline::find($id);
    $periodomatricula->fill($request->all());
    $anio=$request->anio;	
    $periodo = explode(' - ', $request->periodo);
    $desde = Carbon::createFromFormat('d/m/Y',$periodo[0]);
    $hasta = Carbon::createFromFormat('d/m/Y',$periodo[1]);
    $periodomatricula->f_fechadesde = $desde->format('Y/m/d');
    $periodomatricula->f_fechahasta = $hasta->format('Y/m/d');
  $periodomatricula->save();
   Flash::success("Periodo para matricula en linea actualizado exitosamente")->important();
   return redirect()->route('periododeinscripcionenlinea');
    }

     public function desactivarperiododeinscripcion($id)
    {
     $periodomatricula=Periodohabilmatriculaonline::find($id);
     $periodomatricula->estado=0;
     $periodomatricula->save();
     Flash::error("Periodo para matricula en linea eliminado exitosamente")->important();
   return redirect()->route('periododeinscripcionenlinea');
    }

        protected function anyos()
    {
    $anio = Carbon::now()->year;
for ($i=$anio+1; $i >2014 ; $i--) { //ara qu me envie la lista de los años a partir del 2000 al año actual+1
    $periodos[$i]=$i;}  
    return $periodos;   
    }
}
