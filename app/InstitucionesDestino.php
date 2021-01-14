<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InstitucionesDestino extends Model
{
    protected $table = "tb_institucion_destinoactivo";

    protected $fillable = ['codigo_institucion', 'nombre_institucion', 'descripcion_institucion', 'direccion', 'telefono', 'representante', 'correo', 'estado'];

    public function traslados()
    {
    	return $this->hasMany('App\TrasladosActivo');
	}

}
