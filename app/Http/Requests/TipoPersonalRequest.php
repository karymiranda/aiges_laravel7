<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TipoPersonalRequest extends FormRequest
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
            'v_tipopersonal' => 'min:3|max:50|required'
        ];
    }

    public function messages()
    {
        return [
            'v_tipopersonal.required' => 'Agrega el nombre del tipo de personal.',
            'v_tipopersonal.max' =>'El nombre del tipo de personal no puede ser mayor a :max caracteres.',
            'v_tipopersonal.min' => 'El nombre del tipo de personal no puede ser menor a :min caracteres.'
        ];
    }
}
