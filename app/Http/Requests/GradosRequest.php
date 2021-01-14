<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GradosRequest extends FormRequest
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
            'grado' => 'min:4|max:50|required|unique:tb_grados,grado,'.$this->id
        ];
    }

    public function messages()
    {
        return [
'grado.min' => 'El nombre del grado no puede ser menor a :min caracteres.',
'grado.max' => 'El nombre del grado no puede ser mayor a :max caracteres.',
 'grado.unique' => 'Este nombre  ya fue asignado a otro grado.'
        ];
    }
}
