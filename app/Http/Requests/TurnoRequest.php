<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TurnoRequest extends FormRequest
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
            'turno' => 'min:3|max:50|required|unique:tb_turnos,turno,'.$this->id
        ];
    }

    public function messages()
    {
        return [
'turno.min' => 'El turno no puede ser menor a :min caracteres.',
'turno.max' => 'El turno no puede ser mayor a :max caracteres.',
'turno.unique' => 'Este turno ya existe.'
        ];
    }
}
