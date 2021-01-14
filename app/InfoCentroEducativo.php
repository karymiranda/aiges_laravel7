<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InfoCentroEducativo extends Model
{
    protected $table = "tb_infocentroeducativo";

    protected $fillable = ['v_nombrecentro', 'v_codigoinfraestructura', 'v_zona', 'municipio_id', 'v_direccion', 'v_telefono', 'correo_electronico', 'nombre_director_ar', 'v_distrito', 'f_fechafundacion'];

    public function traslados()
    {
    	return $this->hasMany('App\TrasladosActivo');
	}
	public function periodoinscripcionenlinea()
    {
    	return $this->hasMany('App\Periodohabilmatriculaonline');
	}

    public function ce_municipio()
    {
        return $this->belongsTo('App\Municipios','municipio_id');
    }
}
