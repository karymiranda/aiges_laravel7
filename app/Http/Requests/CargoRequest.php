<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CargoRequest extends FormRequest
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
            'v_descripcion' => 'min:3|max:50|required'
        ];
    }

    public function messages()
    {
        return [
            'v_descripcion.required' => 'Agrega el nombre del cargo.',
            'v_descripcion.max' =>'El nombre del cargo no puede ser mayor a :max caracteres.',
            'v_descripcion.min' => 'El nombre del cargo no puede ser menor a :min caracteres.'
        ];
    }
}
