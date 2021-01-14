<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PeriodocontableRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombre'=>'min:3|max:75|string|required'
        ];
    }

     public function messages()
    {
        return[
        'nombre.required'=>'Nombre del periodo es requerido',
        'nombre.min' => 'Nombre de periodo no puede ser menor a :min caracteres',
        'nombre.max' => 'Nombre de periodo no puede ser mayor a :max caracteres'
         ];
    }
}
