<?php

namespace App\Http\Controllers;

use App\Notas;
use App\Seccion;
use App\HorarioClases;
use App\Expedienteestudiante;
use App\Estadistica;
use App\CuadroFinal;
use App\CuadroFinalNota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\PdfController;
use Laracasts\Flash\Flash;
use Carbon\Carbon;

class CuadroFinalController extends Controller
{
    public function index()
    {        
    }


    public function store(Request $request)
    { 
        $params = $request->all();
        $seccion = Seccion::find($params['id']);
        DB::beginTransaction();
        try {
            $cuadroFinal = CuadroFinal::create([ "seccion_id" => $params['id'] ]);
            self::getArrayNotesInsert($cuadroFinal, $seccion);
            DB::commit();  
            return redirect()->route('cuadroFinal.show', $params['id'])
                ->with('success', 'Cuadro final creado con éxito.');
        } catch (\Throwable $th) {
           // dd($th);
            DB::rollBack();
            return redirect()->route('cuadroFinal.show', $params['id'])
                ->with('error', 'Hemos tenido un problema con la base de datos, intenta más tarde por favor');
        }
    }

    public function checkoutStudentsPromovido($students = array()) {
        foreach ($students as $v) {
            if(
                $v->lenguaje >= 5 && $v->matematica >= 5 && $v->ciencia >= 5 &&
                $v->sociales >= 5 && $v->fisica >= 5 && $v->urbanida >= 5 && (@$v->artistica >= 5 || @$v->ingles >= 5)
            ) {
                $v->reprobado = false;
            } else {
                $v->reprobado = true;
            }
        }
        return $students;
    }
    
    public function show($id)
    {
        $students = [];
        $is_data = FALSE;
        $cuadros = CuadroFinal::where("seccion_id", $id)->first();
        if($cuadros) {
            $is_data = TRUE;
            $students = self::getArrayNotesStudents($id);
            $students = self::checkoutStudentsPromovido($students);

        }

        $seccion=Seccion::where('id',$id)->pluck('descripcion','id');
        return view('admin.cuadro-final.index', compact('is_data', 'id', 'students','seccion'));
    }

    public function CuadroFinalController(Request $request)
    {
        
    }
    
    // View PDF Cuadro Final
    public function getCuadroFinalSeccion($id)
    {
        $args = [];
        $cuadro = CuadroFinal::where('seccion_id', $id)->first();        
        if($cuadro) {
            $args['seccion'] = Seccion::find($id);
           // dd($args['seccion']->anio);
            $args['estadistica'] = Estadistica::where('seccion_id', $id)->first();
            $args['items'] = CuadroFinalNota::where('cuadro_final_id', $cuadro->id)->get();
            $args['promedios'] = self::getPromedios($cuadro->id);
            $sqlQuery = "SELECT conducta_alumno.* FROM conducta_alumno INNER JOIN tb_expedienteestudiante ON conducta_alumno.alumno_id = tb_expedienteestudiante.id INNER JOIN tb_periodoevaluaciones ON conducta_alumno.periodo_id = tb_periodoevaluaciones.id INNER JOIN tb_matriculaestudiante ON tb_matriculaestudiante.estudiante_id = tb_expedienteestudiante.id WHERE tb_matriculaestudiante.seccion_id = {$id} AND conducta_alumno.periodo_id = (  SELECT tbp.id FROM tb_periodoevaluaciones tbp inner join tb_periodo_activo pa WHERE tbp.nombre = 'P3' and tbp.periodo_id=pa.id and pa.anio={$args['seccion']->anio} ) ORDER BY alumno_id";
            $pdf = new PdfController('L', 'cm', 'Legal');
            $args['conductas'] = DB::select( DB::raw($sqlQuery) );
            $pdf->cuadroFinal($args);

            return response()->make($pdf->Output(), 200, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="doc.pdf"'
            ]);
        }
    }

    // Funciones para generar los datos del cuadro final
    public function getPromedios($seccion)
    {
        $sqlQuery = "SELECT sum( lenguaje ) 'lenguaje', sum( matematica ) 'matematica', sum( ciencia ) 'ciencia', sum( sociales ) 'sociales', sum( artistica ) 'artistica', sum( ingles ) 'ingles', sum( fisica ) 'fisica', sum( urbanida ) 'urbanida', avg( lenguaje ) 'lenguajePromedio', avg( matematica ) 'matematicaPromedio', avg( lenguaje ) 'cienciaPromedio', avg( sociales ) 'socialesPromedio', avg( artistica ) 'artisticaPromedio', avg( ingles ) 'inglcuadrofinaosPromedio', avg( fisica ) 'fisicaPromedio', avg( urbanida ) 'urbanidaPromedio' FROM cuadro_final_notas where estado = 1 and cuadro_final_id = {$seccion}";
        return DB::select(DB::raw($sqlQuery));
    }

    // Funciones necesarias para la funcionalidad
    private function getSubjects($id) {
        return self::getObjectArray(DB::table('notas')
            ->join('tb_asignaturas', 'notas.asignatura_id', '=', 'tb_asignaturas.id')
            ->where('notas.seccion_id', $id)
            ->where('tb_asignaturas.is_cuadro', 1)
           
            ->select('tb_asignaturas.name_short', 'tb_asignaturas.id')
            ->distinct()
            ->get());
    }

    private function getObjectArray($arrayObject) {
        $array = [];
        foreach ($arrayObject as $item) {
            $array[$item->id] = $item->name_short; 
        }
        return $array;
    }

    private function getNotesStudents($alumno_id,$seccion){
        $arrayResponse = [];
        $currentAsigantura = null;
        $sqlQuery = "SELECT notas.asignatura_id, notas_items.calificacion,tb_evaluacionesperiodo.d_porcentajeActividad as porcentaje FROM notas_items INNER JOIN notas ON notas.id = notas_items.notas_id and notas.seccion_id={$seccion} INNER JOIN tb_evaluacionesperiodo ON tb_evaluacionesperiodo.id = notas.evaluacion_id WHERE notas_items.alumno_id = {$alumno_id} ORDER BY notas.asignatura_id";
        $notes = DB::select(DB::raw($sqlQuery));

        foreach($notes as $value) {
            $strName = $value->asignatura_id;
            if($currentAsigantura != $strName)
                $arrayResponse[$strName] = array("calificacion" => 0);

            $arrayResponse[$strName]['calificacion'] += (
                floatval($value->calificacion) * floatval($value->porcentaje)
            )/100;
            $currentAsigantura = $value->asignatura_id;
        }
        //dd($arrayResponse);
        return $arrayResponse;
    }

    private function getArrayNotesInsert($cuadroFinal, $seccion){
        $arraySubjects = [];
        $subjects = self::getSubjects($seccion->id);
//dd($seccion);
        foreach ($seccion->studentsIds as $student) {
            $arraySubjects = [];
            $notes = self::getNotesStudents($student->id,$seccion->id);
            foreach ($notes as $key => $note) {
                $strName = @$subjects[$key];

                if($strName) {
                    $arraySubjects[ $strName ] = number_format(($note['calificacion']/3),1);
                }
                $arraySubjects['alumno_id'] = $student->id;
                $arraySubjects['estado'] = 1;
            }
            // dd($arraySubjects);
            $cuadroFinal->items()->save(CuadroFinalNota::create($arraySubjects));
        }
    }

    
    public function getGenerateNotes(Request $request)
    {
        //dd($request);
        $arraySubjects = [];
        $all = $request->all();
        $subjects = self::getSubjects($all['seccion']);
        $sqlQuery = "SELECT alumno_id, id FROM cuadro_final_notas WHERE cuadro_final_id = ( SELECT id FROM cuadro_final 
            WHERE seccion_id = {$all['seccion']} ) AND promovido = 0";
        $students = DB::select(DB::raw($sqlQuery));
 //dd($students);
        foreach ($students as $value) {
            $arraySubjects = [];
            $notes = self::getNotesStudents($value->alumno_id,$all['seccion']);
            foreach ($notes as $key => $note) {
                $strName = @$subjects[$key];
                if($strName) {
                    $arraySubjects[ $strName ] = ($note['calificacion']/3);
                }
                $arraySubjects['alumno_id'] = $value->alumno_id;
                $arraySubjects['estado'] = 1;
            }
            CuadroFinalNota::where('id', $value->id)->update($arraySubjects);
        }
        return redirect()->route('cuadroFinal.show', $all['seccion'])
                ->with('success', 'Hemos actualizado con la notas de la sección para el cuadro final');
    }

    private function getArrayNotesStudents($id)
    {
        $sqlQuery = "SELECT cuadro_final_notas.id, cuadro_final_notas.alumno_id, cuadro_final_notas.lenguaje, cuadro_final_notas.matematica, cuadro_final_notas.ciencia, cuadro_final_notas.sociales, cuadro_final_notas.ingles, cuadro_final_notas.artistica, cuadro_final_notas.fisica, cuadro_final_notas.urbanida, cuadro_final_notas.estado, tb_expedienteestudiante.v_nie, tb_expedienteestudiante.v_nombres, tb_expedienteestudiante.v_apellidos FROM cuadro_final INNER JOIN cuadro_final_notas ON cuadro_final_notas.cuadro_final_id = cuadro_final.id INNER JOIN tb_expedienteestudiante ON cuadro_final_notas.alumno_id = tb_expedienteestudiante.id where cuadro_final.seccion_id = {$id} and cuadro_final_notas.estado=1 order by tb_expedienteestudiante.v_apellidos, tb_expedienteestudiante.v_nombres"; 
        return DB::select( DB::raw($sqlQuery));
    }

    public function closeexpedient(Request $request)
    {  

        $all = $request->get('aprobado');
       if(count($all)>0){

        foreach ($all as $value)  {
             $all = $request->get('aprobado');
            $item = CuadroFinalNota::where('alumno_id', $value)
                ->update([
                    "promovido" => 1,
                    "estado" => 0
                ]);

    }
}
  $all = $request->get('reprobado');
 if(!empty($all)){
     $rep = $request->get('reprobado');
        foreach ($rep as $value) {
           $item = CuadroFinalNota::where('alumno_id', $value)
                ->update([
                    "promovido" => 0,
                    "estado" => 0
                ]);
     
}
}
return json_encode([ "response" => 'ok' ]);
       
    }


  public function eliminarCuadro(Request $req,$seccion)
    {

$cuadro=CuadroFinal::with('items')->where('seccion_id',$seccion)->first();
$cuadro->items()->delete(); 
$cuadro->delete();
 ///return redirect()->route('cuadroFinal.show',$req->seccion);
    }

    public function getEstadistica(Request $request)
    {
        $estadistica = array();
        $seccion = $request->get('seccion');
        $array = self::getEstadisticaQuery($seccion);

        $estadistica['inicial'] = [
            "f" => @$array['matriculaInicial'][0]->count,
            "m" => @$array['matriculaInicial'][1]->count,
        ];

        $estadistica['retirados'] = [
            "f" => (@$array['sqlQueryRetirados'][0]) ? @$array['sqlQueryRetirados'][0]->count : 0,
            "m" => (@$array['sqlQueryRetirados'][1]) ? @$array['sqlQueryRetirados'][1]->count : 0,
        ];

        $estadistica['final'] = [
            "f" => ($estadistica['inicial']['f'] - $estadistica['retirados']['f']),
            "m" => ($estadistica['inicial']['m'] - $estadistica['retirados']['m']),
        ];

        $estadistica['promovidos'] = [
            "f" => @$array['sqlQueryPromovidos'][0]->count,
            "m" => @$array['sqlQueryPromovidos'][1]->count,
        ];

$estadistica['traslado'] = [
            "f" => @$array['sqlQueryTraslado'][0]->count,
            "m" => @$array['sqlQueryTraslado'][1]->count,
        ];

        $estadistica['retenidos'] = [
           "f" => @$array['sqlQueryRetenidos'][0]->count,
            "m" => @$array['sqlQueryRetenidos'][1]->count,
        ];

        $estadistica['repitencia'] = [
            "f" => @$array['sqlQueryRepitencia'][0]->count,
            "m" => @$array['sqlQueryRepitencia'][1]->count,
        ];

         
     
        $model = Estadistica::where('seccion_id', $seccion)->first();
        if(!$model) {
            $model = new Estadistica();
        }
        
        self::createEstadistica($estadistica, $seccion, $model);
    }

    public function createEstadistica($e, $s, $el)
    {
        $el->seccion_id = $s;
        
        $el->m_ini_m = $e['inicial']['m'];
        $el->m_ini_f = $e['inicial']['f'];

        if($e['inicial']['m']==null){$el->m_ini_m =0;}
        if($e['inicial']['f']==null){$el->m_ini_f =0;}

        $el->retirados_m = $e['retirados']['m'];
        $el->retirados_f = $e['retirados']['f'];

        if($e['retirados']['m']==null){$el->retirados_m =0;}
        if($e['retirados']['f']==null){$el->retirados_f =0;}

        $el->promovidos_m = $e['promovidos']['m'];
        $el->promovidos_f = $e['promovidos']['f'];

        if($e['promovidos']['m']==null){$el->promovidos_m =0;}
        if($e['promovidos']['f']==null){$el->promovidos_f =0;}

        $el->retenidos_m = $e['retenidos']['m'];
        $el->retenidos_f = $e['retenidos']['f'];

        if($e['retenidos']['m']==null){$el->retenidos_m =0;}
        if($e['retenidos']['f']==null){$el->retenidos_f =0;}
        
   $el->traslado_m = $e['traslado']['m'];
   $el->traslado_f = $e['traslado']['f'];
    
    if($e['traslado']['m']==null){$el->traslado_m =0;}
    if($e['traslado']['f']==null){$el->traslado_f =0;}

   $el->repitencia_m = $e['repitencia']['m'];
   $el->repitencia_f = $e['repitencia']['f'];
    
    if($e['repitencia']['m']==null){$el->repitencia_m =0;}
    if($e['repitencia']['f']==null){$el->repitencia_f =0;}

   $el->m_fin_m = $e['final']['m'];
   $el->m_fin_f = $e['final']['f'];

        if($e['final']['m']==null){$el->m_fin_m =0;}
        if($e['final']['f']==null){$el->m_fin_f =0;}


        $el->save();
    }

    private function getEstadisticaQuery($id) {
        $a = array();
        $a['matriculaInicial'] = DB::select(
            DB::raw("SELECT count(*) as count, tb_expedienteestudiante.v_genero FROM tb_expedienteestudiante INNER JOIN tb_matriculaestudiante ON tb_matriculaestudiante.estudiante_id = tb_expedienteestudiante.id WHERE seccion_id ={$id} GROUP BY tb_expedienteestudiante.v_genero")
        );

        $a['sqlQueryRetirados'] = DB::select(
            DB::raw("SELECT count(*) as count, tb_expedienteestudiante.v_genero FROM tb_expedienteestudiante INNER JOIN tb_matriculaestudiante ON tb_matriculaestudiante.estudiante_id = tb_expedienteestudiante.id WHERE seccion_id = {$id}  AND tb_matriculaestudiante.estado = 0  GROUP BY tb_expedienteestudiante.v_genero ")
        );

        $a['sqlQueryPromovidos'] = DB::select(
            DB::raw(
                "SELECT count(*) as count, tb_expedienteestudiante.v_genero FROM cuadro_final_notas INNER JOIN tb_expedienteestudiante ON cuadro_final_notas.alumno_id = tb_expedienteestudiante.id INNER JOIN cuadro_final ON cuadro_final_notas.cuadro_final_id = cuadro_final.id WHERE cuadro_final.seccion_id = {$id} and cuadro_final_notas.promovido = 1 and cuadro_final_notas.estado = 0 GROUP BY tb_expedienteestudiante.v_genero"
            )
        );

        $a['sqlQueryRetenidos'] = DB::select(
            DB::raw(
                "SELECT count(*) as count, tb_expedienteestudiante.v_genero FROM cuadro_final_notas INNER JOIN tb_expedienteestudiante ON cuadro_final_notas.alumno_id = tb_expedienteestudiante.id INNER JOIN cuadro_final ON cuadro_final_notas.cuadro_final_id = cuadro_final.id WHERE cuadro_final.seccion_id = {$id} and cuadro_final_notas.promovido = 0 and cuadro_final_notas.estado=0 GROUP BY tb_expedienteestudiante.v_genero"
            )
        );

        $a['sqlQueryTraslado'] = DB::select(
            DB::raw("SELECT count(*) as count, expe.v_genero FROM tb_expedienteestudiante as expe INNER JOIN tb_matriculaestudiante as mat ON mat.estudiante_id = expe.id WHERE mat.seccion_id = {$id} AND mat.estado = 0 AND expe.deshabilitadomotivo='T'  GROUP BY expe.v_genero"
            )
        );

         $a['sqlQueryRepitencia'] = DB::select(
            DB::raw("SELECT count(*) as count, expe.v_genero FROM tb_expedienteestudiante as expe INNER JOIN tb_matriculaestudiante as mat ON mat.estudiante_id = expe.id WHERE mat.seccion_id = {$id} AND mat.estado = 0 AND mat.matricula>1  GROUP BY expe.v_genero"
            )
        );

       
        return $a;
    }

public function cerrarSeccion($idseccion)
    {
$cuadro = DB::select(
            "SELECT * from cuadro_final_notas as i INNER JOIN  cuadro_final as c on i.cuadro_final_id=c.id and c.seccion_id={$idseccion} where (i.estado=1)"
           
        );

  if(count($cuadro)>0)
  {
    Flash::error('No es posible realizar el cierre de  sección. Antes, debe generar el cuadro final y cerrar todos los expedientes estudiantiles.')->important();
    return redirect()->route('listasecciones');
    
  }
  else 
  {
   
$seccion=Seccion::where('id',$idseccion)->first();

if($seccion->seccion_grado->nivel==9)//para desactivar estudiantes de noveno grado
{

    $fecha = Carbon::today();
    $fecha=$fecha->format('Y-m-d');
    $listaestudiantes=CuadroFinal::with(['items'=>function($q){
        $q->where('promovido',1);
    }])->where('seccion_id',$idseccion)->first();
    //dd($listaestudiantes->items );

    foreach ($listaestudiantes->items as $key => $value) {
         $alumno=Expedienteestudiante::find($value->alumno_id)->update(["estado"=>0,"deshabilitadomotivo"=>'G',"deshabilitadofecha"=>$fecha]);
    }
Flash::warning('Expedientes estudiantiles de noveno grado que fueron promovidos han sido desactivados.')->important();
}//cierro if noveno

//Cerrar matriculas de la seccion
$lista=Expedienteestudiante::whereHas('estudiante_seccion', function ($q) use($idseccion){
    $q->where('seccion_id',$idseccion);
})->get();
//dd($lista);
foreach ($lista as $key => $value) 
{
 //$estudiante=Expedienteestudiante::find($value->id);
Expedienteestudiante::find($value->id)->estudiante_seccion()->updateExistingPivot($idseccion, ['estado'=>0]);   
}

$seccion=Seccion::find($idseccion)->update([
                    "estado" => 0
                ]);
$horarios=HorarioClases::where('seccion_id',$idseccion)->update([
                    "estado" => 0
                ]);
Flash::success('Cierre de sección realizado con éxito. ')->important();
    return redirect()->route('listasecciones');
  }

    }

}
