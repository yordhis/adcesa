<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEstudianteRequest extends FormRequest
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
            "cedula"        => "numeric | unique:estudiantes",
            "file"          => "max:2048 | mimes:jpg,bmp,png",
            "nombre"        => "max:255  | required", 
            "nacionalidad"  => "required", 
            "telefono"      => "min:11 | required",
            "correo"        => "required",
            "nacimiento"    => "required",
            "edad"          => "numeric | required",
            "direccion"     => "max: 255 | required",
            "grado"         => "max: 255 | required",
            "ocupacion"     => "max: 255 | required",
            
        ];
    }
}
