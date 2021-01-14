<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DescargosActivoRequest extends FormRequest
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
            'f_fechadescargo' => 'required',
            'tipodescargo_id' => 'required',
            'activofijo_id' => 'required',
            'v_observaciones' => 'max:150'
        ];
    }

    public function messages()
    {
        return [
            'f_fechadescargo.required' => 'La fecha de descargo es requerida.',
            'v_observaciones.max' =>'Las observaciones no pueden ser mayores a :max caracteres.',
            'tipodescargo_id.required' => 'El motivo de descargo es requerido.',
            'activofijo_id.required' => 'El id de activo es requerido.'
        ];
    }
}
