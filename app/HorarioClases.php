<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HorarioClases extends Model
{
    protected $table = "tb_horario_clases";
    protected $fillable = ['id','dia','asignatura_id','seccion_id','docente_id','bloque_id','anio','estado']; 

public function horario_asignatura()
    {
	return $this->belongsTo('App\Asignaturas','asignatura_id');
    }
    public function horario_seccion()
    {
	return $this->belongsTo('App\Seccion','seccion_id');
    }
    public function horario_docente()
    {
	return $this->belongsTo('App\Empleado','docente_id');
    }
    public function horario_bloque()
    {
	return $this->belongsTo('App\BloqueHorarios','bloque_id');
    }
}

