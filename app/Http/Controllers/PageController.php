<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePedidoRequest;
use App\Models\DataDev;
use App\Models\Helpers;
use App\Models\Insumo;
use App\Models\InsumoToProducto;
use App\Models\Medida;
use App\Models\Pedido;
use App\Models\Producto;
use App\Models\User;
use App\Models\Variante;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Nette\Utils\Strings;

class PageController extends Controller
{
    // Landinpage
    public function index(Request $request)
    {
        try {
            $productos = Producto::orderBy('created_at', 'desc')
                ->where('estatus', 'ACTIVO')
                ->get();
            $respuesta = DataDev::$respuesta;
            return view('page.home.index', compact('respuesta', 'productos', 'request'));
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /** muestra la vista de Crear pedido */
    public function createPedido(Request $request, $id)
    {
        try {
            $medidas = Medida::orderBy('nombre', 'ASC')->get();
            $producto = Producto::findOrFail($id);
            $producto['variantes'] = Variante::where('id_producto', '=', $producto->id)->get();
            $producto['insumos'] = InsumoToProducto::where('id_producto', '=', $producto->id)->get();

            foreach ($producto['insumos'] as $key => $insumo) {
                $insumo['nombre'] = Insumo::find($insumo->id_insumo)->nombre;
            }

            foreach ($producto['variantes'] as $key => $variante) {
                $variante['area'] = $variante->alto * $variante->ancho;
                $variante['medida'] = $medidas->find($variante->id_medida)->nombre;
                $variante['simbolo'] = $medidas->find($variante->id_medida)->simbolo;
            }

            $respuesta = DataDev::$respuesta;
            return view('page.pedidos.index', compact('respuesta', 'producto', 'request'));
        } catch (\Throwable $th) {
            $mensaje = Helpers::getMensajeError($th, 'Error al retornar la vista de crear pedido');
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            return back()->with(compact('mensaje', 'estatus'));
        }
    }

    public function storePedido(StorePedidoRequest $request)
    {
        try {
            return $request->all();
            /** si el cliente esta autenticado */
            if (Auth::user()) {
                // Consultamosal cliente
                $cliente = User::findOrFail(Auth::user()->id);
            }

            /** Registrar Pago */
            /** Registrar Pedido */
            /** Registrar Carrito */
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
            return view('page.fin', compact('mensaje', 'estatus'));
        } catch (\Throwable $th) {
            $mensaje = $th->getMessage() ?? 'Error al registrar el pedido verifique los datos suministrados!';
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            return back()->with(compact('mensaje', 'estatus'))->withInput($request->all());
        }
    }

    /** Setear el servico o producto en una session y ir a la seccion de pago o seguir comprando */
    public function agregarAlCarrito(Request $request)
    {
        try {
            // Validar segun el tipo del producto
            if ($request->tipo_producto) {
                // Validar inputs
                $request->validate([
                    'id_variante' => 'required',
                    'id_producto' => 'required',
                    'tipo_producto' => 'required',
                    'det_color_fondo' => 'required',
                    'det_color_letras' => 'required',
                    'det_letra_acrilica' => 'required',
                    'det_iluminacion' => 'required',
                    'imagen_radio' => 'required',
                    'det_frase_letra_acrilica' => 'nullable | max:255',
                    'det_descripcion' => 'nullable | max:255',
                    'cantidad' => 'required | numeric',
                    'precio' => 'required | numeric',
                    'precioUnitario' => 'required | numeric',
                    'files.*' => 'image | mimes:jpeg,png,jpg|max:2048'
                ]);
            } else {
                // Validar inputs
                $request->validate([
                    'id_producto' => 'required',
                    'tipo_producto' => 'required',
                    'cantidad' => 'required | numeric',
                    'precio' => 'required | numeric', // subtotal
                    'precioUnitario' => 'required | numeric', // precio por cada uno
                ]);
            }


            // Configurar las imagens adicionales
            $imagenesGuardadas = [];
            if ($request->hasFile('files')) {
                $imagenesGuardadas = Helpers::setFiles($request);
            }


            // Obtener los datos del productos y los complementarios
            $producto = Producto::findOrFail($request->id_producto);

            // Obtenemos lo que halla en el carrito 
            $carritoWeb = session('carrito') ?? [];

            /** 
             * Si el tipo del producto es no compuesto verificamos si ya esta en el carrito para 
             * Sumar le uno
             */
            $banderaDeProductoEnCarrito = false;
            if ($request->tipo_producto == 0) {
                foreach ($carritoWeb as $key => $productoEnCarrito) {
                    if ($productoEnCarrito['id_poducto'] == $request->id_producto) {
                        $banderaDeProductoEnCarrito = true;
                        $productoEnCarrito['cantidad'] = $productoEnCarrito['cantidad'] + 1;
                        $productoEnCarrito['subtotal'] = $productoEnCarrito['precio'] * $productoEnCarrito['cantidad'];
                        $carritoWeb[$key] = $productoEnCarrito;
                    }
                }
            }

            if (!$banderaDeProductoEnCarrito) {
                // Agregamos el nuevo pedido o producto
                if ($request->tipo_producto) {
                    $mas_detalles = Helpers::getArrayAssocInputs($request->all(), 'det');
                    $variante = Variante::findOrFail($request->id_variante);
                    $medida = Medida::findOrFail($variante->id_medida);

                    array_push($carritoWeb, [
                        "id_poducto" => $request->id_producto,
                        "id_variante"  => $request->id_variante,
                        "nombre_producto" => $producto->nombre,
                        "imagen" => $producto->imagen,
                        "tipo_producto" => $producto->tipo_producto,
                        "alto_variante" => $variante->alto,
                        "ancho_variante" => $variante->ancho,
                        "medida_variante" => $medida->simbolo,
                        "mas_detalles" => $mas_detalles,
                        "imagenes_adicionales" =>  $imagenesGuardadas,
                        "cantidad" => $request->cantidad,
                        "precio" => $request->precioUnitario,
                        "precio_adicional" => count($imagenesGuardadas) * 10,
                        "subtotal" => $request->precio,
                    ]);
                } else {
                    array_push($carritoWeb, [
                        "id_poducto" => $request->id_producto,
                        "nombre_producto" => $producto->nombre,
                        "imagen" => $producto->imagen,
                        "tipo_producto" => $producto->tipo_producto,
                        "cantidad" => $request->cantidad,
                        "precio" => $request->precioUnitario,
                        "subtotal" => $request->precio,
                    ]);
                }
            }

            // Insertamos a la session del carrito todos los productos
            session(['carrito' => $carritoWeb]);

            // Mensaje de respuesta
            $mensaje = "Servicio o producto se agrego al carrito correctamente";
            $estatus = Response::HTTP_OK;

            // Validar hacia donde redirigir
            if ($request->vista == 'vista_pago') {
                // Redireccionamos a la vista de pago
                return redirect()->route('page.finalizar.pedido.vista')
                    ->with(compact('mensaje', 'estatus'));
            } else {
                // Redireccionamos a la vista de inicio
                return redirect()->route('page.index', '#servicios')
                    ->with(compact('mensaje', 'estatus'));
            }
        } catch (\Throwable $th) {
            $mensaje = $th->getMessage() ?? 'Error al configurar el pedido verifique los datos suministrados!';
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            return back()->with(compact('mensaje', 'estatus'))->withInput($request->all());
        }
    }

    /** 
     * En esta vista se le solicitara al cliente ingresar informacion personal y de pago
     */
    public function vistaFinalizarPedido(Request $request)
    {
        try {
            $respuesta = DataDev::$respuesta;
            return view('page.pagos.index', compact('respuesta'));
        } catch (\Throwable $th) {
            $mensaje = $th->getMessage() ?? 'Error al configurar el pedido verifique los datos suministrados!';
            $estatus = Response::HTTP_INTERNAL_SERVER_ERROR;
            return back()->with(compact('mensaje', 'estatus'))->withInput($request->all());
        }
    }

    /** Vista de registro de cliente */
    public function crearSesion(Request $request)
    {
        $respuesta = DataDev::$respuesta;
        return view('page.clientes.index', compact('respuesta'));
    }

    /** Vista del perfil del cliente */
    public function mostraPerfil(Request $request, $id)
    {
        $cliente = User::find($id);
        $respuesta = DataDev::$respuesta;
        return view('page.clientes.perfil', compact('respuesta', 'cliente'));
    }
}
