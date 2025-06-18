<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePedidoRequest;
use App\Http\Requests\UpdatePedidoRequest;
use App\Models\DataDev;
use App\Models\Helpers;
use App\Models\Pedido;
use App\Models\Producto;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Nette\Utils\Strings;

class PedidoController extends Controller
{

    public function index(Request $request)
    {
        try {
            $respuesta = DataDev::$respuesta;
            $pedidos = [];
            if ($request->filtro || $request->order) {
                $pedidos = Pedido::where('rol', '=', 3)
                    ->where('nombres', 'like',  "%$request->filtro%")
                    ->orderBy('nombres', $request->input('order', 'ASC'))
                    ->paginate($request->input('limit', 12));

                if (!count($pedidos)) {
                    $pedidos = Pedido::where('rol', '=', 3)
                        ->where('apellidos', 'like',  "%$request->filtro%")
                        ->orderBy('nombres', $request->input('order', 'ASC'))
                        ->paginate($request->input('limit', 12));
                }
                if (!count($pedidos)) {
                    $pedidos = Pedido::where('rol', '=', 3)
                        ->where('email', 'like',  "%$request->filtro%")
                        ->orderBy('nombres', $request->input('order', 'ASC'))
                        ->paginate($request->input('limit', 12));
                }
                if (!count($pedidos)) {
                    $pedidos = Pedido::where('rol', '=', 3)
                        ->where('cedula', 'like',  "%$request->filtro%")
                        ->orderBy('nombres', $request->input('order', 'ASC'))
                        ->paginate($request->input('limit', 12));
                }
            } else {
                $pedidos = Pedido::orderBy('fecha', 'DESC')
                    ->paginate($request->input('limit', 12));
            }

            return view('admin.pedidos.index', compact('pedidos', 'request', 'respuesta'));
        } catch (\Throwable $th) {
            $mensaje = 'Error al listar pedido.';
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            return back()->with(compact('mensaje', 'estatus'));
        }
    }

    public function create(Request $request)
    {
        try {
            $respuesta = DataDev::$respuesta;
            $insumos = [];
            $productoSolicitado = session('producto') ?? null;
            $clienteSolicitado = session('cliente') ?? null;
            $carritos = [];
            return view('admin.pedidos.create', compact(
                'respuesta',
                'request',
                'insumos',
                'productoSolicitado',
                'clienteSolicitado',
                'carritos'
            ));
        } catch (\Throwable $th) {
            $mensaje = 'Error al mostrar vista de registrar pedido.';
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            return back()->with(compact('mensaje', 'estatus'));
        }
    }

    /** 
     * Método que busca un cliente
     * y lo setea en una setea en sesion
     */
    public function buscarCliente(Request $request)
    {
        try {
            $mensaje = "Cliente añadido al pedido con exito";
            $estatus = 0;

            /** buscar el cliente */
            $cliente = User::where('cedula', $request->input('buscar_cliente'))->first();

            /** 
             * validar que si existe 
             * Y lo añadimos a la sesion
             */
            $cliente ? session(['cliente' => $cliente])
                : $mensaje = "El cliente con la cédula: {$request->input('buscar_cliente')} no existe!";
            $cliente ? $estatus = Response::HTTP_OK
                : $estatus = Response::HTTP_BAD_REQUEST;

            return back()->with(compact('mensaje', 'estatus'));
        } catch (\Throwable $th) {
            $mensaje = 'Error al buscar cliente para añadirlo al pedido.';
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            return back()->with(compact('mensaje', 'estatus'));
        }
    }

    /**
     * Método para buscar producto 
     * y cargarlo en la sesion carrito
     */
    public function buscarProducto(Request $request)
    {
        try {
            $mensaje = "Producto añadido al carrito con exito";
            $estatus = 0;

            /** buscar el producto */
            $productoEncontrados = Producto::where('nombre', "LIKE", "%{$request->input('buscar_producto')}%")->get();

            /** validar que si existe y añadir la sesion los producto encontrados */
            $productoEncontrados ? session(['productoEncontrados' => $productoEncontrados])
                : $mensaje = "El producto con el nombre: {$request->input('buscar_producto')} no existe!";
            $productoEncontrados ? $estatus = Response::HTTP_OK
                : $estatus = Response::HTTP_BAD_REQUEST;

            return back()->with(compact('mensaje', 'estatus'));
        } catch (\Throwable $th) {
            $mensaje = 'Error al buscar producto para añadirlo al carrito.';
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            return back()->with(compact('mensaje', 'estatus'));
        }
    }


      

    /**
     * Método que crea cuentas de pedidos
     */
    public function store(StorePedidoRequest $request)
    {
        try {
            return $request->all();
            /** Generar codigo de pedido */
            $request['codigo'] = Helpers::generarCodigoPedidoUnico();

            /** Validar que el codigo no se repita */
            $codigoExiste = Pedido::where('codigo', $request['codigo'])->first();
            if ($codigoExiste) {
                $mensaje = "El código de pedido ya existe.";
                $estatus = Response::HTTP_CONFLICT;
                return back()->with(compact('mensaje', 'estatus'));
            }

            /** Completar datos */
            $request['nombres_cliente'] = Strings::upper($request->nombres_cliente);
            $request['apellidos_cliente'] = Strings::upper($request->apellidos_cliente);
            $request['direccion_cliente'] = Strings::upper($request->direccion_cliente);
            $request['nacionalidad_cliente'] = Strings::upper($request->nacionalidad_cliente ?? '');
            $request['estado_cliente'] = Strings::upper($request->estado_cliente ?? '');
            $request['ciudad_cliente'] = Strings::upper($request->ciudad_cliente ?? '');


            /** Registrarmos el pedido */
            Pedido::create($request->all());

            /** Configuramos el mensaje de respuesta para el usuario */
            $mensaje = "Pedido creado correctamente";
            $estatus = Response::HTTP_OK;

            /** fin */
            return back()->with(compact('mensaje', 'estatus'));
        } catch (\Throwable $th) {
            /** Mensaje de error en la misma vista */
            $mensaje = Helpers::getMensajeError($th, 'Error al crear cuenta de usuario.');
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            return back()->with(compact('mensaje', 'estatus'));
        }
    }

    /**
     * Método que actualiza los datos de la insumo
     */
    public function update(UpdatePedidoRequest $request, Pedido $pedido)
    {
        try {
            return $pedido;
            // $pedido = Pedido::findOrFail($id);
            if ($pedido) {

                /** Completar datos */
                $request['nombres_cliente'] = Strings::upper($request->nombres_cliente);
                $request['apellidos_cliente'] = Strings::upper($request->apellidos_cliente);
                $request['direccion_cliente'] = Strings::upper($request->direccion_cliente);
                $request['nacionalidad_cliente'] = Strings::upper($request->nacionalidad_cliente ?? '');
                $request['estado_cliente'] = Strings::upper($request->estado_cliente ?? '');
                $request['ciudad_cliente'] = Strings::upper($request->ciudad_cliente ?? '');


                /** ejecutar la actualización */
                $pedido->update($request->all());
                $mensaje = "Datos actualizados correctamente";
                $estatus = Response::HTTP_OK;
                return back()->with(compact('mensaje', 'estatus'));
            } else {
                $mensaje = "Usuario no encontrado";
                $estatus = Response::HTTP_NOT_FOUND;
                return back()->with(compact('mensaje', 'estatus'));
            }
        } catch (\Throwable $th) {
            $mensaje = Helpers::getMensajeError($th, 'Error al actualizar insumo');
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            return back()->with(compact('mensaje', 'estatus'));
        }
    }

    /**
     * Método que eliminas cuentas de usuarios pedidos
     */
    public function destroy(string $id)
    {
        try {
            $pedido = pedido::findOrFail($id);
            $pedido->delete();

            $mensaje = 'pedido eliminado correctamente.';
            $estatus = Response::HTTP_OK;

            // Redireccionar a la lista de pedidos con un mensaje de éxito
            return back()->with(compact('mensaje', 'estatus'));
        } catch (\Throwable $th) {
            $mensaje = 'Error al eliminar pedido.';
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            return back()->with(compact('mensaje', 'estatus'));
        }
    }



    public function show($pedidoId)
    {
        $mensaje = "¡Ruta no disponible!";
        $estatus = Response::HTTP_NOT_FOUND;
        return redirect()->route('admin.pedidos.index')->with(compact('mensaje', 'estatus'));
    }
    public function edit($pedidoId)
    {
        $mensaje = "¡Ruta no disponible!";
        $estatus = Response::HTTP_NOT_FOUND;
        return redirect()->route('admin.pedidos.index')->with(compact('mensaje', 'estatus'));
    }
}
