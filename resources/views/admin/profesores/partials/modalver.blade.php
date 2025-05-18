
        
<!-- Vertically centered Modal -->
<a type="button" class="mb-3" data-bs-toggle="modal" data-bs-target="#modalVer{{$profesor->id}}">
    <i class="bi bi-eye "></i>
</a>

<div class="modal fade" id="modalVer{{$profesor->id}}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">Datos del profesor</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="card" >
                <img src="{{asset($profesor->foto)}}" class="card-img-top w-25" alt="foto">
                <div class="card-body">
                  <h5 class="card-title fs-2">{{ $profesor->nombre }}</h5>
                  <p class="card-text"> Cédula: {{ $profesor->nacionalidad . "-" .$profesor->cedula }} </p>
                  <p class="card-text"> Teléfono: {{ $profesor->telefono }} </p>
                  <p class="card-text"> Correo: {{ $profesor->correo }} </p>
                  <p class="card-text"> Dirección: {{ $profesor->direccion }} </p>
                  <p class="card-text"> Fecha de nacimiento: {{ $profesor->nacimiento }} 🥳 </p>
                  <p class="card-text"> Edad: {{ $profesor->edad }} </p>
                  
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item fs-4 text-primary">Grupos de estudios asignados</li>
                    @if (!count($profesor->grupos_estudios))
                        <li class="list-group-item fs-4 text-primary">
                            No tiene grupo asignado
                            <a href="{{route('admin.grupos.index')}}">Ir a asignar grupo <i class="bi  bi-box-arrow-up-right"></i> </a>
                        </li>
                    @else
                        @foreach ($profesor->grupos_estudios as $grupo)
                        <li class="list-group-item">
                            <a href="{{route('admin.grupos.index', ['filtro' => $grupo->codigo]) }}">
                                {{ $grupo->codigo . "-" . $grupo->nombre }} <i class="bi  bi-box-arrow-up-right"></i>
                            </a>
                        </li>
                        @endforeach
                    @endif

                    

                </ul>
              </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        </div>
    </div>
    </div>
</div><!-- End Vertically centered Modal-->


