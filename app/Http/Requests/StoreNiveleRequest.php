<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNiveleRequest extends FormRequest
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
            "codigo" => "required",
            "nombre" => "required | max:255",
            "libro" => "required | max:255",
            "precio" => "required | numeric",
            "duracion" => "required | numeric",
            "file" => "required | file | max:2048",
            "tipo_nivel" => "required"
        ];
    }
}
