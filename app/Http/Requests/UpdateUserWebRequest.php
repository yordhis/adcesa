<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserWebRequest extends FormRequest
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
     public function rules(): array
    {
        return [
            'nombres' => 'required|string|max:155',
            'apellidos' => 'required|string|max:155',
            'cedula' => 'required|string|max:20',
            'nacionalidad' => 'required|string|max:20',
            'sexo' => 'required|string|max:20',
            'telefono' => ['required', 'string', 'regex:/^0(4(12|14|16|24|26))[0-9]{7}$/', 'min:11', 'max:20'],
            'direccion' => 'required|string|max:155',
            'fecha_nacimiento' => 'required|string|max:100',
            'email' => 'required|string|max:155',
            'password' => 'nullable|string|min:6|max:8',
            // Datos opcionales
            'ciudad' => 'nullable|string|max:75',
            'estado' => 'nullable|string|max:75',
            'pais' => 'nullable|string|max:75',
            'file' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'nombres.required' => 'El campo Nombre es obligatorio.',
            'apellidos.required' => 'El campo Apellido es obligatorio.',
            'cedula.required' => 'El campo Cédula es obligatorio.',
            'telefono.required' => 'El campo Teléfono es obligatorio.',
            'telefono.regex' => 'El número de Teléfono debe ser válido y comenzar con 04.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.unique' => 'Este correo ya está registrado.',
            // Agrega más mensajes personalizados según tus necesidades
        ];
    }
}
