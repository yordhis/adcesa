<?php

namespace App\Http\Controllers;

use App\Models\Insumo;
use App\Http\Requests\StoreInsumoRequest;
use App\Http\Requests\UpdateInsumoRequest;
use App\Models\Categoria;
use App\Models\DataDev;
use App\Models\Helpers;
use App\Models\Marca;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Nette\Utils\Strings;

class InsumoController extends Controller
{
    /**
     * Mètodo que retorna la vista del modulo de insumos
     */
    public function index(Request $request)
    {
        try {
            $medidas = [
                ['id' => 1, 'nombre' => 'METROS', 'simbolo' => 'M'],
                ['id' => 2, 'nombre' => 'CENTIMETROS',  'simbolo' => 'CM'],
                ['id' => 3, 'nombre' => 'METROS CUADRADOS', 'simbolo' => 'M2'],
                ['id' => 4, 'nombre' => 'CENTIMETROS CUADRADOS', 'simbolo' => 'CM2'],
                ['id' => 4, 'nombre' => 'UNIDAD', 'simbolo' => 'U'],
            ];
            $almacenes = [
                ['id' => 1, 'nombre' => 'Almacen A'],
                ['id' => 2, 'nombre' => 'Almacen B'],
            ];

            $marcas = Marca::orderBy('nombre', 'ASC')->get();
            $categorias = Categoria::orderBy('nombre', 'ASC')->get();

            if ($request->filtro || $request->order) {
                $insumos = Insumo::where('nombre', 'like',  "%$request->filtro%")
                    ->orderBy('nombre', $request->input('order', 'ASC'))
                    ->paginate($request->input('limit', 12));
                $respuesta = DataDev::$respuesta;
            } else {
                $insumos = Insumo::orderBy('nombre', 'ASC')
                    ->paginate($request->input('limit', 12));
                $respuesta = DataDev::$respuesta;
            }

            foreach ($medidas as $key => $medida) {
                foreach ($insumos as $key => $insumo) {
                    if ($insumo->medida == $medida['id']) {
                        $insumo['nombre_medida'] = $medida['nombre'];
                        $insumo['simbolo'] = $medida['simbolo'];
                    }
                }
            }

            return view('admin.insumos.index', compact('insumos', 'almacenes', 'medidas', 'categorias', 'marcas', 'request', 'respuesta'));
        } catch (\Throwable $th) {
            $mensaje = Helpers::getMensajeError($th, 'Error al retornar la vista de insumo');
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            return back()->with(compact('mensaje', 'estatus'));
        }
    }


    /**
     * Método que crea las insumos
     */
    public function store(StoreInsumoRequest $request)
    {
        try {
            // return $request->all();
            /** Validar codigo de barra */
            if ($request->codigo_barra) {
                $codigoExiste = Insumo::where('codigo_barra', '=', $request->codigo_barra)->first();
                if ($codigoExiste) {
                    $mensaje = "Código de barra ya existe";
                    $estatus = Response::HTTP_BAD_REQUEST;
                    return back()->withInput($request->inputs)->with(compact('mensaje', 'estatus'));
                }
            }

            /** Completar datos */
            $request['codigo_barra'] = Strings::upper($request->codigo_barra ?? '');
            $request['nombre'] = Strings::upper($request->nombre);
            $request['marca'] = Marca::find($request->id_marca)->nombre;
            $request['categoria'] = Categoria::find($request->id_categoria)->nombre;
            $request['almacen'] = $request->id_almacen == 1 ? 'ALMACEN A' : 'ALMACEN B'; // MODIFICAR

            /** Insertamos la imagen y obtenermos la url para guardar en la DB */
            if ($request->file) {
                $request['imagen'] = Helpers::setFile($request);
            }

            /** Ejecutamos el guardado del insumo */
            Insumo::create($request->all());

            /** Configuramos el mensaje de respuesta para el usuario */
            $mensaje = "Insumo creado correctamente";
            $estatus = Response::HTTP_OK;

            /** fin */
            return back()->with(compact('mensaje', 'estatus'));
        } catch (\Throwable $th) {
            /** Mensaje de error en la misma vista */
            $mensaje = Helpers::getMensajeError($th, 'Error al crear insumo');
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            return back()->with(compact('mensaje', 'estatus'));
        }
    }


    /**
     * Método que actualiza los datos de la insumo
     */
    public function update(UpdateInsumoRequest $request, Insumo $insumo)
    {
        try {
            /** Validar codigo de barra */
            if ($request->codigo_barra) {
                if ($request->codigo_barra != $insumo->codigo_barra) {
                    $codigoExiste = Insumo::where('codigo_barra', '=', $request->codigo_barra)->first();
                    if ($codigoExiste) {
                        $mensaje = "Código de barra ya existe";
                        $estatus = Response::HTTP_BAD_REQUEST;
                        return back()->withInput($request->inputs)->with(compact('mensaje', 'estatus'));
                    }
                }
            }

            /** Completar datos */
            $request['codigo_barra'] = Strings::upper($request->codigo_barra ?? '');
            $request['nombre'] = Strings::upper($request->nombre);
            $request['marca'] = Marca::find($request->id_marca)->nombre;
            $request['categoria'] = Categoria::find($request->id_categoria)->nombre;
            $request['almacen'] = $request->id_almacen == 1 ? 'ALMACEN A' : 'ALMACEN B'; // MODIFICAR


            /** Verificamos si enviaron una imagen nueva */
            if ($request->file) {
                $insumo->imagen ? Helpers::removeFile($insumo->imagen) : '';
                $request['imagen'] = Helpers::setFile($request);
            }

            $insumo->update($request->all());
            $mensaje = "Datos actualizados correctamente";
            $estatus = Response::HTTP_OK;
            return back()->with(compact('mensaje', 'estatus'));
        } catch (\Throwable $th) {
            $mensaje = Helpers::getMensajeError($th, 'Error al actualizar insumo');
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            return back()->with(compact('mensaje', 'estatus'));
        }
    }

    /**
     * Método que elimina la insumo
     * si no esta relacionada
     */
    public function destroy(Insumo $insumo)
    {
        try {
            // return $insumo;
            /** Validamos que esta insumo no este siendo usada */
            // code

            /** Eliminamos */
            $insumo->delete();
            $mensaje = "insumo eliminada correctamente";
            $estatus = Response::HTTP_OK;
            return back()->with(compact('mensaje', 'estatus'));
        } catch (\Throwable $th) {
            $mensaje = Helpers::getMensajeError($th, 'Error al eliminar insumo');
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            return back()->with(compact('mensaje', 'estatus'));
        }
    }


    public function create()
    {
        $mensaje = "¡Ruta no disponible!";
        $estatus = Response::HTTP_NOT_FOUND;
        return redirect()->route('admin.insumos.index')->with(compact('mensaje', 'estatus'));
    }

    public function show($userId)
    {
        $mensaje = "¡Ruta no disponible!";
        $estatus = Response::HTTP_NOT_FOUND;
        return redirect()->route('admin.insumos.index')->with(compact('mensaje', 'estatus'));
    }
    public function edit($userId)
    {
        $mensaje = "¡Ruta no disponible!";
        $estatus = Response::HTTP_NOT_FOUND;
        return redirect()->route('admin.insumos.index')->with(compact('mensaje', 'estatus'));
    }
}
