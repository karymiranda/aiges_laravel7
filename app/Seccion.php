<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Seccion extends Model
{
    protected $table = 'tb_secciones';
    protected $fillable= ['id','seccion','descripcion','codigo','cupo_maximo','aula_ubicacion','turno_id','grado_id','empleado_id','anio','seccionintegrada','estado'];

	  public function notas()
    {
      return $this->hasMany('App\Notas');
    }

 public function notascompetenciasciudadanas()
    {
      return $this->hasMany('App\Notascompetenciasciudadanas');
    }
	
 public function seccion_horario()
    {
        return $this->hasMany('App\HorarioClases');
    }
 public function seccion_turno()
{
	return $this->belongsTo('App\Turnos','turno_id');
}
 public function seccion_periodo()
{
    return $this->belongsTo('App\Periodoactivo','periodolectivo_id');
}

public function seccion_empleado(){
	return $this->belongsTo('App\Empleado','empleado_id');
}

public function seccion_grado(){
	return $this->belongsTo('App\Grados','grado_id');
} 

public function seccion_asignatura()
    {
    return $this->belongsToMany('App\Asignaturas','tb_asignaturaxseccion','seccion_id','asignatura_id')->withTimestamps();
    }

public function seccion_estudiante()
    {
    return $this->belongsToMany('App\Expedienteestudiante','tb_matriculaestudiante','seccion_id','estudiante_id')->withPivot('id','f_fechamatricula','v_nuevoingresoSN','v_presentocertificadoSN','v_procesoenlineaSN','v_trasladoSN','v_centroescolarorigen','v_estadomatricula','estado','anio','modalidad','familiar_exp','familiar_nombre','matricula')->withTimestamps();
}
   public function seccionEstudiante(){
      return $this->belongsToMany(
        'App\Expedienteestudiante', 'tb_matriculaestudiante','seccion_id','estudiante_id'
      )->withTimestamps();
    }

 public function Seccion_evaluaciones()
    {
        return $this->hasMany('App\EvaluacionesPeriodo');
    }

//PRUEBAS SCOPE
public function scopeCuposMatricula($seccion)//query scope para sacar todas las secciones cuyo estado sea 1
{
    return $seccion->where('estado',1);
}

public function scopeSeccionesactivas($secciones)
{
    return $secciones = Seccion::select(\DB::raw('CONCAT(tb_grados.grado, " ", tb_secciones.seccion) AS grado'), 'tb_secciones.id')
            ->join('tb_grados', 'tb_grados.id', '=', 'tb_secciones.grado_id')
            ->where('tb_secciones.estado','=','1')->pluck('grado','id');
}

public function scopeSeccionesporanioleectivo($secciones,$periodo_id)
{
    $anio=Periodoactivo::find($periodo_id);
    return $secciones = Seccion::select(\DB::raw('CONCAT(tb_grados.grado, " ", tb_secciones.seccion) AS grado'), 'tb_secciones.id')
            ->join('tb_grados', 'tb_grados.id', '=', 'tb_secciones.grado_id')
            ->where('tb_secciones.anio','=',$anio->anio)->get();
}

public function scopeSeccion($seccion,$idgrado)//query scope para recuperar datos de una seccion especifica, el parametro $idseccion me lo envian desde el controlador
{
    return $seccion->where([['grado_id',$idseccion],['estado',1]]);
}
 
 public function scopeCupos($listasecciones,$anio,$gradoid)//cuando quiera llamar esta funcion lo debo hacer con el nomnre ->cupos($anio,$gradoid)
 {
    return $listasecciones=Seccion::withCount([
    'seccion_estudiante', 
    'seccion_estudiante as cuposocupados' => function ($query) use ($anio){
    $query->where([['tb_matriculaestudiante.anio','=',$anio],['tb_matriculaestudiante.estado','=','1'],['tb_matriculaestudiante.v_estadomatricula','like','aprobada']]);
    }])->where('estado','=','1')->where('grado_id','=',$gradoid);
 }

public function scopeMatriculainicialfemenino($grado_id)
{
  
}
public function scopeMatriculainicialmasculino($grado_id)
{
    # code...
}

 public function studentsIds()
    {
        return $this->belongsToMany('App\Expedienteestudiante','tb_matriculaestudiante','seccion_id','estudiante_id')->select('tb_expedienteestudiante.id');
    }


protected function secciones_docente_horario() //saca las secciones qu pertenecen al docente logeado y en las que imparte alguna materia
        { 
        $hoy = Carbon::now();
        $hoyg = $hoy->format('Y-m-d');
        $anio = $hoy->year; 
 
            $secciones = Seccion::select(\DB::raw('CONCAT(tb_grados.grado, " ", tb_secciones.seccion) AS grado'), 'tb_secciones.id')
            ->join('tb_grados', 'tb_grados.id', '=', 'tb_secciones.grado_id')
            ->join('tb_horario_clases', 'tb_horario_clases.seccion_id', '=', 'tb_secciones.id')
            ->groupBy('tb_secciones.id')
            ->where('tb_horario_clases.estado','=',1)
            ->where('tb_secciones.estado','=',1)
            ->where('tb_horario_clases.docente_id','=',Auth::user()->empleado->id)->get();
            return $secciones; 
        }




 //PROBANDO ACCESSORS
 public function getSeccionFullAttribute()//cuando quiera utilizar esta funcion debo invocarla con elnombre ->seccion_full
 {
return $this->seccion." - ".($this->cupo_maximo-$this->cuposocupados).' Cupos disponibles';//toma el campo seccion delmodelo Seccion 
 }



}
