<div class="container">
    <div class="row border border-muted rounded-5 mt-5">
        <div class="col-12 ">
            <h2 class="fs-2 text-center">
                Carrito
            </h2>
        </div>
        <div class="col-sm-6 col-xs-12">
            @if ($nivelSolicitado)
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="{{ asset($nivelSolicitado->imagen) }}" class="img-fluid rounded-start"
                                alt="img-nivel">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title text-uppercase"><b>Nivel:</b> {{ $nivelSolicitado->nombre }}</h5>
                                <p class="card-text">
                                    <b>Precio:</b> {{ $nivelSolicitado->precio }} $
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @if ($planSolicitado)
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="{{ asset('assets/img/registro.png') }}" class="img-fluid rounded-start"
                                alt="img-plan">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title text-uppercase"><b>Plan: </b>{{ $planSolicitado->nombre }}</h5>
                                <p class="card-text">
                                    <b>Descuento:</b> {{ $planSolicitado->porcentaje_descuento }} % <br>
                                    <b>Cuotas:</b> {{ $planSolicitado->cantidad_cuotas }} <br>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @if (count($estudiantesRegistrados))
                @foreach ($estudiantesRegistrados as $estudiante)
                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="{{ asset($estudiante->foto) }}" class="img-fluid rounded-start"
                                    alt="img-plan">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 class="card-title text-uppercase"><b>Estudiante:</b> {{ $estudiante->nombre }}
                                    </h5>
                                    <p class="card-text">
                                        <b>DNI:</b> {{ $estudiante->nacionalidad . '-' . $estudiante->cedula }} <br>
                                        <b>Edad:</b> {{ $estudiante->edad }} <br>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="col-sm-6 col-xs-12">
            @if ($planSolicitado)
                @if (!session('esMenorDeEdad'))
                    @if (!($totalDeRegistros < $planSolicitado->cantidad_estudiantes))
                        @include('page.partials.formularioDePago')
                    @endif
                @endif
            @endif
        </div>
    </div>

</div>
