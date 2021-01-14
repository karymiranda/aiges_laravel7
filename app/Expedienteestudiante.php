<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expedienteestudiante extends Model
{
    protected $table='tb_expedienteestudiante';
    protected $fillable=['v_expediente','v_nie','v_nombres','v_apellidos','v_genero','f_fnacimiento','v_direccion','v_correo','v_telCasa','v_telCelular','i_catFamiliares','v_viveCon','v_dependeDe','presentopartidaSN','sacramentos','f_fechaIngresoCE','estado','deshabilitadofecha','deshabilitadomotivo','deshabilitadoobservaciones','municipio_id','v_nivelingreso','v_cicloingreso','v_modalidadeducativaingreso','v_modalidadatencioningreso','v_gradoingreso','v_observacionesingreso'];


   public function alumno_itemcompetencia()
    {
        return $this->hasMany("App\Notasitemcompetenciasciudadanas");
    } 

    public function municipio()
    {
    return $this->belongsTo('App\Municipios','municipio_id');
    } 
    public function estudiante_usuario()
    {
        return $this->hasMany('App\Usuario','estudiante_id');
    }

   public function estudiante_datosmedicos()
    {
        return $this->hasMany('App\Datosmedicosestudiante');
    }


public function estudiante_familiares()
    {
    return $this->belongsToMany('App\Familiares','tb_estudiante_familiar','estudiante_id','familiar_id')->withPivot('parentesco','encargado','autorizacion')->withTimestamps();
}

  public function getFullName()
    {
        return "{$this->v_apellidos} {$this->v_nombres}";
    }

public function estudiante_seccion()
    {
 return $this->belongsToMany('App\Seccion','tb_matriculaestudiante','estudiante_id','seccion_id')->withPivot('id','f_fechamatricula','v_nuevoingresoSN','v_presentocertificadoSN','v_procesoenlineaSN','v_trasladoSN','v_centroescolarorigen','v_estadomatricula','estado','anio','modalidad','familiar_exp','familiar_nombre','matricula')->withTimestamps();
}

public function estudiante_calificaciones()
    {
   return $this->belongsToMany('App\Expedienteestudiante','tb_califestudiantebasica','evaluacionperiodo_id','estudiante_id')->withPivot('id','d_nota','asignatura_id','seccion_id','d_notaporcentaje','anio')->withTimestamps();
}


public function estudiante_asistencias()
    {
        return $this->hasMany('App\AsistenciasEstudiantes','expedienteestudiante_id');
    }

public function estudiante_cuadrofinal()
{
    return $this->hasMany('App\CuadroFinalNota','alumno_id');
}

     public function estudiante_falta()
{
    return $this->belongsTo('App\Faltasestudiantes','estudiante_id');
}


}
