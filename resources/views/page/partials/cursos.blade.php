<figure class="text-center my-5">
    <blockquote class="blockquote text-primary fs-2">
        <p>¡Cursos para todas las edades!</p>
    </blockquote>
    <figcaption class="blockquote-footer">
        "Aprende de la manera más divertida a través de juegos, canciones, actividades y conversaciones." <cite
            title="Source Title">Maryland</cite>
    </figcaption>
</figure>
<div class="container">
    <div class="col-12">
        <p class="fs-1">Niños</p>
    </div>
    <div class="row row-cols-1 row-cols-md-3 g-4" id="ninios">
        @foreach ($niveles as $nivel)
            @if ($nivel->tipo_nivel == 'ninio')
                <div class="col">
                    <div class="card h-100">
                        <img src="{{ asset($nivel->imagen) }}" class="card-img-top" alt="imagen-nivel">
                        <div class="card-body">
                            <h5 class="card-title">{{ $nivel->nombre }}</h5>
                            <p class="card-text">
                                Lapso: {{ $nivel->duracion . ' ' . $nivel->tipo_duracion }} <br>
                                Tipo: {{ $nivel->tipo_nivel == 'ninio' ? 'Niño' : 'Adulto' }}
                            </p>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('page.preinscripcion.index', $nivel->codigo) }}">
                                    <button class="btn btn-outline-primary">
                                        <i class="bi bi-feather"></i>
                                        Pre-inscribir me
                                    </button>
                                </a>
                                <p class="text-success fs-4">¡Oferta! 
                                    {{-- <i class="bi bi-currency-dollar"></i> --}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
    <div class="col-12 mt-5">
        <p class="fs-1">Adultos</p>
    </div>
    <div class="row row-cols-1 row-cols-md-3 g-4" id="adultos">
        @foreach ($niveles as $nivel)
            @if ($nivel->tipo_nivel == 'adulto')
                <div class="col">
                    <div class="card h-100">
                        <img src="{{ asset($nivel->imagen) }}" class="card-img-top" alt="imagen-nivel">
                        <div class="card-body">
                            <h5 class="card-title">{{ $nivel->nombre }}</h5>
                            <p class="card-text">
                                Lapso: {{ $nivel->duracion . ' ' . $nivel->tipo_duracion }} <br>
                                Tipo: {{ $nivel->tipo_nivel == 'ninio' ? 'Niño' : 'Adulto' }}
                            </p>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('page.preinscripcion.index', $nivel->codigo) }}">
                                    <button class="btn btn-outline-primary">
                                        <i class="bi bi-feather"></i>
                                        Pre-inscribir me
                                    </button>
                                </a>
                                <p class="text-success fs-4">¡Oferta! 
                                    {{-- <i class="bi bi-currency-dollar"></i> --}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</div>
