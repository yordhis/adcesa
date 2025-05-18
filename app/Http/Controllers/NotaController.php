<?php

namespace App\Http\Controllers;

use App\Models\Cuota;
use App\Models\DataDev;
use App\Models\Helpers;
use App\Models\Inscripcione;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class NotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    
        try {
            /** Validamos que los datos sean enviados */
            $request->validate([
                "nota" => "required | numeric | min:1",
                "notaMaxima" => "required | numeric | min:1",
            ]);


            /** validamos que la nota asignada no pase la nota máxima */
            if ($request->nota > $request->notaMaxima) {
                return back()->with(
                    [
                        "estatus" => Response::HTTP_UNAUTHORIZED,
                        "mensaje" => "La nota asignada supera la nota maxima."
                    ]
                );
            }

            $nota = "{$request->nota}/{$request->notaMaxima}";
            Inscripcione::where('id', $id)
            ->update(['nota' => $nota]);

            return back()->with([
                "estatus" => Response::HTTP_OK,
                "mensaje" => "La nota se guardo correctamente."
            ]);

        } catch (\Throwable $th) {
             return back()->with([
                "estatus" => Response::HTTP_INTERNAL_SERVER_ERROR,
                "mensaje" => "¡Error al actualizar nota, es probable que envio los campos vacios.!"
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
