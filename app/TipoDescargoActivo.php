<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoDescargoActivo extends Model
{
    protected $table = "tb_tipodescargoactivofijo";

    protected $fillable = ['v_descripcion'];

    //relacion muchos a muchos
    public function descargos()
    {
    	//return $this->hasMany('App\DescargosActivo');
        return $this->belongsToMany(DescargosActivo::class);
	}

}
