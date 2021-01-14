<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cargo extends Model
{
    protected $table = "tb_cargoempleados";

    protected $fillable = ['v_descripcion', 'estado', 'created_at', 'updated_at'];

    public function empleados()
    {
    	return $this->hasMany('App\Empleado');
	}
}
