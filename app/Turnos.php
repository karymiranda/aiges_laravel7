<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Turnos extends Model
{
    protected $table='tb_turnos';
    protected $fillable=['turno','horadesde','horahasta','estado'];

  public function turno_secciones()
    {
    	return $this->hasMany('App\Seccion');
	}

}
