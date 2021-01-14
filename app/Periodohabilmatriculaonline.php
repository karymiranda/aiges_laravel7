<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Periodohabilmatriculaonline extends Model
{
    protected $table='tb_periodohabilmatriculaonline';
    protected $fillable=['v_descripcion','f_fechadesde','f_fechahasta','centroescolar_id','anio','estado','tipo_periodo'];
public function periodomatriculaonline()
    {
	return $this->belongsTo('App\InfoCentroEducativo','centroescolar_id');
    }
}


