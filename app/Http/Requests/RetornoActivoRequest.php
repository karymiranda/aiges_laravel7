<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RetornoActivoRequest extends FormRequest
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
            'traslado_id' => 'required',
            'f_fechatraslado' => 'required|before_or_equal:fecha',
            'fecha' => 'required',
            'persona_autoriza' => 'required|min:3|max:150',
            'persona_recibe' => 'required|min:3|max:150',
            'observaciones' => 'max:150'
        ];
    }
    public function messages()
    {
        return [
            'persona_autoriza.max' =>'La persona que autoriza no puede ser mayor a :max caracteres.',
            'persona_recibe.max' =>'La persona que recibe no puede ser mayor a :max caracteres.',
            'persona_autoriza.min' =>'La persona que autoriza no puede ser menor a :min caracteres.',
            'persona_recibe.min' =>'La persona que recibe no puede ser menor a :min caracteres.',
            'persona_autoriza.required' =>'La persona que autoriza es requerida.',
            'persona_recibe.required' =>'La persona que recibe es requerida.',
            'traslado_id.required' =>'El traslado es requerido.',
            'f_fechatraslado.required' =>'La fecha de traslado es requerida.',
            'fecha.required' =>'La fecha de retorno es requerida.',
            'f_fechatraslado.before_or_equal' =>'La fecha de retorno debe ser posterior a la fecha de traslado.',
            'observaciones.max' =>'Las observaciones no pueden ser mayores a :max caracteres.'
        ];
    }

}
