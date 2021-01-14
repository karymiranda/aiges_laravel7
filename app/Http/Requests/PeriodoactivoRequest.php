<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PeriodoactivoRequest extends FormRequest
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
        //'anio'=>'unique:tb_periodo_activo,anio,'.$this->id,
         'nombre'=>'min:3|max:75|string|required'
            
        ];
    }

     public function messages()
    {
        return[

       // 'anio.unique'=>'Ciclo académico ya existe',  
        'nombre.required'=>'Nombre de ciclo es requerido',
        'nombre.min' => 'Nombre de ciclo no puede ser menor a :min caracteres',
        'nombre.max' => 'Nombre de ciclo no puede ser mayor a :max caracteres'
         ];
    }
}
