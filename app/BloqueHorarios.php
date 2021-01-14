<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BloqueHorarios extends Model
{
    protected $table = "tb_bloques_horarios";
    protected $fillable = ['correlativo_clase','hora_inicio','hora_fin','tipo_bloque','estado'];

public function bloque_horario()
    {
    	return $this->hasMany('App\HorarioClases');
    }
}
