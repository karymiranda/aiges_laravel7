<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CuadroFinalNota extends Model
{
    public $timestamps = false;
    public $fillable = ["id","cuadro_final_id", "alumno_id", "lenguaje", "matematica", "ciencia", "sociales", "ingles", "artistica", "fisica", "urbanida","estado"];

    public function cuadroFinal()
    {
        return $this->belongsTo('App\CuadroFinal');
    }

    public function alumno(){
        return $this->belongsTo('App\Expedienteestudiante', 'alumno_id');
    }
}
