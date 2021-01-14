<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AsignaturaRequest extends FormRequest
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
            'asignatura' => 'min:3|max:100|required',
            'descripcion'=>'min:3|max:100|string'
        ];
    }

    public function messages()
    {
        return [
'asignatura.min' => 'Asignatura no puede ser menor a :min caracteres.',
'asignatura.max' => 'Asignatura no puede ser mayor a :max caracteres.'
        ];
    }
}
