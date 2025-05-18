<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePageRepresentanteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "rep_nombre" => 'required | max:255', 
            "rep_cedula" => 'required | max:55',
            "rep_telefono" => 'required | max:255',
            "rep_correo" => 'required | max:255',
            "rep_nacimiento" => 'required | max:255',
            "rep_edad" => 'required | numeric | max:255',
            "rep_direccion" => 'required | max:255',
            "rep_ocupacion" => 'required | max:255',
        ];
    }
}
