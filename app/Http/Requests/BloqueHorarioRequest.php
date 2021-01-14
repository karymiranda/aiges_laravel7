<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BloqueHorarioRequest extends FormRequest
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
            'hora_inicio' => 'required',
            'hora_fin' => 'required',
            'correlativo_clase' => 'numeric|between:0,999.99|unique:tb_bloques_horarios,correlativo_clase,'.$this->id
        ];
    }
     public function messages()
    {
    return[
         'correlativo_clase.unique' => 'El número correlativo ya ha sido asignado a otro bloque',
         'correlativo_clase.numeric' => 'El correlativo de clase debe ser un número',
          'correlativo_clase.between' => 'El correlativo de clase debe ser un número entre 0 y 999.99'
    ];
}
}
