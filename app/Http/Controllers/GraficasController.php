<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Expedienteestudiante;
use App\Seccion;
use App\Grados;
use App\Periodoactivo;

class GraficasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


////////////GRAFICAS ONLOAD///////////////////////////
    public function matriculaporanio_graphics($anio)//GRAFICO DE BARRAS
    {
   
        $secciones = Seccion::select(\DB::raw('CONCAT(tb_grados.grado, " ", tb_secciones.seccion) AS grado'))
            ->join('tb_grados', 'tb_grados.id', '=', 'tb_secciones.grado_id')
            ->where('tb_secciones.anio','=',$anio)
            ->withCount(['seccion_estudiante',
                'seccion_estudiante as femenino' => function ($query) use ($anio){
                    $query->where([['tb_matriculaestudiante.anio',$anio],['tb_matriculaestudiante.v_estadomatricula','like','aprobada'],['v_genero','like','Femenino']]);
                }
            ])
            ->withCount(['seccion_estudiante',
                'seccion_estudiante as masculino' => function ($query) use ($anio){
                    $query->where([['tb_matriculaestudiante.anio',$anio],['v_genero','like','Masculino'],['tb_matriculaestudiante.v_estadomatricula','like','aprobada']]);
                }
            ])
            ->withCount(['seccion_estudiante',
                'seccion_estudiante as nuevoingreso' => function ($query) use ($anio){
                    $query->where([['tb_matriculaestudiante.anio',$anio],['tb_matriculaestudiante.v_nuevoingresoSN','like','SI']]);
                }
            ])
            ->withCount(['seccion_estudiante',
                'seccion_estudiante as antiguoingreso' => function ($query) use ($anio){
                    $query->where([['tb_matriculaestudiante.anio',$anio],['tb_matriculaestudiante.v_nuevoingresoSN','like','NO']]);
                }
            ])
            ->get();  

        return   json_encode($secciones);
    }

public function matriculasanuales_graphics($anio)
{
$añoFSeleccionado=$anio;
$añoISeleccionado=$anio-4;//mostrara el historial de 5 añoas atras
    $datos=[];
        $n=0;
        for ($i=$añoISeleccionado; $i <=$añoFSeleccionado ; $i++) {             
            $niñas=\DB::select('select count(*) as Femenino from tb_matriculaestudiante as m inner join tb_expedienteestudiante as e on m.estudiante_id=e.id where m.v_estadomatricula like "%aprobada%"  and m.anio=? and e.v_genero like "%Femenino%" group By e.v_genero',[$i]);
            $niños=\DB::select('select count(*) as Masculino from tb_matriculaestudiante as m inner join tb_expedienteestudiante as e on m.estudiante_id=e.id where m.v_estadomatricula like "%aprobada%" and m.anio=? and e.v_genero like "%Masculino%" group By e.v_genero',[$i]);
            if(!$niñas && !$niños){
            $datos[$n]=['año'=>$i,'niñas'=>0,'niños'=>0];
            }else{
                if($niñas && $niños){
                $datos[$n]=['año'=>$i,'niñas'=>$niñas[0]->Femenino,'niños'=>$niños[0]->Masculino];
                }else{
                    if($niños){
                    $datos[$n]=['año'=>$i,'niñas'=>0,'niños'=>$niños[0]->Masculino];
                    }else{
                        $datos[$n]=['año'=>$i,'niñas'=>$niñas[0]->Femenino,'niños'=>0];
                    }
                }
            }
            $n++;
        }
        //dd($datos); 
        return json_encode($datos);

}


///////////////FIN GRAFICAS ONLOAD////////////////////////////////////////////

    public function getUltimoDiaMes($elAnio,$elMes) {
     return date("d",(mktime(0,0,0,$elMes+1,1,$elAnio)-1));
    }



    public function registros_mes($anio,$mes)//GRAFICO DE BARRAS
    {
        $primer_dia=1;
        $ultimo_dia=$this->getUltimoDiaMes($anio,$mes);
        $fecha_inicial=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$primer_dia) );
        $fecha_final=date("Y-m-d H:i:s", strtotime($anio."-".$mes."-".$ultimo_dia) );
        $usuarios=User::whereBetween('created_at', [$fecha_inicial,  $fecha_final])->get();
        $ct=count($usuarios);

        for($d=1;$d<=$ultimo_dia;$d++){
            $registros[$d]=0;     
        }

        foreach($usuarios as $usuario){
        $diasel=intval(date("d",strtotime($usuario->created_at) ) );
        $registros[$diasel]++;    
        }

        $data=array("totaldias"=>$ultimo_dia, "registrosdia" =>$registros);
        return   json_encode($data);
    }


public function estudiantesactivos_graphics(){
$niñas = Expedienteestudiante::where([['estado',1],['v_genero','like','Femenino']])->count(); 
$niños = Expedienteestudiante::where([['estado',1],['v_genero','like','Masculino']])->count(); 

//$data=array("niñas"=>$niñas,"niños"=>$niños);
$data[0]=$niños;
$data[1]=$niñas;
        return json_encode($data);
    }


    public function index()
    {
       // $anio=date("Y");
        $periodoescolaractivo=Periodoactivo::orderBy('id','ASC')->where([['estado','=','1'],['tipo_periodo','like','ACADEMICO']])->first();
$anio=$periodoescolaractivo->anio;
        $mes=date("m");
        return view("admin.estadisticas.graficasiniciales")
               ->with("anio",$anio)
               ->with("mes",$mes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {



    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
