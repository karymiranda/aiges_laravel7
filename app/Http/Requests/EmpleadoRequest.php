<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmpleadoRequest extends FormRequest
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
            'v_nombres' => 'min:3|max:50|required',
            'v_apellidos' => 'min:3|max:50|required',
            'f_fechanaci' => 'required',
            'v_dui' => 'size:10|required|unique:tb_empleado,v_dui,'.$this->id,
            'v_nit' => 'size:17|required|unique:tb_empleado,v_nit,'.$this->id,
            'v_celular' => 'size:9|nullable',
            'v_telcasa' => 'size:9|nullable',
            'v_nip' => 'digits:9|nullable|unique:tb_empleado,v_nip,'.$this->id,
            'v_nup' => 'digits:12|nullable|unique:tb_empleado,v_nup,'.$this->id,
            'v_direccioncasa' => 'min:10|max:150|required',
            'txtedad' => 'integer|gt:17|required',
            'v_correo' => 'email|nullable|unique:tb_empleado,v_correo,'.$this->id,
            'cargo_id' => 'required',
            'tipopersonal_id' => 'required',
            'v_sueldo' => 'numeric|nullable'
        ];
    }

    public function messages()
    {
        return [
            'v_nombres.max' =>'El nombre no puede ser mayor a :max caracteres.',
            'v_nombres.min' => 'El nombre no puede ser menor a :min caracteres.',
            'v_apellidos.max' =>'El apellido no puede ser mayor a :max caracteres.',
            'v_apellidos.min' => 'El apellido no puede ser menor a :min caracteres.',
            'v_dui.size' =>'El número de DUI debe contener 10 caracteres.',
            'v_dui.unique' => 'El número de DUI ya fue asignado a otro empleado.',
            'v_nit.size' =>'El número de NIT debe contener 17 caracteres.',
            'v_nit.unique' => 'El número de NIT ya fue asignado a otro empleado.',
            'v_celular.size' =>'El número de celular debe contener 9 caracteres.',
            'v_telcasa.size' =>'El número de casa debe contener 9 caracteres.',
            'v_nip.digits' =>'El número de NIP debe contener 9 digitos.',
            'v_nip.unique' => 'El número de NIP ya fue asignado a otro empleado.',
            'v_nup.digits' =>'El número de NUP debe contener 12 digitos.',
            'v_nup.unique' => 'El número de NUP ya fue asignado a otro empleado.',
            'v_direccioncasa.min' => 'La dirección no puede ser menor a :min caracteres.',
            'v_direccioncasa.max' => 'La dirección no puede ser mayor a :max caracteres.',
            'txtedad.integer' => 'La edad debe ser un número entero.',
            'txtedad.gt' => 'La edad debe ser mayor a 17 años.',
            'txtedad.required' => 'La edad es requerida.',
            'v_correo.email' => 'La dirección de correo no es valida.',
            'v_correo.unique' => 'La dirección de correo ya fue asignada a otro empleado.',
            'cargo_id.required' => 'El cargo del empleado no ha sido seleccionado.',
            'tipopersonal_id.required' => 'El tipo de personal del empleado no ha sido seleccionado.',
            'v_sueldo.numeric' => 'El sueldo del empleado no es una cantidad.'
        ];
    }
}
