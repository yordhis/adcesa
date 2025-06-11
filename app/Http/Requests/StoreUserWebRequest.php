<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserWebRequest extends FormRequest
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
            'nombres' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'cedula' => 'required|string|max:20',
            'nacionalidad' => 'required|string|max:20',
            'sexo' => 'required|string|max:20',
            'telefono' => 'required|string|max:20',
            'direccion' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|string|max:100',
            'email' => 'required|string|max:255|unique:users',
            'password' => 'nullable|string|min:6',
            // Datos opcionales
            'ciudad' => 'nullable|string|max:100', 
            'estado' => 'nullable|string|max:100',
            'pais' => 'nullable|string|max:100',
            'file' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
}
