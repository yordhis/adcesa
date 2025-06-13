<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Http\Requests\StoreProductoRequest;
use App\Http\Requests\UpdateProductoRequest;
use App\Models\Categoria;
use App\Models\DataDev;
use App\Models\Helpers;
use App\Models\Marca;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Nette\Utils\Strings;

class ProductoController extends Controller
{
    /**
     * Mètodo que retorna la vista del modulo de productos
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
            $respuesta = DataDev::$respuesta;

            if ($request->filtro || $request->order) {
                $productos = Producto::where('nombre', 'like',  "%$request->filtro%")
                    ->orderBy('nombre', $request->input('order', 'ASC'))
                    ->paginate($request->input('limit', 12));
            } else {
                $productos = Producto::orderBy('nombre', 'ASC')
                    ->paginate($request->input('limit', 12));
            }

            foreach ($medidas as $key => $medida) {
                foreach ($productos as $key => $producto) {
                    if ($producto->medida == $medida['id']) {
                        $producto['nombre_medida'] = $medida['nombre'];
                        $producto['simbolo'] = $medida['simbolo'];
                    }
                }
            }

            return view('admin.productos.index', compact('productos', 'almacenes', 'medidas', 'categorias', 'marcas', 'request', 'respuesta'));
        } catch (\Throwable $th) {
            $mensaje = Helpers::getMensajeError($th, 'Error al retornar la vista de productos');
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            return back()->with(compact('mensaje', 'estatus'));
        }
    }


    /**
     * Método que crea los productos
     */
    public function store(StoreProductoRequest $request)
    {
        try {
            // return $request->all();
            /** Validar codigo de barra */
            if ($request->codigo_barra) {
                $codigoExiste = Producto::where('codigo_barra', '=', $request->codigo_barra)->first();
                if ($codigoExiste) {
                    $mensaje = "Código de barra ya existe";
                    $estatus = Response::HTTP_BAD_REQUEST;
                    return back()->withInput($request->inputs)->with(compact('mensaje', 'estatus'));
                }
            }

            /** Completar datos */
            $request['codigo_barra'] = Strings::upper($request->codigo_barra ?? '');
            $request['nombre'] = Strings::upper($request->nombre);
            $request['descripcion'] = Strings::upper($request->descripcion ?? '');
            $request['marca'] = Marca::find($request->id_marca)->nombre;
            $request['categoria'] = Categoria::find($request->id_categoria)->nombre;
            $request['almacen'] = $request->id_almacen == 1 ? 'ALMACEN A' : 'ALMACEN B'; // MODIFICAR

            /** 
             * Verificamos si es un producto compuesto
             * en caso de que SI se asigna el @var estatus @param Inactivo
             * y en caso de que no @param Activo
             */
            $request->tipo_producto ? $request['estatus'] = 'INACTIVO' : $request['estatus'] = 'ACTIVO';

   

            /** Insertamos la imagen y obtenermos la url para guardar en la DB */
            if ($request->file) {
                $request['imagen'] = Helpers::setFile($request);
            }

            /** Ejecutamos el guardado del producto */
            Producto::create($request->all());

            /** Configuramos el mensaje de respuesta para el usuario */
            $mensaje = "producto creado correctamente";
            $estatus = Response::HTTP_OK;

            /** fin */
            return back()->with(compact('mensaje', 'estatus'));
        } catch (\Throwable $th) {
            /** Mensaje de error en la misma vista */
            $mensaje = Helpers::getMensajeError($th, 'Error al crear producto');
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            return back()->with(compact('mensaje', 'estatus'));
        }
    }


    /**
     * Método que actualiza los datos de la producto
     */
    public function update(UpdateproductoRequest $request, producto $producto)
    {
        try {
            /** Validar codigo de barra */
            if ($request->codigo_barra) {
                if ($request->codigo_barra != $producto->codigo_barra) {
                    $codigoExiste = Producto::where('codigo_barra', '=', $request->codigo_barra)->first();
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
            $request['descripcion'] = Strings::upper($request->descripcion ?? '');
            $request['marca'] = Marca::find($request->id_marca)->nombre;
            $request['categoria'] = Categoria::find($request->id_categoria)->nombre;
            $request['almacen'] = $request->id_almacen == 1 ? 'ALMACEN A' : 'ALMACEN B'; // MODIFICAR


            /** Verificamos si enviaron una imagen nueva */
            if ($request->file) {
                $producto->imagen ? Helpers::removeFile($producto->imagen) : '';
                $request['imagen'] = Helpers::setFile($request);
            }

            $producto->update($request->all());
            $mensaje = "Datos actualizados correctamente";
            $estatus = Response::HTTP_OK;
            return back()->with(compact('mensaje', 'estatus'));
        } catch (\Throwable $th) {
            $mensaje = Helpers::getMensajeError($th, 'Error al actualizar producto');
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            return back()->with(compact('mensaje', 'estatus'));
        }
    }

    /**
     * Método que elimina la producto
     * si no esta relacionada
     */
    public function destroy(Producto $producto)
    {
        try {
            /** Eliminamos */
            $producto->delete();
            $mensaje = "producto eliminada correctamente";
            $estatus = Response::HTTP_OK;
            return back()->with(compact('mensaje', 'estatus'));
        } catch (\Throwable $th) {
            $mensaje = Helpers::getMensajeError($th, 'Error al eliminar producto');
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            return back()->with(compact('mensaje', 'estatus'));
        }
    }


    public function create()
    {
        $mensaje = "¡Ruta no disponible!";
        $estatus = Response::HTTP_NOT_FOUND;
        return redirect()->route('admin.productos.index')->with(compact('mensaje', 'estatus'));
    }

    public function show($userId)
    {
        $mensaje = "¡Ruta no disponible!";
        $estatus = Response::HTTP_NOT_FOUND;
        return redirect()->route('admin.productos.index')->with(compact('mensaje', 'estatus'));
    }
    public function edit($userId)
    {
        $mensaje = "¡Ruta no disponible!";
        $estatus = Response::HTTP_NOT_FOUND;
        return redirect()->route('admin.productos.index')->with(compact('mensaje', 'estatus'));
    }
}
