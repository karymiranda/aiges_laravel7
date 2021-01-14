<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GastosRequest extends FormRequest
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
            'numero_cheque' => 'unique:tb_transacciones_bono,numero_cheque,'.$this->id,            
            'concepto' => 'min:2|max:200',
            'a_favor_de' => 'min:2|max:200'
            ];
    }

    public function messages()
    {
        return [
'numero_cheque.unique' => 'El número de cheque ya existe.',
'concepto.min' => 'El concepto no puede ser menor a :min caracteres.',
'concepto.max' => 'El concepto no puede ser mayor a :max caracteres.',
'a_favor_de.min' => 'A favor de no puede ser menor a :min caracteres.',
'a_favor_de.max' => 'A favor de no puede ser mayor a :max caracteres.'
        ];
    }
}
