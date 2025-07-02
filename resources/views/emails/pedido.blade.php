<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Pedido de Servicio</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333333;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 1px solid #3410a0;
        }

        .header h1 {
            color: #333333;
            margin: 0;
            font-size: 24px;
        }

        .content {
            padding: 20px 0;
        }

        .content p {
            line-height: 1.6;
            margin-bottom: 10px;
        }

        .order-details {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 5px;
            margin-top: 20px;
            border: 1px solid #eeeeee;
        }

        .order-details ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .order-details ul li {
            margin-bottom: 8px;
        }

        .order-details ul li strong {
            display: inline-block;
            width: 120px;
            /* Adjust as needed for alignment */
        }

        .button-container {
            text-align: center;
            padding-top: 20px;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            margin: 10px 0;
            background-color: #007bff;
            color: #ffffff;
            text-decoration: none;
            border-radius: 5px;
        }

        .footer {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid #eeeeee;
            font-size: 12px;
            color: #777777;
        }

        .text-danger {
            color: #cc1111e1;
        }

        /** estillos para las tablas */

        /* Estilos generales para el contenedor de la tabla */
        .table-container {
            width: 100%;
            overflow-x: auto;
            /* Permite desplazamiento horizontal en pantallas pequeñas */
            margin: 20px 0;
            border-radius: 8px;
            /* Bordes ligeramente redondeados para el contenedor */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            /* Sombra suave para elevación */
            background-color: #ffffff;
            /* Fondo blanco para el contenedor */
        }

        /* Estilos para la tabla en sí */
        .orders-table {
            width: 100%;
            border-collapse: collapse;
            /* Colapsa los bordes de las celdas */
            font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;
            /* Fuentes modernas */
            color: #333;
            font-size: 14px;
            line-height: 1.5;
        }

        /* Estilos para el encabezado de la tabla (thead) */
        .orders-table thead {
            background-color: #f8f9fa;
            /* Fondo ligeramente gris para el encabezado */
            border-bottom: 2px solid #e9ecef;
            /* Borde inferior para separar del cuerpo */
        }

        /* Estilos para las celdas del encabezado (th) */
        .orders-table th {
            padding: 12px 15px;
            /* Espaciado interno */
            text-align: left;
            /* Alineación del texto a la izquierda */
            font-weight: 600;
            /* Texto seminegrita */
            color: #555;
            /* Color de texto más oscuro */
            text-transform: uppercase;
            /* Texto en mayúsculas */
            letter-spacing: 0.5px;
            /* Espaciado entre letras */
        }

        /* Estilos para las filas del cuerpo de la tabla (tbody tr) */
        .orders-table tbody tr {
            border-bottom: 1px solid #dee2e6;
            /* Borde inferior para cada fila */
            transition: background-color 0.2s ease;
            /* Transición suave al pasar el ratón */
        }

        /* Efecto hover para las filas del cuerpo */
        .orders-table tbody tr:hover {
            background-color: #f1f3f5;
            /* Fondo ligeramente más oscuro al pasar el ratón */
        }

        /* Estilos para las celdas del cuerpo (td) */
        .orders-table td {
            padding: 12px 15px;
            /* Espaciado interno */
            vertical-align: middle;
            /* Alineación vertical al medio */
        }

        /* Estilos para la última fila si es un total o resumen */
        .orders-table tfoot tr {
            background-color: #e9ecef;
            font-weight: bold;
            border-top: 2px solid #dee2e6;
        }

        .orders-table tfoot td {
            padding: 12px 15px;
            text-align: right;
            /* Alinea el total a la derecha */
            color: #222;
        }

     
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            {{-- <h1>{{¡Gracias por tu Pedido!}}</h1> --}}
            <h1>{{ $titulo }}</h1>
        </div>
        <div class="content">
            <p>Hola <b>{{ $cliente->nombres . ' ' . $cliente->apellidos }}</b>.</p>
            <p>Hemos recibido tu pedido de servicio y estamos emocionados de ayudarte. Aquí tienes un resumen de los
                detalles de tu solicitud:</p>

            <div class="order-details">
                <ul>
                    <li><strong>Código de Pedido:</strong> # {{ $pedido->codigo }}</li>
                    <li><strong>Servicio Solicitado:</strong>
                        <div class="table-container">
                            <table class="orders-table">
                                    <tr>
                                        <th><strong>Servicio o producto:</strong></th>
                                        <th><strong>Cantidad:</strong></th>
                                        <th><strong>Precio:</strong></th>
                                        <th><strong>Adicional:</strong></th>
                                        <th><strong>Subtotal:</strong></th>
                                    </tr>
                                @foreach ($carrito as $item)
                                    <tr>
                                        <td> {{ $item->nombre_producto }}</td>
                                        <td> {{ $item->cantidad }}</td>
                                        <td> {{ $item->precio }}</td>
                                        <td> {{ count($item->imagenes_adicionales) ? count($item->imagenes_adicionales) * 10 : 0}}</td>
                                        <td>{{ $item->sub_total }}</td>
    
                                    </tr>
                                @endforeach
                            </table>
                        </div>

                    </li>
                    <li><strong>Fecha del Pedido:</strong>
                        {{ \Carbon\Carbon::parse($pedido->created_at)->format('d-m-Y H:i') }}</li>
                    <!-- <li><strong>Fecha/Hora Programada:</strong> [**FECHA_HORA_PROGRAMADA**] (Si aplica)</li> -->
                    <li><strong>Costo Total REF:</strong> {{ number_format($pedido->total_a_pagar, 2, ',', '.') }} $
                    </li>
                    <li><strong>Costo Total:</strong>
                        {{ number_format($pedido->total_a_pagar * $tasa->tasa, 2, ',', '.') }} Bs</li>
                    <li><strong>Estado Actual:</strong> <span class="text-danger">{{ $pedido->estatus }}</span> </li>
                </ul>
            </div>

            <p>Nuestro equipo revisará tu solicitud y se pondrá en contacto contigo en breve para confirmar los detalles
                y los próximos pasos.
                Si tienes alguna pregunta, no dudes en responder a este correo electrónico
                o contactarnos por Whatsapp.</p>

            @if ($tipoDeReceptor == 'CLIENTE')
                <div class="button-container">
                    <a href="{{ route('page.cliente.perfil', $cliente->id) }}" class="button">Ver Detalles de tu
                        Pedido</a>
                </div>
            @else
                <div class="button-container">
                    <a href="{{ route('admin.pedidos.index') }}?filtro={{ $pedido->codigo }}" class="button">ATENDER
                        PEDIDO</a>
                </div>
            @endif

            <p>Gracias por elegirnos.</p>
            <p>Saludos cordiales,</p>
            <p>El equipo de Adcesa Publicidad C,A.</p>
        </div>
        <div class="footer">
            <p>&copy; 2025 Adcesa Publicidad C,A. Todos los derechos reservados.</p>
            <p><a href="{{ asset('assets/documentos/terminos_y_condiciones.pdf') }}" target="_blank"
                    style="color: #007bff; text-decoration: none;">Términos y Condiciones</a></p>
        </div>
    </div>
</body>

</html>
