<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InstitucionesRequest extends FormRequest
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
            'codigo_institucion' => 'max:50|nullable',
            'nombre_institucion' => 'min:3|max:150|required',
            'descripcion_institucion' => 'max:150|nullable',
            'telefono' => 'size:9|required',
            'direccion' => 'min:10|max:150|required',
            'correo' => 'email|nullable|unique:tb_institucion_destinoactivo,correo,'.$this->id,
            'representante' => 'min:3|max:150|required'
        ];
    }

    public function messages()
    {
        return [
            'nombre_institucion.max' =>'El nombre no puede ser mayor a :max caracteres.',
            'nombre_institucion.min' => 'El nombre no puede ser menor a :min caracteres.',
            'descripcion_institucion.max' =>'La descripción no puede ser mayor a :max caracteres.',
            'nombre_institucion.required' => 'El nombre es requerido.',
            'codigo_institucion.max' =>'El código no puede ser mayor a :max caracteres.',
            'telefono.size' =>'El número de teléfono debe contener 9 caracteres.',
            'telefono.required' =>'El número de teléfono es requerido.',
            'direccion.min' => 'La dirección no puede ser menor a :min caracteres.',
            'direccion.max' => 'La dirección no puede ser mayor a :max caracteres.',
            'direccion.required' => 'La dirección es requerida.',
            'correo.email' => 'La dirección de correo no es valida.',
            'correo.unique' => 'La dirección de correo ya fue asignada a otra institución.',
            'representante.required' => 'El representante es requerido.',
            'representante.min' => 'El representante no puede ser menor a :min caracteres.',
            'representante.max' => 'El representante no puede ser mayor a :max caracteres.'
        ];
    }

}
