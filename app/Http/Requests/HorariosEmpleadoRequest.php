<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HorariosEmpleadoRequest extends FormRequest
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
            'txthoraLE' => 'required_with:txthoraLS',
            'txthoraLS' => 'required_with:txthoraLE',
            'txthoraME' => 'required_with:txthoraMS',
            'txthoraMS' => 'required_with:txthoraME',
            'txthoraMiE' => 'required_with:txthoraMiS',
            'txthoraMiS' => 'required_with:txthoraMiE',
            'txthoraJE' => 'required_with:txthoraJS',
            'txthoraJS' => 'required_with:txthoraJE',
            'txthoraVE' => 'required_with:txthoraVS',
            'txthoraVS' => 'required_with:txthoraVE',
            'txthoraLE2' => 'required_with:txthoraLS2',
            'txthoraLS2' => 'required_with:txthoraLE2',
            'txthoraSE' => 'required_with:txthoraSS',
            'txthoraSS' => 'required_with:txthoraSE',
            'txthoraDE' => 'required_with:txthoraDS',
            'txthoraDS' => 'required_with:txthoraDE'
        ];
    }

    public function messages()
    {
        return [
            'txthoraLE.required_with' => 'Hora de entrada día Lunes es requerida.',
            'txthoraLS.required_with' =>'Hora de salida día Lunes es requerida.',
            'txthoraME.required_with' => 'Hora de entrada día Martes es requerida.',
            'txthoraMS.required_with' =>'Hora de salida día Martes es requerida.',
            'txthoraMiE.required_with' => 'Hora de entrada día Miercoles es requerida.',
            'txthoraMiS.required_with' =>'Hora de salida día Miercoles es requerida.',
            'txthoraJE.required_with' => 'Hora de entrada día Jueves es requerida.',
            'txthoraJS.required_with' =>'Hora de salida día Jueves es requerida.',
            'txthoraVE.required_with' => 'Hora de entrada día Viernes es requerida.',
            'txthoraVS.required_with' =>'Hora de salida día Viernes es requerida.',
            'txthoraSE.required_with' => 'Hora de entrada día Sabado es requerida.',
            'txthoraSS.required_with' =>'Hora de salida día Sabado es requerida.',
            'txthoraDE.required_with' => 'Hora de entrada día Domingo es requerida.',
            'txthoraDS.required_with' =>'Hora de salida día Domingo es requerida.',
            'txthoraLE2.required_with' =>'Hora de entrada número 2 del día Lunes es requerida.',
            'txthoraLS2.required_with' =>'Hora de salida número 2 del día Lunes es requerida.'
        ];
    }

}
