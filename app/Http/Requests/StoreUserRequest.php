<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'nombres' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:4',
            'file' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'rol' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nombres.required' => 'El nombre es requerido',
            'nombres.string' => 'El nombre debe ser un texto',
            'nombres.max' => 'El nombre no debe exceder los 255 caracteres',
            'email.required' => 'El email o usuario es requerido',
            'email.string' => 'El email o usuario debe ser un texto',
            'email.max' => 'El email o usuario no debe exceder los 255 caracteres',
            'email.unique' => 'El email o usuario ya se encuentra registrado',
            'password.required' => 'La contraseña es requerida',
            'password.string' => 'La contraseña debe ser un texto',
            'password.min' => 'La contraseña debe tener al menos 4 caracteres',
            'file.image' => 'El archivo debe ser una imagen',
            'file.mimes' => 'El archivo debe ser de tipo: jpeg, png, jpg, gif, svg',
            'file.max' => 'El archivo no debe exceder los 2048 KB',
            'rol.required' => 'El rol es requerido',
        ];
    }
}
