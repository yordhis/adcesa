<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCuentaRequest extends FormRequest
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
            'metodo' => 'required | min:4 | max:155', // Transferencia, Deposito, etc.
            'codigo_banco' => 'required | min:4 | max:4',
            'nombre_banco' => 'required | min:4 | max:255 ',
            'tipo_cuenta' => 'nullable | in:CORRIENTE,AHORRO', // Ahorros, Corriente, etc.
            'numero_cuenta' => 'nullable | min:20 | max:22 ',
            'telefono' => 'nullable | min:11 | max:15',
            'titular' => 'required | min:4 | max:255',
            'nacionalidad' => 'required | string | in:V,E,J',
            'cedula_titular' => 'required | max:255',
            
        ];
    }
}
