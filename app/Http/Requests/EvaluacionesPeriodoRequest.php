<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EvaluacionesPeriodoRequest extends FormRequest
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
            'codigo_eval' => 'min:2|max:8|required',
            'nombre' => 'min:4|max:50|required'
        ];
    }
      public function messages()
    {
        return [
'codigo_eval.min' => 'El código de la evaluación no puede ser menor a :min caracteres.',
'codigo_eval.max' => 'El código de la evaluación no puede ser mayor a :max caracteres.',
'nombre.min' => 'El nombre de la evaluación no puede ser menor a :min caracteres.',
'nombre.max' => 'El  nombre de la evaluación no puede ser mayor a :max caracteres.'
        ];
    }
}
