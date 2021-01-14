<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FondodisponibleRequest extends FormRequest
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
            'descripcion'=>'min:2|max:150'
        ];
    }
    public function messages(){
        return [
            'descripcion.min'=>'El campo descripción no puede tener menor que :min caracteres',
            'descripcion.max'=>'El campo descripcion no puede tener mas que :max caracteres'
        ];
    }
}
