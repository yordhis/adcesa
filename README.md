![Logo](public/src/images/logo.png)
# Tienda Online AdcesaPublicidad
Es un sitio web de la empresa Adcesa Publicidad, que ofrece servcio de publicidad y productos publicitarios.
la tienda online se encarga de recibir los pedidos y tambien poseé un Cpanel para lagestion de los pedidos e 
inventario automátizados.

# Módulos del sistema
- ***Pagina web o tienda online***
  - Inicio
  - Servicios y productos
  - Nosotros
    - Historia
    - Equipo
    - Visión
    - Misión
  - Contactanos

- ***Sistema o CPanel***
  - Panel de estadísticas
  - Clientes 
    - Registro, edición y borrado de clientes
  - Proveedores
    - Registro, edición y borrado de proveedores
  - Productos Compuestos
    - Configurar Productos
  - Materia Prima
    - Surtir Stock
  - Gestion y control de ordenes
    - Ordenes
    - Pagos
    - Entregas
  - Configuraciones
    - Usuario
    - Billeteras (Cuentas bancarias y otros)

# Requerimientos
1. Php v8.3.16
2. Node v22.12.0
3. PHP-GD
4. PHP-ZIP
5. Laragon (Para desarrollo) 
6. Bootstraps 5 (NiceAdmin)
7. Laravel Frameword 11.31
8. Blade para el frontend

# Información de despliegue
## Paso 1:
Clonar el proyecto en el servidor de despliegue con el siguiente comando:
~~~
  git clone https://github.com/yordhis/adcesa.git
~~~

## Paso 2:
Acceder al directorio clonado o extraer los archivos a la raíz del servidor, por ejemplo "public_html" y en
caso de trabajar en modo local y usas laragon solo accedes al directorio.
- Accede al directorio:
~~~
  cd adcesa
~~~

- El siguiente comando mueve todo los archivos fuera del directorio para dejarlos en el public_html del servidor:
~~~
  mv /* ../  
~~~

## Paso 3:
Ejecutar Composer el encargado de gestionar los paquetes y librerias del proyecto.
~~~
  composer install
~~~

## Paso 4:
Configurar las variables de entorne en un archivo .env, para eso se debe renombrar el archivo 
.env.example a .env y editar los datos del entorno ejemplo:
~~~
  APP_NAME=Adcesa 
  APP_ENV=local #no modificar
  APP_KEY=
  APP_DEBUG=true #Nota: Para desarrollo se deja en TRUE y para Producción se cambia a FALSE
  APP_TIMEZONE="America/Caracas"
  APP_URL=http://localhost #Colocar el link de producción o dejar el local.
~~~
Tambien se debe configurar la conexión de la base de datos en las variables de entorno de la siguiente manera:

~~~
  DB_CONNECTION=mysql # Aqui se indica el motor de consulta a usar.
  DB_HOST=127.0.0.1
  DB_PORT=3306
  DB_DATABASE=mi_base_de_datos #Aqui va el nombre de la base de datos creada para la web y sistema
  DB_USERNAME=mi_usuairo_bd
  DB_PASSWORD=mi_clave_bd
~~~

## Paso 5:
Despues de configurar las variables de entorno se debe crear el servicio de base de datos o crear la 
base de datos con el nombre indicado en las variables de entorno, y al crear la base de datos te generará 
un usuario y una contraseña los cuales debes colocar en las variables de entorno del archivo *.env* y si estas 
en desarrollo con xampp o laragon el usuario es *root* y la clave va vacia.

## Paso 6:
Al tener todo configurado correctamente e instalado todos los paquetes puedes correr el comando artesano de laravel *artisan*
de la siguiente forma:
~~~
  php artisan 
~~~

Esto deberia arrojarte una descripcion de las funciones de artisan si es asi todo anda correcto,
Ahora bien vamos a usar al artesano *artisan*
- Generar el key token para las varables de entorno
~~~ 
  php artisan key:generate
~~~ 
- Generar el enlace de local storage para el almacenado de las imagenes
~~~
  php artisan storage:link
~~~
- Correr las migraciones y generar datos de prueba
~~~
  php artisan migrate --seed
~~~
Sí solo quieres correr las migraciones usa:
~~~
  php artisan migrate 
~~~
### Sí todo da O.K es hora de levantar el servicio

## Paso 7:
Levantar el servicio
~~~
  php artisan serve
~~~
~~~
  #resultado: http://localhost:8000
~~~
Sí estas usando LARAGON no es necesario ejecutar el comando anterior y tampoco en producción. Laragon generar dominios locales de forma automatica y probablemente sea [Adcesa.test](adcesa.test)

