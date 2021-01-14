<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notascompetenciasciudadanas extends Model
{
     protected $table='nota_competenciaciudadana';

    public function seccion()
    {
        return $this->belongsTo('App\Seccion');
    }

    public function competenciasciudadana()
    {
        return $this->belongsTo('App\Competenciasciudadanas')->orderBy('asignatura', 'asc');
    }

    public function periodo()
    {
        return $this->belongsTo('App\Periodoevaluacion');
    }

     public function notasitemcompetenciaciudadana()
    {
        return $this->hasMany("App\Notasitemcompetenciasciudadanas");
    }
}
