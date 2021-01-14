<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DocumentonuloRequest extends FormRequest
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
            'numero_cheque' => 'unique:tb_transacciones_bono,numero_cheque,'.$this->id 
        ];
    }
    public function messages()
    {
        return [            
'numero_cheque.unique' => 'El número de cheque ya existe.'
        ];
    }
}
