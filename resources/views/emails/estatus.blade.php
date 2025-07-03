<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estatus del pedido</title>
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
            width: 100%;
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

        .btn-status {
            display: inline-block;
            padding: 4px 14px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: bold;
            color: #fff;
            border: none;
            margin: 2px 0;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-status.pendiente {
            background: #c80505d7;
        }

        .btn-status.aprobado,
        .btn-status.pago-verificado {
            background: #05c83fd7;
        }

        .btn-status.en-proceso {
            background: #c89405d7;
            color: #222;
        }

        .btn-status.entregado {
            background: #0d6efd;
        }

        .btn-status.rechazado,
        .btn-status.pago-rechazado {
            background: #2b2f2cd7;
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
            <h1>Estatus del pedido</h1>
        </div>
        <div class="content">
            <p>Hola <b>{{ $pedido->nombres_cliente . ' ' . $pedido->apellidos_cliente }}</b>.</p>
            <p>Tu pedido a cambiado de estatus, ver los siguientes detalles:</p>

            <div class="order-details">
                <ul>
                    <li><strong>Código de Pedido:</strong> # {{ $pedido->codigo }}</li>
                    <li><strong>Estatus del pedido:</strong>
                        {{-- <button
                            class="fw-bold btn
                                        {{ $pedido->estatus == 'PENDIENTE' ? 'btn-danger' : '' }}    
                                        {{ $pedido->estatus == 'APROBADO' ? 'btn-success' : '' }}    
                                        {{ $pedido->estatus == 'PAGO VERIFICADO' ? 'btn-success' : '' }}    
                                        {{ $pedido->estatus == 'EN PROCESO' ? 'btn-warning' : '' }}    
                                        {{ $pedido->estatus == 'ENTREGADO' ? 'btn-primary' : '' }}    
                                        {{ $pedido->estatus == 'RECHAZADO' ? 'btn-secondary' : '' }}    
                                        {{ $pedido->estatus == 'PAGO RECHAZADO' ? 'btn-danger' : '' }}    
                            ">
                            {{ $pedido->estatus }}
                        </button> --}}
                        <button class="btn-status {{ strtolower(str_replace(' ', '-', $pedido->estatus)) }}">
                            {{ $pedido->estatus }}
                        </button>
                    </li>
                    @if ($pedido->fecha_inicio)
                        <li><strong>Fecha de inicio de atención de su solicitud:</strong>
                            {{ \Carbon\Carbon::parse($pedido->fecha_inicio)->format('d-m-Y') }}</li>
                    @endif

                    @if ($pedido->fecha_entrega)
                        <li>
                            @if ($pedido->estatus == 'ENTREGADO')
                                <strong>Pedido entregado la fecha:</strong>
                            @else
                                <strong>Fecha de entrega del producto o servicio solicitado:</strong>
                            @endif
                            {{ \Carbon\Carbon::parse($pedido->fecha_entrega)->format('d-m-Y') }}
                        </li>
                    @endif


                </ul>
            </div>

            @if ($pedido->estatus == 'ENTREGADO')
                <p>
                    ¡Gracias por su paciencia!. Ya el producto o servicio fue entregado.
                </p>
            @else
                <p>Nuestro equipo estará trabajando en tu solicitud para dar respuesta lo más pronto posible y se pondrá
                    en
                    contacto contigo
                    para los próximos pasos.
                    Si tienes alguna pregunta, no dudes en responder a este correo electrónico
                    o contactarnos por Whatsapp.</p>
            @endif

            @if ($pedido->id_cliente)
                <div class="button-container">
                    <a href="{{ route('page.cliente.perfil', $pedido->id_cliente) }}" class="button">Ver Detalles de tu
                        Pedido</a>
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
