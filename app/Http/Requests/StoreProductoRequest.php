<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductoRequest extends FormRequest
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
            'nombre' => 'required | max:255',
            'tipo_producto' => 'required | in:0,1',
            'precio' => 'required | numeric | min:0 | max:9999999',
            'imagen' => 'required | image | mimes:jpeg,png,jpg,gif,svg|max:2048',
            'descripcion' => 'nullable | max:255',
            'codigo_barra' => 'nullable | max:191',
            'stock' => 'nullable | numeric | min:0 | max:9999999',
            'costo' => 'nullable | numeric | min:0 | max:9999999',
            'id_almacen' => 'nullable | string',
            // 'id_almacen' => 'nullable | exists:almacenes,id',
            'id_marca' => 'nullable | exists:marcas,id',
            'id_categoria' => 'nullable | exists:categorias,id',
        ];
    }
}
