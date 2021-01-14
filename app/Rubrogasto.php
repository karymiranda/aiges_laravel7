<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rubrogasto extends Model
{
    protected $table = 'tb_rubrogasto';
    protected $fillable= ['id','descripcion','estado'];

    public function rubro_transacciones()
    {
    	return $this->hasMany('App\Trasaccionesbono');
	}
}
