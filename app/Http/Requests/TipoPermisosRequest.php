<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TipoPermisosRequest extends FormRequest
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
           'v_descripcion' => 'min:3|max:50|required',
           'i_duracionmax' => 'integer|between:1,365|required',
           'i_maxpermisosanual' => 'integer|gt:0|required'
        ];
    }

    public function messages()
    {
        return [
            'v_descripcion.required' => 'Agrega el nombre del tipo de permiso.',
            'v_descripcion.max' =>'El nombre del tipo de permiso no puede ser mayor a :max caracteres.',
            'v_descripcion.min' => 'El nombre del tipo de permiso no puede ser menor a :min caracteres.',
            'i_duracionmax.integer' => 'La duración máxima debe ser un número entero.',
            'i_duracionmax.between' => 'La duración máxima debe ser mayor a 0 y menor a 365 días.',
            'i_duracionmax.required' => 'La duración máxima es requerida.',
            'i_maxpermisosanual.integer' => 'El máximo de permisos anuales debe ser un número entero.',
            'i_maxpermisosanual.gt' => 'El máximo de permisos anuales debe ser mayor a 0.',
            'i_maxpermisosanual.required' => 'El máximo de permisos anuales es requerida.'
        ];
    }
}
