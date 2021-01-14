<?php
 
namespace App\Http\Controllers;
use App\Http\Requests\AsignaturaRequest;
use Illuminate\Http\Request;
use App\Asignaturas;
use App\Grados;
use App\Seccion;
use Carbon\Carbon;
use Laracasts\Flash\Flash;

class AsignaturasController extends Controller
{
    public function index()
    {
    	$asignaturas=Asignaturas::orderBy('id','ASC')->where('estado','=','1')->get();
    	//dd($asignaturas);
    return view('admin.configuraciones.administracionacademica.asignaturas.listaasignaturas')->with('asignaturas',$asignaturas);
    }

    public function agregarasignatura()
    {
     return view('admin.configuraciones.administracionacademica.asignaturas.agregarasignatura');	
    }

     public function guardarasignatura(AsignaturaRequest $request)
    {
     
    	$asignatura=new Asignaturas($request->all());
      if($asignatura->tercerciclo==null)
      {      $asignatura->tercerciclo=0;} else{ $asignatura->tercerciclo=1;} 
  $correlativo=Asignaturas::where('orden','!=',0)->count();
  if(isset($request->is_cuadro)){
        $asignatura->is_cuadro=1;
        $asignatura->orden=$correlativo;
     }
     else
        {
            $asignatura->is_cuadro=0;
             $asignatura->orden=0;
        }

    	$asignatura->estado='1';
    	$asignatura->save();
    	Flash::success("La asignatura " . $asignatura->asignatura . " ha sido registrada exitosamente")->important();
		return redirect()->route('listaasignaturas');
    }

    public function editarasignatura($id)
    {
    // dd('exito');
    	$asignatura=Asignaturas::find($id);
    	return view('admin.configuraciones.administracionacademica.asignaturas.editarasignatura')->with('asignatura',$asignatura);
    }

    public function actualizarasignatura(AsignaturaRequest $request,$id)
    {
     // dd($request);
$asignatura=Asignaturas::find($id);
$asignatura->fill($request->all());
if($request->tercerciclo==null)
      {     $asignatura->tercerciclo=0;} else{ $asignatura->tercerciclo=1;} 
$asignatura->save(); 
Flash::success("Asignatura " .$asignatura->asignatura. " actualizada exitosamente")->important();
return redirect()->route('listaasignaturas');
      }

    public function desactivarasignatura($id)
    {
     $asignatura=Asignaturas::find($id);
     $asignatura->estado=0;
     $asignatura->save();
     Flash::error("La asignatura " .$asignatura->asignatura. "  ha sido deshabilitada exitosamente")->important();
   return redirect()->route('listaasignaturas');
    }

    public function asignarasignaturaporseccion($id)
    {
      $secciones = $this->secciones();
      $asignatura=Asignaturas::where('id','=',$id)->pluck('asignatura','id');
     return view('admin.configuraciones.administracionacademica.asignaturas.asignarasignaturasporseccion')->with('secciones',$secciones)->with('asignatura',$asignatura);    
    }

    public function guardarasignaturaporseccion(Request $request)
    { 
   //       dd($request);  
$asignatura=Asignaturas::find($request->asignatura_id);
foreach($request->secciones as $secciones)
{//utilizo foreach xq es un arreglo el que traigo en el request
$asignatura->asignaturaimpartidaporseccion()->attach($secciones);
}
Flash::success("Asignatura asignada a secciones exitosamente")->important();
        return redirect()->route('listaasignaturas');
    }

     protected function secciones() //saca las secciones qu pertenecen al docente logeado
        { 
            $secciones = Seccion::select(\DB::raw('CONCAT(tb_grados.grado, " ", tb_secciones.seccion) AS grado'), 'tb_secciones.id')
            ->join('tb_grados', 'tb_grados.id', '=', 'tb_secciones.grado_id')
            ->pluck('grado', 'tb_secciones.id');;
            return $secciones; 
        }
}
