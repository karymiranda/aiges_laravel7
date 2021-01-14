<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CuentaUsuarioRequest extends FormRequest
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
            'oldpassword' => 'required',
            'newpassword' => 'nullable|required_with:newpassword2|min:8',
            'newpassword2' => 'nullable|required_with:newpassword|same:newpassword'
        ];
    }

    public function messages()
    {
        return [
            'newpassword2.required_with' => 'Debe repetir la nueva contraseña.',
            'newpassword.required_with' => 'Debe introducir la nueva contraseña.',
            'txtfoto.image' => 'Debe seleccionar una imagen.',
            'txtfoto.mimes' =>'El formato de imagenes permitidas es jpeg, jpg y png.',
            'oldpassword.required' => 'La contraseña anterior es requerida.',
            'newpassword2.same' => 'Las contraseñas no coinciden.',
            'newpassword.min' => 'La nueva contraseña debe tener un mínimo de :min caracteres.'
        ];
    }

}