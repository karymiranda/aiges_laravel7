<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
    protected $table = "tb_especialidaddocente";

    protected $fillable = ['v_especialidad', 'created_at', 'updated_at', 'estado'];

    public function empleados()
    {
    	return $this->hasMany('App\Empleado');
	}
}
