<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RetornosActivo extends Model
{
    protected $table = "tb_retornoactivo";

    protected $fillable = ['fecha', 'traslado_id', 'persona_autoriza', 'persona_recibe', 'observaciones'];

    public function traslado()
    {
    	return $this->belongsTo('App\TrasladosActivo','traslado_id');
	}

}
