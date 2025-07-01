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
            'monto' => 'required | numeric | max:9999999 | min:1',
            'id_cliente' => 'nullable',
            'nombres_cliente' => 'nullable | string | max:255',
            'apellidos_cliente' => 'nullable | string | max:255',
            'direccion_cliente' => 'nullable | string | max:255',
            'nacionalidad_cliente' => 'nullable | string | max:2 | min:1',
            'cedula_cliente' => 'nullable | numeric | max:99999999 | min:1',
            'telefono_cliente' => 'nullable | string | max:55',
            'email_cliente' => 'nullable | email',
            // datos del pago
            'id_cuenta' => 'required | numeric | max:9999999 | min:1',
            'monto' => 'required | numeric | max:9999999 | min:1',
            'fecha_pago' => 'required|string|max:100',
            'file' => 'required | image | mimes:jpeg,png,jpg,gif,svg|max:2048', // comprobante
            'referencia' => 'required | string | max:255',
        ];
    }
}
