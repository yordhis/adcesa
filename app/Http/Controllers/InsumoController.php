<?php

namespace App\Http\Controllers;

use App\Models\Insumo;
use App\Http\Requests\StoreInsumoRequest;
use App\Http\Requests\UpdateInsumoRequest;
use App\Models\DataDev;
use Illuminate\Http\Request;

class InsumoController extends Controller
{
    /** Método que muestra la vista del módulo de insumos */
    public function index(Request $request)
    {
        $respuesta = DataDev::$respuesta;
        $marcas = [];
        $categorias = [];
        $insumos = Insumo::paginate(12);
        return view('admin.insumos.index', compact('insumos', 'request', 'respuesta', 'marcas', 'categorias'));
    }

    /** Método que crea un insumo */
    public function store(StoreInsumoRequest $request)
    {
        return $request;
    }

    /**  Método que actualiza los datos de un insumo */
    public function update(UpdateInsumoRequest $request, Insumo $insumo)
    {
        //
    }

    /** Método que elimina un insumo si no está relacionado */
    public function destroy(Insumo $insumo)
    {
        //
    }
}
