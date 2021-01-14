<?php

namespace App\Http\Requests; 

use Illuminate\Foundation\Http\FormRequest;

class ExpedienteEstudianteDatosPersonalesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
      public function rules()
    {
        return [            
            'v_nie'=>'numeric|nullable|integer|digits_between:7,8|unique:tb_expedienteestudiante,v_nie,'.$this->id,
             'v_nombres'=>'min:3|max:50|regex:/^[\pL\s\-]+$/u|required',
             'v_apellidos'=>'min:3|max:50|regex:/^[\pL\s\-]+$/u|required',
            'f_fnacimiento'=>'required',
            'v_direccion'=>'min:3|max:100|string|required',
            'txtedad'=>'integer|gt:1|required',
            'v_correo'=>'email|nullable|unique:tb_expedienteestudiante,v_correo,'.$this->id,
            'f_fechaIngresoCE'=>'nullable',
            'i_catFamiliares'=> 'integer|gt:1|nullable',
            'v_observacionesingreso'=>'min:3|max:100|string|nullable',
            'txtfoto' => 'nullable|image|mimes:jpeg,jpg,png',
            'municipio_id' => 'required'
        ];
    }

    public function messages()
    {
    return[
            'v_nombres.regex' => 'El nombre debe contener solo letras',
            'v_apellidos.regex' => 'El apellido debe contener solo letras',
             'v_nie.numeric' => 'El NIE no puede contener letras', 
             'v_nie.integer' => 'El NIE debe ser un número entero',            
            'v_nie.unique' =>'El NIE ha sido asignado a otro estudiante', 
            'v_nie.digits_between' => 'El NIE debe tener entre 7 y 8 digitos.',           
            'txtedad.gt' => 'El estudiante debe ser mayor a 1 año',
            'v_correo.email' => 'La dirección de correo electrónico es incorrecta',
            'v_correo.unique' => 'El correo electrónico ha sido asignado a otro estudiante',
            'i_catFamiliares.gt' => 'La cantidad de miembros del grupo familiar debe ser mayor a 0',
            'v_direccion.min' => 'La dirección no puede ser menor a :min caracteres',
            'v_direccion.max' => 'La dirección no puede ser mayor a :max caracteres',
            'v_observacionesingreso.min' => 'Observaciones no puede ser menor a :min caracteres',
            'v_observacionesingreso.max' => 'Observaciones no puede ser mayor a :max caracteres',
            'txtfoto.image' => 'Debe seleccionar una imagen.',
            'txtfoto.mimes' =>'El formato de imagenes permitidas es jpeg, jpg y png ',
            'municipio_id.required' =>'Seleccione un Muicipio'
            
    ];
    }
}
