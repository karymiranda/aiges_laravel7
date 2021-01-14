<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoDescargoActivo extends Model
{
    protected $table = "tb_tipodescargoactivofijo";

    protected $fillable = ['v_descripcion'];

    public function descargos()
    {
    	return $this->hasMany('App\DescargosActivo');
	}
}
