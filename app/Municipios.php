<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Municipios extends Model
{
 protected $table='tb_municipios';
    protected $fillable=['v_municipio','departamento_id','estado'];


 public function departamentos()
    {
    	return $this->belongsTo('App\Departamentos','departamento_id');
    }
    public function municipio_estudiante()
    {
    return $this->hasMany('App\Expedienteestudiante');
	}
	public function municipio_ce()
    {
    return $this->hasMany('App\InfoCentroEducativo');
	}


}
