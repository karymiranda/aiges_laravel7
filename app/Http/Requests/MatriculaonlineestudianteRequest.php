<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MatriculaonlineestudianteRequest extends FormRequest
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
            'f_fechamatricula'=>'required',
            'v_expediente'=>'required',
            'turno_id'=>'required'
            
        ];
    }
    public function messages()
    {
        return[

        'f_fechamatricula.required'=>'Seleccione una fecha de matrícula',  
        'v_expediente.required'=>'Debe ser un estudiante para iniciar el proceso de matrícula',
        'turno_id.required'=>'Debe seleccionar una sección para completar la solicitud'
        ];
    }
}
