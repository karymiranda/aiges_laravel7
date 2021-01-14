<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EvaluacionesPeriodo extends Model
{
    protected $table='tb_evaluacionesperiodo';
    protected $fillable=['id','codigo_eval','nombre','d_porcentajeActividad'];

   
	public function calificaciones_estudiante()
    {
    return $this->belongsToMany('App\Expedienteestudiante','tb_califestudiantebasica','evaluacionperiodo_id','estudiante_id')->withPivot('id','d_nota','asignatura_id','seccion_id','d_notaporcentaje','anio')->withTimestamps();
    }

	/* public function scopeCorrelativo($idperiodo,$idseccion,$idasignatura)//cuando quiera llamar esta funcion lo debo hacer con el nomnre ->correlativo($idperiodo,$idseccion,$idasignatura)
 {
    return $listasecciones=Seccion::withCount([
    'seccion_estudiante', 
    'seccion_estudiante as cuposocupados' => function ($query) use ($anio){
    $query->where([['tb_matriculaestudiante.anio','=',$anio],['tb_matriculaestudiante.estado','=','1'],['tb_matriculaestudiante.v_estadomatricula','like','aprobada']]);
    }])->where('estado','=','1')->where('grado_id','=',$gradoid);
 }
*/

}
