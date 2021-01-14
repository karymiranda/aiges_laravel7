<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ActivoFijoRequest extends FormRequest
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
            'v_nombre' => 'required|max:150',
            'v_codigoactivo' => 'required|unique:tb_activofijo,v_codigoactivo,'.$this->id,
            'v_serie' => 'max:100',
            'v_modelo' => 'max:100',
            'v_marca' => 'required|max:100',
            'v_ubicacion' => 'required|max:150',
            'v_medida' => 'max:50',
            'v_vidautil' => 'numeric|nullable',
            'v_materialdeconstruccion' => 'max:50',
            'v_condicionactivo' => 'required|max:50',
            'v_observaciones' => 'max:150',
            'd_valor' => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'v_nombre.max' =>'La descripción no puede ser mayor a :max caracteres.',
            'v_serie.max' =>'La serie no puede ser mayor a :max caracteres.',
            'v_vidautil.numeric' =>'La vida útil debe ser un número entero.',
            'v_marca.max' =>'La marca no puede ser mayor a :max caracteres.',
            'v_ubicacion.max' =>'La ubicación no puede ser mayor a :max caracteres.',
            'v_medida.max' =>'La medida no puede ser mayor a :max caracteres.',
            'v_materialdeconstruccion.max' =>'El material de construcción no puede ser mayor a :max caracteres.',
            'v_condicionactivo.max' =>'La condición del activo no puede ser mayor a :max caracteres.',
            'v_observaciones.max' =>'Las observaciones no pueden ser mayores a :max caracteres.',
            'v_modelo.max' =>'El modelo no puede ser mayor a :max caracteres.',
            'v_valor.numeric' => 'El valor del activo no es una cantidad.'
        ];
    }
}
