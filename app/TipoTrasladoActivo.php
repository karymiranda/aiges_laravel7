<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoTrasladoActivo extends Model
{
    protected $table = "tb_tipotrasladoactivofijo";

    protected $fillable = ['v_descripcion'];

    public function traslados()
    {
    	return $this->hasMany('App\TrasladosActivo');
	}
}
