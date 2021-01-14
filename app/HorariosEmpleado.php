<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HorariosEmpleado extends Model
{
    protected $table = "tb_horario_personal";

    protected $fillable = ['empleado_id', 'dia', 'entrada1','salida1', 'entrada2','salida2'];

    public function empleado()
    {
    	return $this->belongsTo('App\Empleado');
	}

}
