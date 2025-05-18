<?php

namespace App\Http\Controllers;

use App\Models\Representante;
use App\Http\Requests\StoreRepresentanteRequest;
use App\Http\Requests\UpdateRepresentanteRequest;
use App\Models\Helpers;
use App\Models\RepresentanteEstudiante;
use Illuminate\Http\Response;

class RepresentanteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreRepresentanteRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRepresentanteRequest $request)
    {
        try {
            /** Validar representante si existe para no crear lo de nuevo */
            $representanteExiste = Representante::where('cedula', $request->cedula)->get();
            if(count($representanteExiste)){
                $estatus = Response::HTTP_UNAUTHORIZED;
                $mensaje = "No se autorizó el registro ya que este representante ya está registrado en el sistema, Intente de nuevo.";
                return back()->with(compact('mensaje', 'estatus'));
            }

            /** Registrar el representante */
            Representante::create([
                 "nombre" => $request->rep_nombre, 
                 "cedula"  => $request->rep_cedula,
                 "telefono" => $request->rep_telefono,
                 "correo" => $request->rep_correo,
                 "nacimiento" => $request->rep_nacimiento,
                 "edad" => $request->rep_edad,
                 "direccion" => $request->rep_direccion,
                 "ocupacion" => $request->rep_ocupacion,
            ]);

            /** Asignar al estudiante el representante */
            RepresentanteEstudiante::create([
                "cedula_estudiante" => $request->rep_cedula_estudiante,
                "cedula_representante" => $request->rep_cedula
            ]);
            
            $estatus = Response::HTTP_OK;
            $mensaje = "Se registro el representante y se asigno al estudiante correctamente";
            return back()->with(compact('mensaje', 'estatus'));
            
        } catch (\Throwable $th) {
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            $mensaje = Helpers::getMensajeError( $th, ', ¡Error interno al intentar registrar el representante!' );
            return back()->with(compact('mensaje', ' estatus'));
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Representante  $representante
     * @return \Illuminate\Http\Response
     */
    public function show(Representante $representante)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Representante  $representante
     * @return \Illuminate\Http\Response
     */
    public function edit(Representante $representante)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRepresentanteRequest  $request
     * @param  \App\Models\Representante  $representante
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRepresentanteRequest $request, Representante $representante)
    {
        try {
            /** Si lacedula cambia reasignamos el representante al estudiante con la nueva cedula */
            if($request->rep_cedula != $representante->cedula){
                /** consultamos que la nueva cedula nadie la tenga */
                $cedulaYaRegistrada = Representante::where('cedula', $request->rep_cedula)->get();
                if(count($cedulaYaRegistrada)){
                    $estatus = Response::HTTP_UNAUTHORIZED;
                    $mensaje = "La cédula ingresada ya esta asiganda a un representante, intente con otro número.";
                    return back()->with(compact('mensaje', 'estatus'));
                }
                RepresentanteEstudiante::where('cedula_representante', $representante->cedula)
                ->update([
                    "cedula_representante" => $request->rep_cedula
                ]);
            }

            /** Actualizamos los datos del representante*/
            $representante->update([
                "nombre" => $request->rep_nombre, 
                "cedula"  => $request->rep_cedula,
                "telefono" => $request->rep_telefono,
                "correo" => $request->rep_correo,
                "nacimiento" => $request->rep_nacimiento,
                "edad" => $request->rep_edad,
                "direccion" => $request->rep_direccion,
                "ocupacion" => $request->rep_ocupacion,
            ]);

            $estatus = Response::HTTP_OK;
            $mensaje = "Los datos del representante se guardaron correctamente.";
            return back()->with(compact('mensaje', 'estatus'));

        } catch (\Throwable $th) {
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            $mensaje = Helpers::getMensajeError($th, ", ¡Error interno al actualizar datos del representante!, vuelve a intentar. ");
            return back()->with(compact('mensaje', 'estatus'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Representante  $representante
     * @return \Illuminate\Http\Response
     */
    public function destroy(Representante $representante)
    {
       
        try {
            /** Desasignar el representante DE TODOS SUS REPRESENTADOS*/
            RepresentanteEstudiante::where('cedula_representante', $representante->cedula)->delete();
            
            /** Eliminar el representante */
            $representante->delete();

            $estatus = Response::HTTP_OK;
            $mensaje = "Se eliminó y desasigno el representante del estudiante.";
            return back()->with(compact('mensaje', 'estatus'));

        } catch (\Throwable $th) {
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            $mensaje = Helpers::getMensajeError( $th, ', ¡Error interno al intentar eliminar el representante!' );
            return back()->with(compact('mensaje', 'estatus'));
        }

    }
}
