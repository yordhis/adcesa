<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePagoRequest extends FormRequest
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
            "formas_pagos_1" => "required",
            "monto_1" => "required",
            "abono" => "required",
            "codigo_pago" => "required",
            "codigo_inscripcion" => "required",
        ];
    }
}
