<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfesoreRequest extends FormRequest
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
            "nombre"        => "required | max:255", 
            "nacionalidad"  => "required", 
            "cedula"        => "numeric | unique:profesores",
            "telefono"      => "required | min:11",
            "correo"        => "min:3 | max:255",
            "edad"          => "numeric | min:18 | max:120",     
            "direccion"     => "min:3 | max:255",
            "foto"          => "mimes:jpg,bmp,png",
        ];
    }
}
