<div class="container-fluid my-5">
    <div class="col-12 text-center">
      <h2 class="fs-2 text-dark">Seleccione un plan de pago</h2>
    </div>
    <div class="row row-cols-1 row-cols-md-4 g-4">
        @foreach ($planes as $plan)
            <div class="col">
                <div class="card h-100">
                    <div class="card-header text-center">
                        <b class="fs-4 text-primary">
                            {{ $plan->nombre }}
                        </b>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Descripción</h5>
                        <p class="card-text">{{ $plan->descripcion }}</p>
                        <p class="card-text">
                            <b>Plazo:</b> {{ $plan->plazo . ' Días' }} <br>
                            {{-- <b>Descuento:</b> {{ $plan->porcentaje_descuento }} % <br> --}}
                            <b>Matricular:</b> {{ $plan->cantidad_estudiantes }} <br>
                            <b>Cuotas:</b> {{ $plan->cantidad_cuotas }} <br>
                        </p>

                    </div>
                    <div class="card-footer text-center">
                        <a href="{{ route('page.preinscripcion.estudiante', [$nivelSolicitado->codigo, $plan->codigo]) }}" class="btn btn-primary w-100">Seleccionar plan</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

</div>
