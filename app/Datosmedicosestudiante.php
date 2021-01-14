<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Datosmedicosestudiante extends Model
{
    protected $table='tb_estudiante_datosmedicos';
    protected $fillable=['tarjeta_vacuna','expedienteestudiante_id','tipo_sanguineo','vacuna_completa','horario_sueno_noche','horario_sueno_dia','dificul_dormir','duerme_con','tomo_pecho','tiempo_lactancia','tiene_dificultad_comer','alimentos_consume','canti_refrigerios','desayuna','almuerza','cena','esalergicoSN','alergicoa','prescripcionmedicaSN','detallereceta','discapacidades'];

    public function datosmedicos_estudiante()
    {
    	return $this->belongsTo('App\Expedienteestudiante','expedienteestudiante_id');
    }
}
