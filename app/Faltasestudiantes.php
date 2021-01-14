<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faltasestudiantes extends Model
{
    protected $table='tb_faltas';
    protected $fillable=['estudiante_id','fecha','tipo_falta','descripcion_falta','sanciones_aplicadas'];

  
 public function falta_estudiante()
    {
    	return $this->hasMany('App\Expedienteestudiante','estudiante_id');
	}



}
