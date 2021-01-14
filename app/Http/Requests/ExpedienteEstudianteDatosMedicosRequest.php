<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExpedienteEstudianteDatosMedicosRequest extends FormRequest
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
            'horario_sueno_noche'=>'min:5|max:200|string|nullable',
            'horario_sueno_dia'=>'min:5|max:200|string|nullable',
            'tiempo_lactancia'=>'integer|nullable|between:1,48',
            'canti_refrigerios'=>'integer|nullable|between:1,10',
            'tiene_dicultad_comer'=>'min:5|max:100|string|nullable',
            'alergicoa'=>'min:5|max:200|string|nullable',
            'alimentos_prefiere'=>'min:5|max:200|string|nullable',
            'alimentos_rechaza'=>'min:5|max:200|string|nullable',
            'detallereceta'=>'min:5|max:200|string|nullable'
        ];
    }

    public function messages()
    {
        return[
            'tiempo_lactancia.integer' => 'El tiempo de lactancia debe ser un número entero',
            'tiempo_lactancia.between' => 'El tiempo de lactancia debe ser un número entre 1 y 48',
            'horario_sueno_noche.min' => 'Horario de sueño durante la noche debe contener más de :min caracteres',
            'horario_sueno_noche.max' => 'Horario de sueño durante la noche debe contener menos de :max caracteres',
'horario_sueno_dia.min' => 'Horario de sueño durante el dia debe contener más de :min caracteres',
'horario_sueno_dia.max' => 'Horario de sueño durante el dia debe contener menos de :max caracteres',
'canti_refrigerios.integer' => 'Cantidad de refrigerios debe ser un número entero',
'canti_refrigerios.between' => 'Cantidad de refrigerios debe ser un número entre 1 y 10',
'tiene_dicultad_comer.min' => 'Dificultad para comer debe contener más de :min caracteres',
'tiene_dicultad_comer.max' => 'Dificultad para comer debe contener menos de :max caracteres',
'alergicoa.min' => 'Alérgico a debe contener más de :min caracteres',
'alergicoa.max' => 'Alérgico a debe contener menos de :max caracteres',
'alimentos_prefiere.min' => 'Alimentos que prefiere debe contener más de :min caracteres',
'alimentos_prefiere.max' => 'Alimentos que prefiere debe contener menos de :max caracteres',
'alimentos_rechaza.min' => 'Alimentos que rechaza debe contener más de :min caracteres',
'alimentos_rechaza.max' => 'Alimentos que rechaza debe contener menos de :max caracteres',
'detallereceta.min' => 'Detalle de la receta debe contener más de :min caracteres',
'detallereceta.max' => 'Detalle de la receta debe contener menos de :max caracteres'

        ];
    }
}
