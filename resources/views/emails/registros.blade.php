<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>¡Bienvenido a Adcesa Publicidad!</title>
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
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>¡Bienvenido a Adcesa Publicidad!</h1>
        </div>
        <div class="content">
            <p>Estimado/a cliente, {{ $user->nombres . ' ' . $user->apellidos }}</p>
            <p>En **Adcesa Publicidad**, estamos encantados de darte la bienvenida a nuestra familia. Gracias por
                confiar en nosotros para potenciar tu marca y alcanzar tus objetivos de comunicación. Nos entusiasma
                comenzar este camino contigo.</p>

            <p>Conocemos la importancia de una **presencia fuerte y estratégica**. Nuestro equipo está listo para
                ofrecerte soluciones creativas y efectivas en:</p>
            <ul>
                <li>Diseño Gráfico y creación de recursos publicitarios</li>
            </ul>
            @if ($clave)
                <ul>
                    <li>Clave Por defecto: {{ $clave }}</li>
                </ul>
            @endif

            <p>Estamos comprometidos con tu éxito y con brindarte un servicio excepcional. Queremos que tu experiencia
                con nosotros sea fluida y productiva desde el primer día.</p>
        </div>
        <div class="button-container">
            <p>¿Necesitas algo o tienes alguna pregunta?</p>
            <a href="https://wa.me/584245104676?text=Hola me gustaria saber más sobre sus servicio publicitarios" class="button">Contáctanos por Whatsapp</a>
        </div>
        <div class="content">
            <p>Para empezar, te invitamos a explorar:</p>
            <p>
                <a href="{{ route('page.index')}}#servicios"
                    style="color: #007bff; text-decoration: none;">Nuestros Servicios y productos</a><br>
    
            </p>
            <p>¡Esperamos construir una relación duradera y exitosa contigo!</p>
            <p>Saludos cordiales,</p>
            <p>El Equipo de **Adcesa Publicidad**</p>
        </div>
        <div class="footer">
            <p>&copy; 2025 Adcesa Publicidad. Todos los derechos reservados.</p>
            <p>Visita nuestro sitio web: <a href="{{ route('page.index')}}">{{ route('page.index')}}</a></p>
            <p>Síguenos en <a href="https://www.instagram.com/adcesapublicidad?igsh=cGh3b3dqZ3RlZWZq">Instagram</a></p>
        </div>
    </div>
</body>

</html>
