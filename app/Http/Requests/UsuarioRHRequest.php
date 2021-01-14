<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioRHRequest extends FormRequest
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
            'txtfoto' => 'nullable|image|mimes:jpeg,jpg,png',
            'nivel' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'txtfoto.image' => 'Debes seleccionar una imagen.',
            'txtfoto.mimes' =>'El formato de imagenes permitidas es jpeg, jpg y png ',
            'nivel.required' => 'Debes seleccionar un rol.'
        ];
    }
}
