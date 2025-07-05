<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedido</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .container {
            max-width: 600px;
            margin: 30px auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .header {
            background-color: #007bff;
            /* Color principal de Adcesa, ajusta si es diferente */
            color: #ffffff;
            padding: 30px 25px;
            text-align: center;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 700;
        }

        .content {
            padding: 25px;
            line-height: 1.6;
            color: #555;
        }

        .content p {
            margin-bottom: 15px;
            font-size: 16px;
        }

        .content ul {
            list-style: none;
            padding: 0;
            margin: 20px 0;
        }

        .content ul li {
            background-color: #e9f7ff;
            /* Un azul claro para destacar */
            padding: 12px 20px;
            margin-bottom: 10px;
            border-left: 4px solid #007bff;
            border-radius: 4px;
            font-size: 15px;
        }

        .button_details-container {
            text-align: center;
            padding: 10px 25px 25px;
        }

        .button_details {
            display: inline-block;
            background-color: #00ffbf;
            color: #ffffff;
            padding: 8px 15px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 12px;
            font-weight: 600;
            transition: background-color 0.3s ease;
        }

        .button_details:hover {
            background-color: #c7d8dc;
        }

        .button-container {
            text-align: center;
            padding: 10px 25px 25px;
        }

        .button {
            display: inline-block;
            background-color: #28a745;
            /* Un verde vibrante para el botón, ajusta si es necesario */
            color: #ffffff;
            padding: 12px 25px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 17px;
            font-weight: 600;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #218838;
        }

        .footer {
            background-color: #f8f9fa;
            color: #777;
            text-align: center;
            padding: 20px 25px;
            font-size: 13px;
            border-bottom-left-radius: 8px;
            border-bottom-right-radius: 8px;
            border-top: 1px solid #eee;
        }

        .footer a {
            color: #007bff;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        .logo {
            margin-bottom: 20px;
            max-width: 150px;
            /* Ajusta el tamaño del logo */
        }

        /** Btn estatus */
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
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>{{ $titulo ?? 'Pedido'}} # {{ $pedido->codigo }}</h1>

        </div>
        <div class="content">
            <p>Estimado/a cliente <b>{{ $pedido->nombres_cliente . ' ' . $pedido->apellidos_cliente }}</b></p>
            <p>Gracias por confiar en nosotros para potenciar tu marca y alcanzar tus objetivos de comunicación.</p>

            <h3>Detalles de su pedido:</h3>
            <ul>
                <li>Estatus del pedido:
                    <button class="btn-status {{ strtolower(str_replace(' ', '-', $pedido->estatus)) }}">
                        {{ $pedido->estatus }}
                    </button>
                </li>
                <li>
                    @if ($pedido->id_cliente)
                        <a href="{{ route('page.cliente.perfil', $pedido->id_cliente) }}" class="button_details">Ver detalle del
                            pedido</a>
                    @endif
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

        </div>
        <div class="button-container">
            <p>¿Necesitas algo o tienes alguna pregunta?</p>
            <a href="https://wa.me/584245104676?text=Hola me gustaria saber más sobre sus servicio publicitarios"
                class="button">Contáctanos por Whatsapp</a>

        </div>
        <div class="content">
            <p>Para empezar, te invitamos a explorar:</p>
            <p>
                <a href="{{ route('page.index') }}#servicios" style="color: #007bff; text-decoration: none;">Nuestros
                    Servicios y productos</a><br>

            </p>
            <p>¡Esperamos construir una relación duradera y exitosa contigo!</p>
            <p>Saludos cordiales,</p>
            <p>El Equipo de **Adcesa Publicidad**</p>
        </div>
        <div class="footer">
            <p>&copy; 2025 Adcesa Publicidad. Todos los derechos reservados.</p>
            <p>Visita nuestro sitio web: <a href="{{ route('page.index') }}">{{ route('page.index') }}</a></p>
            <p>Síguenos en <a href="https://www.instagram.com/adcesapublicidad?igsh=cGh3b3dqZ3RlZWZq">Instagram</a></p>
        </div>
    </div>
</body>

</html>
