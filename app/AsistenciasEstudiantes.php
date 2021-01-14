<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AsistenciasEstudiantes extends Model
{
    protected $table = "tb_asistenciaestudiantes";

    protected $fillable = ['expedienteestudiante_id', 'f_fecha', 'v_asistenciaSN','v_pidiopermisoSN','año','justificacion','observacion'];

    public function estudiante()
    {
    	return $this->belongsTo('App\Expedienteestudiante','expedienteestudiante_id');
	}

	public function scopeAsistenciaestudiantes($asistencia,$desde,$hasta)
 {

     
     return $asistencia;
 }

}
