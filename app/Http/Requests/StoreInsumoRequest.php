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
            'precio' => 'required|numeric|max:9999999',
            'costo' => 'required|numeric|max:9999999',
            'cantidad' => 'required|numeric|max:9999999',
            'unidad' => 'required|numeric|max:9999999',
            'stock' => 'required|numeric|max:9999999',
            'imagen' => 'file|max:2048|mimes:jpg,bmp,png|dimensions:min_width=100,min_height=200',
            'id_medida' => 'required',
            'id_almacen' => 'required',
            'id_marca' => 'required',
            'id_categoria' => 'required',
        ];
    }
}
