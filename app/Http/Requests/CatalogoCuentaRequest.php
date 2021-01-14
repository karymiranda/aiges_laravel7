<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CatalogoCuentaRequest extends FormRequest
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
            'v_nombrecuenta' => 'min:3|max:50',
            'v_sup' => 'required',
            'v_codigocuenta' => 'numeric|unique:tb_catalogodecuentas,v_codigocuenta,'.$this->id
        ];
    }

    public function messages()
    {
        return [
            'v_nombrecuenta.max' =>'El nombre no puede ser mayor a :max caracteres.',
            'v_nombrecuenta.min' => 'El nombre no puede ser menor a :min caracteres.',
            'v_sup.required' => 'La cuenta superior es requerida.',
            'v_codigocuenta.numeric' =>'Debe completar el código correctamente.',
            'v_codigocuenta.unique' => 'El código ya fue asignado a otra cuenta.'
        ];
    }
}
