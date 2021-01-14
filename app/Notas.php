<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notas extends Model
{
    public function seccion()
    {
        return $this->belongsTo('App\Seccion');
    }

    public function asignatura()
    {
        return $this->belongsTo('App\Asignaturas')->orderBy('asignatura', 'asc');
    }

    public function periodo()
    {
        return $this->belongsTo('App\Periodoevaluacion');
    }

    public function evaluacion ()
    {
        return $this->belongsTo('App\EvaluacionesPeriodo');
    }

    public function notas()
    {
        return $this->hasMany("App\NotasItems");
    }
}
