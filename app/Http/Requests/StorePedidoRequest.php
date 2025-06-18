<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePedidoRequest extends FormRequest
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
            'total_a_pagar' => 'required | numeric | max:9999999 | min:1',
            'id_cliente' => 'required',
            // 'nombres_cliente' => 'required | string | max:255',
            // 'apellidos_cliente' => 'required | string | max:255',
            // 'direccion_cliente' => 'required | string | max:255',
            // 'nacionalidad_cliente' => 'required | string | max:2 | min:1',
            'cedula_cliente' => 'required | numeric | max:99999999 | min:1',
            'telefono_cliente' => 'required | string | max:55',
            'email_cliente' => 'required | email',
            'fecha_inicio' => 'required | date',
            'fecha_entrega' => 'nullable | date',
        ];
    }
}
