<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DatosPersonalesFamiliaresRequest extends FormRequest
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
         'nombres'=>'min:3|max:50|regex:/^[\pL\s\-]+$/u',
         'apellidos'=>'min:3|max:50|regex:/^[\pL\s\-]+$/u',
         'direccionderesidencia'=>'min:3|max:200|string',
         'dui'=>'nullable|string|unique:tb_familiares,dui,'.$this->id,
         'correo' => 'email|nullable|unique:tb_familiares,correo,'.$this->id,
         'profesion'=>'min:3|max:100|string|nullable',
         'lugardetrabajo'=>'min:3|max:200|string|nullable',
          'txtedad'=>'integer|gt:12|nullable',
         'direcciondetrabajo'=>'min:3|max:200|string|nullable',
          'txtfoto' => 'nullable|image|mimes:jpeg,jpg,png'
           
        ];
    }
    public function messages()
    {
        return[
            'nombres.regex' => 'El nombre debe contener solo letras',
            'nombres.min' => 'El nombre debe contener más de :min caracteres',
            'nombres.max' => 'El nombre debe contener menos de :max caracteres',
            'apellidos.min' => 'El apellido debe contener más de :min caracteres',
            'apellidos.max' => 'El apellido debe contener menos de :max caracteres',
            'apellidos.regex' => 'El apellido debe contener solo letras',
            'lugardetrabajo.min' => 'Lugar de trabajo debe contener más de :min caracteres',
            'lugardetrabajo.max' => 'Lugar de trabajo debe contener menos de :max caracteres',
'direccionderesidencia.min' => 'La dirección de residencia debe contener más de :min caracteres',
'direccionderesidencia.max' => 'La dirección de residencia debe contener menos de :max caracteres',
 'profesion.min' => 'Profesión debe contener más de :min caracteres',
 'profesion.max' => 'Profesión debe contener menos de :max caracteres', 
'direcciondetrabajo.min' => 'La dirección de trabajo debe contener más de :min caracteres',
'direcciondetrabajo.max' => 'La dirección de trabajo debe contener menos de :max caracteres',
'correo.email' => 'El correo electrónico debe ser una dirección válida',
'correo.unique' => 'El correo electrónico ha sido asignado a otro familiar',
'dui.unique' => 'El número de DUI ya ha sido asignado a otro familiar',
'txtedad.gt' => 'La edad del familiar debe ser mayor a 12 años',
 'txtfoto.image' => 'Debe seleccionar una imagen.',
'txtfoto.mimes' =>'El formato de imagenes permitidas es jpeg, jpg y png '
        ];
    }
}
