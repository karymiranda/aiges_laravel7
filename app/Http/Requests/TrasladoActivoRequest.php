<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TrasladoActivoRequest extends FormRequest
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
            'destino_id' => 'required',
            'activo_id' => 'required',
            'procedencia_id' => 'required',
            'f_fechatraslado' => 'required',
            'tipotraslado_id' => 'required',
            'v_personaautoriza' => 'required|min:3|max:100',
            'v_personarecibe' => 'required|min:3|max:100',
            'v_observaciones' => 'max:150'
        ];
    }

    public function messages()
    {
        return [
            'v_personaautoriza.max' =>'La persona que autoriza no puede ser mayor a :max caracteres.',
            'v_personarecibe.max' =>'La persona que recibe no puede ser mayor a :max caracteres.',
            'v_personaautoriza.min' =>'La persona que autoriza no puede ser menor a :min caracteres.',
            'v_personarecibe.min' =>'La persona que recibe no puede ser menor a :min caracteres.',
            'v_personaautoriza.required' =>'La persona que autoriza es requerida.',
            'v_personarecibe.required' =>'La persona que recibe es requerida.',
            'destino_id.required' =>'El destino es requerido.',
            'activo_id.required' =>'El activo fijo es requerido.',
            'procedencia_id.required' =>'El origen es requerido.',
            'f_fechatraslado.required' =>'La fecha de traslado es requerida.',
            'tipotraslado_id.required' =>'El motivo de traslado es requerido.',
            'v_observaciones.max' =>'Las observaciones no pueden ser mayores a :max caracteres.'
        ];
    }

}
