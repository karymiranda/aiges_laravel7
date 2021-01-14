<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EspecialidadRequest extends FormRequest
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
            'v_especialidad' => 'min:3|max:50|required'
        ];
    }

    public function messages()
    {
        return [
            'v_especialidad.required' => 'Agrega el nombre de la especialidad.',
            'v_especialidad.max' =>'El nombre de la especialidad no puede ser mayor a :max caracteres.',
            'v_especialidad.min' => 'El nombre de la especialidad no puede ser menor a :min caracteres.'
        ];
    }
}
