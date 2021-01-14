<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EstudiosrrhhRequest extends FormRequest
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
            'institucion' => 'min:4|max:150|required',
            'titulo' => 'min:4|max:150|nullable',
            'observaciones' => 'min:4|max:200|nullable'
        ];
    }
    public function messages()
    {
        return[
'institucion.min' => 'EL campo institución no puede ser menor a :min caracteres.',
'institucion.max' => 'EL campo institución no puede ser mayor a :max caracteres.',
'titulo.min' => 'EL campo titulo no puede ser menor a :min caracteres.',
'titulo.max' => 'EL campo titulo no puede ser mayor a :max caracteres.',
'observaciones.min' => 'EL campo institución no puede ser menor a :min caracteres.',
'observaciones.max' => 'EL campo institución no puede ser mayor a :max caracteres.'
];
    }
}
