<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Expedienteestudiante;
use App\Periodoactivo;
use App\Seccion;

class EstadisticasController extends Controller
{
	public function index()
	{
		return view('admin.estadisticas.listadoestadisticas');
	}
    public function matriculadosGrado()
	{	
		$anios = Periodoactivo::orderBy('anio')->pluck('anio','anio');
		$anio=$this->anio();
		
		$secciones = Seccion::select(\DB::raw('CONCAT(tb_grados.grado, " ", tb_secciones.seccion) AS grado'))
            ->join('tb_grados', 'tb_grados.id', '=', 'tb_secciones.grado_id')
            ->where([['tb_secciones.estado','=','1'],['tb_secciones.anio','=',$anio]])
            ->withCount(['seccion_estudiante',
			    'seccion_estudiante as femenino' => function ($query) use ($anio){
			        $query->where([['tb_matriculaestudiante.anio',$anio],['tb_matriculaestudiante.v_estadomatricula','like','aprobada'],['tb_matriculaestudiante.estado','=','1'],['v_genero','like','Femenino']]);
			    }
			])
            ->withCount(['seccion_estudiante',
			    'seccion_estudiante as masculino' => function ($query) use ($anio){
			        $query->where([['tb_matriculaestudiante.anio',$anio],['v_genero','like','Masculino'],['tb_matriculaestudiante.v_estadomatricula','like','aprobada'],['tb_matriculaestudiante.estado','=','1']]);
			    }
			])
			->get();

		return view('admin.estadisticas.matriculadosGrado')->with('anios',$anios)->with('anio',$anio)->with('secciones',$secciones);
	}

	public function buscarMatriculadosGrado(Request $request)
	{	

		$añoSeleccionado = $request->get('año');
		$secciones = Seccion::select(\DB::raw('CONCAT(tb_grados.grado, " ", tb_secciones.seccion) AS grado'))
            ->join('tb_grados', 'tb_grados.id', '=', 'tb_secciones.grado_id')
            ->where([['tb_secciones.estado','=','1'],['tb_secciones.anio','=',$añoSeleccionado]])
            ->withCount(['seccion_estudiante',
			    'seccion_estudiante as femenino' => function ($query) use ($añoSeleccionado){
			        $query->where([['tb_matriculaestudiante.anio',$añoSeleccionado],['v_genero','like','Femenino'],['tb_matriculaestudiante.v_estadomatricula','like','aprobada']]);
			    }
			])
            ->withCount(['seccion_estudiante',
			    'seccion_estudiante as masculino' => function ($query) use ($añoSeleccionado){
			        $query->where([['tb_matriculaestudiante.anio',$añoSeleccionado],['v_genero','like','Masculino'],['tb_matriculaestudiante.v_estadomatricula','like','aprobada']]);
			    }
			])
			->get();
		return $secciones;
	}

	public function matriculadosAño()
	{	
		return view('admin.estadisticas.matriculadosAño');
	}

	public function buscarMatriculadosAño(Request $request)
	{	

		$añoISeleccionado = (int)$request->get('añoI');
		$añoFSeleccionado = (int)$request->get('añoF');
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
		return $datos;
	}

	protected function anio(){
		$periodoescolaractivo=Periodoactivo::orderBy('id','ASC')->where([['estado','=','1'],['tipo_periodo','like','ACADEMICO']])->first();
		$anio=$periodoescolaractivo->anio;
		
        return $anio;
    }
}
