<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MatriculaRequest extends FormRequest
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
            'fecha'=>'required',
            'expediente'=>'required',
            'turno'=>'required',
            'familiar_exp'=>'required',
            'txtcentroorigen'=>'min:5|max:150|string|nullable',
            'txtobservaciones'=>'min:5|max:150|string|nullable'
        ];
    }
    public function messages()
    {
        return[

        'fecha.required'=>'Seleccione una fecha de matrícula',  
        'expediente.required'=>'Debe seleccionar un estudiante para iniciar el proceso de matrícula',
        'turno.required'=>'Debe seleccionar una sección',
        'familiar_exp.required'=>'Debe seleccionar un responsable de matrícula',
        'txtcentroorigen.min'=>'El nombre de la institución de donde proviene el estudiante debe contener más de :min caracteres',
        'txtcentroorigen.max'=>'El nombre de la institución de donde proviene el estudiante debe contener menos de :max caracteres',
         'txtobservaciones.min'=>'Observaciones del proceso de traslado debe contener más de :min caracteres',
        'txtobservaciones.max'=>'Observaciones del proceso de traslado debe contener menos de :max caracteres'
        ];
    }
}
