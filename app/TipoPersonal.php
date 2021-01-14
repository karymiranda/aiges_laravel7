<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoPersonal extends Model
{
    protected $table = "tb_tipopersonal";

    protected $fillable = ['v_tipopersonal', 'created_at', 'updated_at', 'estado'];

    public function empleados()
    {
    	return $this->hasMany('App\Empleado');
	}
}
