<?php

namespace App\Http\Controllers;

use App\Models\Cuota;
use App\Http\Requests\StoreCuotaRequest;
use App\Http\Requests\UpdateCuotaRequest;
use App\Models\DataDev;
use App\Models\Helpers;

class CuotaController extends Controller
{


    public $data;

    /**
     * Constructor
     */
     public function __construct(){
        $this->data = new DataDev();
     }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $respuesta = $this->data::$respuesta;
        //mostramos una lista de cuotas
        $cuotas = Helpers::addDatosDeRelacion(
            Cuota::where('estatus', 0)
            ->whereYear('fecha', date('Y'))
            ->whereMonth('fecha','=' , date('m'))
            ->whereDay('fecha','<', date('d'))
            ->get(),
            [
                "estudiantes" => "cedula_estudiante"
            ]
        );
   
        // return $cuotas[0]->estudiante['nombre'];
        return view('admin.cuotas.lista', compact('respuesta', 'cuotas'));
    }

}
