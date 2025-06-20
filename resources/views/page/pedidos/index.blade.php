@extends('layouts.page')

@section('title', 'Crear Pedido')

@section('content')
    @if (session('mensaje'))
        @include('partials.alert')
    @endif

    <div class="container">
        <div class="row">
            <h1 class="text-center my-4">{{ $producto->tipo_producto ? 'SERVICIO' : 'PRODUCTO' }}</h1>
            <div class="col-sm-6 col-xs-12">
                <div class="card mb-4">
                    <img src="{{ asset($producto->imagen) }}" class="card-img-top" alt="imagen-producto">
                    <div class="card-body">
                        <h5 class="card-title fs-3 fw-bold">{{ $producto->nombre }}</h5>
                        <p class="card-text">
                            <b>Descripción:</b> {{ $producto->descripcion . ' ' . $producto->tipo_duracion }} <br>
                        </p>
                        @if (!$producto->tipo_producto)
                            <p class="text-success fs-4">
                                {{ $producto->precio ? $producto->precio : 'no disponible' }}
                                <i class="bi bi-currency-dollar"></i>
                            </p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xs-12">
                <div class="card mb-4">
                    <div class="card-header bg-primary">
                        <h5 class="card-title fs-3 text-center  text-white">Detalles del Pedido</h5>
                    </div>
                    <div class="card-body p-4">
                        {{-- <p class="text-center">Por favor, ingresa la cantidad que deseas pedir.</p> --}}
                        <form action="{{ route('page.store.pedido') }}" method="post">
                            @csrf
                            @method('POST')
                            <input type="hidden" name="producto_id" value="{{ $producto->id }}">
                            <input type="hidden" name="tipo_producto" value="{{ $producto->tipo_producto }}">

                            <!-- Seleccione medidas -->
                            <div class="my-3">
                                <label for="cantidad" class="form-label fs-4">Seleccione medida</label>
                                @foreach ($producto->variantes as $variante)
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="radioVariante"
                                            id="radioVariante{{ $variante->id }}" value="{{ $variante->id }}">
                                        <label class="form-check-label" for="radioVariante{{ $variante->id }}">
                                            {{ $variante->ancho }} x {{ $variante->alto }} ({{ $variante->simbolo }}2) -
                                            Precio:
                                            {{ $variante->precio }} <i class="bi bi-currency-dollar"></i>
                                        </label>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Colores -->
                            <div class="d-flex flex-row justify-content-between mb-3 fs-5">
                                <!-- Color de fondo -->
                                <div class="my-3">
                                    <label for="color_fondo" class="form-label">Seleccione color de fondo</label>
                                    <input type="color" class="form-control form-control-color" name="color_fondo"
                                        id="color_fondo" value="#563d7c" title="Choose your color">
                                </div>

                                <!-- Color de letras -->
                                <div class="my-3">
                                    <label for="color_letras" class="form-label">Seleccione color de letras</label>
                                    <input type="color" class="form-control form-control-color" name="color_letras"
                                        id="color_letras" value="#563d7c" title="Choose your color">
                                </div>
                            </div>

                            <!-- Letras acrílicas -->
                            <div class="my-3">
                                <label for="cantidad" class="form-label fs-4">¿Desea que tenga letras acrílicas?</label>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="letra_acrilica" value="si"
                                        id="letra_acrilica1">
                                    <label class="form-check-label" for="letra_acrilica1">
                                        Si, deseo letras acrílicas.
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="letra_acrilica" value="no"
                                        id="letra_acrilica2" checked>
                                    <label class="form-check-label" for="letra_acrilica2">
                                        No, no deseo letras acrílicas.
                                    </label>
                                </div>
                            </div>

                            <!-- Frase para las letras -->
                            <div class="form-floating my-3">
                                <textarea class="form-control" placeholder="Leave a comment here" name="frase_letra_acrilica" id="frase_letra_acrilica"
                                    style="height: 100px"></textarea>
                                <label for="frase_letra_acrilica">¿Palabra o frase para las letras?</label>
                            </div>

                            <!-- Iluminación -->
                            <div class="my-3">
                                <label for="cantidad" class="form-label fs-4">¿Desea que tenga iluminación?</label>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="iluminacion" value="si"
                                        id="iluminacion1">
                                    <label class="form-check-label" for="iluminacion1">
                                        Si, deseo iluminación.
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="iluminacion" value="no"
                                        id="iluminacion2" checked>
                                    <label class="form-check-label" for="iluminacion2">
                                        No, no deseo iluminación.
                                    </label>
                                </div>
                            </div>

                            <!-- Imagen adicional -->
                            <div class="my-3">
                                <label for="cantidad" class="form-label fs-4">¿Desea agregarle alguna imagen, logo, figura
                                    adicional en acrílico a su aviso?
                                    <small class="text-muted">(cada elemento adicional tiene un costo de
                                        10$)</small></label>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="imagen_radio" value="si"
                                        id="imagen_radio1">
                                    <label class="form-check-label" for="imagen_radio1">
                                        Si, deseo agregar mas elementos.
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="imagen_radio" value="no"
                                        id="imagen_radio2" checked>
                                    <label class="form-check-label" for="imagen_radio2">
                                        No, no deseo agregar mas elementos.
                                    </label>
                                </div>
                            </div>
                            <!-- Carga de archivos -->
                            <div class="my-3">
                                <div class="my-3">
                                    <label for="formFileMultiple" class="form-label fs-4">Cargar archivos adicionales</label>
                                    <input class="form-control" type="file" id="formFileMultiple" multiple>
                                </div>
                            </div>
                            <!-- Describa el diseño -->
                            <div class="form-floating my-3">
                                <textarea class="form-control" placeholder="Leave a comment here" name="descripcion" id="descripcion"
                                    style="height: 100px"></textarea>
                                <label for="descripcion">Describa el diseño</label>
                            </div>

                            <!-- Cantidad -->
                            <div class="my-3">
                                <label for="cantidad" class="form-label">Cantidad</label>
                                <input type="number" class="form-control" id="cantidad" name="cantidad"
                                    min="1" value="1" required>
                            </div>

                            <!-- Precio -->
                            <div class="my-3">
                                <label for="precio" class="form-label">Precio</label>
                                <input type="number" class="form-control" id="precio" name="precio" min="0"
                                    step="any" readonly required>
                            </div>
                            <button type="submit" class="btn btn-success">Finalizar Pedido</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
