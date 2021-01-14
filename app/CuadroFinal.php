<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CuadroFinal extends Model
{
  protected $table = 'cuadro_final';
  public $fillable = ["id","seccion_id", "asignatura_id"];

  public function items()
  {
    return $this->hasMany('App\CuadroFinalNota');
  }
}
