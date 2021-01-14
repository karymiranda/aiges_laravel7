<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asignaturas extends Model
{
    protected $table = "tb_asignaturas";
    protected $fillable = ['id','asignatura','descripcion','tercerciclo','estado','name_short','is_cuadro','orden'];
/*
    public function asignatura_seccion()
    {
    return $this->belongsToMany('App\Seccion','tb_horario_asignatura','asignatura_id','seccion_id')->withPivot('dia','horainicio','horafin','anio','estado')->withTimestamps();
	}
*/

    public function Asignaturas_evaluaciones()
    {
        return $this->hasMany('App\EvaluacionesPeriodo');
    }

 	public function asignatura_docente()
    {
     return $this->belongsToMany('App\Empleado','tb_maestro_materia','asignatura_id','empleado_id')->withTimestamps();
      }

       public function asignatura_horario()
    {
        return $this->hasMany('App\HorarioClases');
    }
    public function asignaturaimpartidaporseccion()
    {
        return $this->belongsToMany('App\Seccion','tb_asignaturaxseccion','asignatura_id','seccion_id')->withTimestamps();
    }

}
