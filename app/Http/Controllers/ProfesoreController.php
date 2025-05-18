<?php

namespace App\Http\Controllers;

//Modelos
use App\Models\{
    Profesore,
    Helpers,
    DataDev,
    Grupo
};

use App\Http\Requests\StoreProfesoreRequest;
use App\Http\Requests\UpdateProfesoreRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProfesoreController extends Controller
{

    public function index(Request $request)
    {
        try {
            if($request->filtro){

                $profesores = Profesore::where('cedula', $request->filtro)
                ->where('estatus', '>=', 1)
                ->orWhere('nombre', 'LIKE', "%{$request->filtro}%")  
                ->orWhere('edad', 'LIKE', "%{$request->filtro}%")  
                ->orWhere('correo', 'LIKE', "%{$request->filtro}%")
                ->orderBy('id', 'desc')
                ->paginate(12);  
    
            } elseif($request->estatus){
                if($request->estatus == 3 ) $request['estatus'] = 0;
                $profesores =  Profesore::where('estatus', '=', $request->estatus)
                ->orderBy('id', 'desc')
                ->paginate(12);
            } else{
                $profesores =  Profesore::where('estatus', '=', 1)
                ->orderBy('id', 'desc')
                ->paginate(12);
            }

            foreach ($profesores as $key => $profesor) {
                $profesor['grupos_estudios'] = Grupo::where('cedula_profesor', $profesor->cedula)->get();
            }

            $respuesta = DataDev::$respuesta;
    
            return view('admin.profesores.lista', compact('request', 'profesores', 'respuesta'));
        } catch (\Throwable $th) {
            $mensaje = Helpers::getMensajeError($th, ', ¡Error interno al intentar listar los profesores!');
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            return back()->with(compact('mensaje', 'estatus'));
        }
    }

    public function store(StoreProfesoreRequest $request)
    {
       
        $estatusCreate = 0;
        $datoExiste = Helpers::datoExiste($request, [
            "profesores" => ["cedula", "", "cedula"]
        ]);
        $cedulaAlert = $datoExiste ? $datoExiste->cedula = number_format($datoExiste->cedula,0,',','.') : '';
        
        if (!$datoExiste) {
            
            if(isset($request->file)){
                $request['foto'] = Helpers::setFile($request);
            }
            $estatusCreate = Profesore::create($request->all());
        }

        $mensajeError = $datoExiste->estatus == 0   ? 'El profesor existe pero esta borrado de forma temporal, para volver a activar el profesor debe ingresar al filtro y seleccionar borrado temporal y filtrar.' 
                                                    : "La cédula ingresada ya esta registrada con {$datoExiste->nombre} - V-{$datoExiste->cedula}, por favor vuelva a intentar con otra cédula.";

        $mensaje = $estatusCreate ? "Profesor registrado correctamente"
                                    : $mensajeError;
        $estatus = $estatusCreate ? Response::HTTP_OK : Response::HTTP_UNAUTHORIZED;
       

        return back()->with( compact('mensaje', 'estatus') );
    }

    public function edit(Profesore $profesore)
    {
        $respuesta = DataDev::$respuesta;
        return view('admin.profesores.editar', compact('profesore', 'respuesta'));
    }

    public function update(UpdateProfesoreRequest $request, Profesore $profesore)
    {
       try {
            /** verificamos si cambio la cedula */
            if($request->cedula != $profesore->cedula){
                Grupo::where('cedula_profesor', $profesore->cedula)
                ->update([
                    "cedula_profesor" => $request->cedula
                ]);
            }

           // Validamos si se envio una foto
           if (isset($request->file)) {
                // Eliminamos la imagen anterior
                Helpers::removeFile($profesore->foto);
                 
                // Insertamos la nueva imagen o archivo
                $request['foto'] = Helpers::setFile($request);
            }else{
                $request['foto'] = $profesore->foto;
            }
    
            /** Verificacmos que estatus asignar */
            if(!$request->estatus) $request['estatus'] = 2;

            // Ejecutamos la actualizacion (Guardamos los cambios)
            $profesore->update( $request->all() );

            //respuesta
            $mensaje = "Los datos del profesor se actualizaron correctamente.";
            $estatus = Response::HTTP_OK;
            return back()->with(compact('mensaje', 'estatus'));
    
       } catch (\Throwable $th) {
            $mensaje = Helpers::getMensajeError($th, ', ¡Error interno al intentar actualizar el profesor!');
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            return back()->with(compact('mensaje', 'estatus'));
       }
      
    }

    public function destroy(Profesore $profesore)
    {
        try {
            /** Borrado suave */
            $profesore->update(['estatus' => 0]);

            $mensaje = "El profesor fue eliminado correctamente.";
            $estatus = Response::HTTP_OK;
            return back()->with( compact('mensaje', 'estatus') );
         
        } catch (\Throwable $th) {
            $mensaje = Helpers::getMensajeError($th, ', ¡Error interno al intentar eliminar el profesor!');
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            return back()->with(compact('mensaje', 'estatus'));
        }
    }
}
