<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVarianteRequest extends FormRequest
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
            "id_producto" => "required",
            "id_medida"  => "required",
            "ancho"  => "required | numeric | max: 999999 | min: 1",
            "alto"  => "required | numeric | max: 999999 | min: 1",
            "precio"  => "required | numeric | max: 999999 | min: 1",
        ];
    }
}
