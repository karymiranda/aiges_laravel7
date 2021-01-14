<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SeccionRequest extends FormRequest
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
             'seccion' => 'min:1|max:50|required',
             'descripcion' => 'min:5|string|max:50|required',
             'cupo_maximo' => 'integer|between:1,999',
             'aula_ubicacion' => 'min:5|max:50|required',
            'codigo' => 'min:3|max:50'
        ];
    }

     public function messages()
    {
        return [
            'seccion.min' => 'Sección debe contener más de :min caracteres',
            'seccion.max' => 'Sección debe contener menos de :max caracteres',
            'seccion.required' => 'El campo sección es obligatorio',
            'descripcion.min' => 'Descripción debe contener más de :min caracteres',
            'descripcion.max' => 'Descripción debe contener menos de :max caracteres',
            'descripcion.required' => 'El campo descripción es obligatorio',
            'cupo_maximo.integer' => 'El cupo máximo debe ser un número entero',
            'cupo_maximo.between' => 'El cupo máximo debe ser un número entre 1 y 999',
            'aula_ubicacion.min' => 'Ubicación del aula debe contener más de :min caracteres',
            'aula_ubicacion.max' => 'Ubicación del aula debe contener menos de :max caracteres',
            'codigo.min' => 'Código debe contener más de :min caracteres',
            'codigo.max' => 'Código debe contener menos de :max caracteres'
            ];
    }
}
