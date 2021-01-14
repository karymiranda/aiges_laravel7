<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioAcademicoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function rules()
    {
        return [
            'txtfoto' => 'nullable|image|mimes:jpeg,jpg,png'
        ];
    }

    public function messages()
    {
        return [
            'txtfoto.image' => 'Debe seleccionar una imagen.',
            'txtfoto.mimes' =>'El formato de imagenes permitidas es jpeg, jpg y png '
        ];
    }
}
