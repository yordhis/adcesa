<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInsumoRequest extends FormRequest
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
            'codigo_barra' => 'max:191',
            'nombre' => 'required|max:255|unique:insumos',
            'precio' => 'required|numeric',
            'costo' => 'required|numeric',
            'cantidad' => 'required|numeric',
            'marca' => 'required|numeric',
            'categoria' => 'required|numeric',
            'imagen' => 'required|numeric',
            'estatus' => 'required|numeric',
            'id_marca' => 'required|numeric',
            'id_categoria' => 'required|numeric',
        ];
    }
}
