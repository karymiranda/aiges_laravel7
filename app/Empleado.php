<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $table = "tb_empleado";

    protected $fillable = ['v_nombres', 'v_apellidos', 'f_fechanaci','v_genero', 'v_direccioncasa', 'v_dui', 'v_nit', 'v_telcasa', 'v_celular', 'f_fechaingresoalCE', 'v_tipocontratacion', 'tipopersonal_id', 'v_tituloacademico', 'cargo_id', 'd_sueldo', 'especialidad_id', 'v_nip', 'v_nup', 'f_fechaingresoministerio', 'v_nivelescalafon', 'v_categoriaescalafon','v_correo','v_numeroexp','estado'];

   
    public function empleado_estudio()
    {
        return $this->hasMany('App\Estudiosrrhh','empleado_id');
    }

    public function tipoPersonal()
    {
    	return $this->belongsTo('App\TipoPersonal','tipopersonal_id');
	}

	public function cargo()
    {
    	return $this->belongsTo('App\Cargo');
	}

	public function especialidad()
    {
    	return $this->belongsTo('App\Especialidad'); 
	}

    public function usuarios()
    {
        return $this->hasMany('App\Usuario','personal_id');
    }

    public function permisos()
    {
        return $this->hasMany('App\Permiso','solicitante_id');
    }

    public function asistencias()
    {
        return $this->hasMany('App\AsistenciasRH','expedientepersonal_id');
    }

    public function horarios()
    {
        return $this->hasMany('App\HorariosEmpleado','empleado_id');
    }
    public function docente_horario()
    {
        return $this->hasMany('App\HorarioClases');
    }
    public function empleado_seccion()
    {
        return $this->hasMany(\App\Seccion::class);
    }

}
