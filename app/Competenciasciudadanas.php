<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Competenciasciudadanas extends Model
{
    protected $table = "tb_competenciasciudadanas";
    protected $fillable = ['id','codigo','competencia','estado'];

     public function competencia_notacompetencia()
    {
      return $this->hasMany('App\Notascompetenciasciudadanas');
    }
}
