<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DescargosActivo extends Model
{
    protected $table = "tb_descargoactivo";

    protected $fillable = ['f_fechadescargo', 'v_observaciones', 'tipodescargo_id','activofijo_id'];

    public function activofijo()
    {
    	return $this->belongsTo('App\ActivoFijo','activofijo_id');
	}

	public function tipodescargo()
    {
    	return $this->belongsTo('App\TipoDescargoActivo','tipodescargo_id');
	}
}
