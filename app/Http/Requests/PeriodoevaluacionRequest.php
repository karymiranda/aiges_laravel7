<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PeriodoevaluacionRequest extends FormRequest
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
         'nombre'=>'min:2|max:50|string|required',
         'descripcion'=>'min:3|max:75|string|required'
        ];
    }
     public function messages()
    {
        return[
        'nombre.required'=>'Nombre del período es requerido',
        'nombre.min' => 'Nombre del período no puede ser menor a :min caracteres',
        'nombre.max' => 'Nombre del período no puede ser mayor a :max caracteres',
        'descripcion.required'=>'Descripción de ciclo es requerido',
        'descripcion.min' => 'Descripción de ciclo no puede ser menor a :min caracteres',
        'descripcion.max' => 'Descripción de ciclo no puede ser mayor a :max caracteres'
         ];
    }
}
