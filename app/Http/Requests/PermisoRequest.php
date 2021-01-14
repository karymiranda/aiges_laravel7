<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PermisoRequest extends FormRequest
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
            'f_fechasolicitud' => 'required',
            'expediente' => 'required',
            'nombre' => 'required',
            'motivo_id' => 'required',
            'i_tiemposolicitado' => 'required',
            'periodo' => 'required',
            'v_observaciones' => 'min:10|max:150|nullable'
        ];
    }

    public function messages()
    {
        return [
            'f_fechasolicitud.required' =>'La fecha de solicitud es requerida',
            'expediente.required' =>'El número de expediente es requerido',
            'nombre.required' =>'El nombre del empleado es requerido',
            'i_tiemposolicitado.required' =>'El tiempo solicitado es requerido',
            'periodo.required' =>'Debe seleccionar el periodo del permiso solicitado',
            'motivo_id.required' => 'El motivo del permiso no ha sido seleccionado.',
            'v_observaciones.min' => 'Las observaciones no pueden ser menor a :min caracteres.',
            'v_observaciones.max' => 'Las observaciones no puede ser mayor a :max caracteres.'            
        ];
    }
}
