<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IngresoRequest extends FormRequest
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
            'concepto' => 'min:2|max:200'
        ];
    }

    public function messages()
    {
        return [
'concepto.min' => 'El concepto no puede ser menor a :min caracteres.',
'concepto.max' => 'El concepto no puede ser mayor a :max caracteres.'

        ];
    }
}
