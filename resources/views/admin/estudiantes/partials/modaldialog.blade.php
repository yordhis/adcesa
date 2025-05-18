 <!-- Modal Dialog Scrollable -->
 <a type="button" class="" data-bs-toggle="modal" data-bs-target="#modalDialogScrollable{{$estudiante->id}}">
    <i class="bi bi-eye fs-4"></i>
 </a>
  <div class="modal fade" id="modalDialogScrollable{{$estudiante->id}}" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Informacion del estudiante</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <section class="section profile">
            <div class="row">

              <div class="col-xl-12">

                <div class="card">
                  <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                    <img src="{{ asset($estudiante->foto) }}" alt="Profile" class="rounded-circle">
                    <h2>  {{ $estudiante->nombre }}</h2>
                    <h3>{{ $estudiante->edad }} Años</h3>

                    <div class="container-fluid">
                      <div class="row">
                        <hr>
                        <div class="col-md-12">
                          <h3>Datos Perosnales</h3>
                        </div>

                        <div class="col-md-12 label"> 
                          <span class="text-primary">Cédula:</span> {{ $estudiante->nacionalidad }}-{{ $estudiante->cedula }} 
                        </div>

                        <div class="col-md-12 label"> 
                          <span class="text-primary">Teléfono:</span> {{ $estudiante->telefonoFormateado }} 
                        </div>

                        <div class="col-md-12 label"> 
                          <span class="text-primary">Correo:</span> {{ $estudiante->correo }}
                        </div>

                        <div class="col-md-12 label"> 
                          <span class="text-primary">Fecha de nacimiento:</span> 
                          @empty($estudiante->nacimiento)
                          {{ isset($estudiante->nacimiento) ? date_format(date_create($estudiante->nacimiento), "d-m-Y") : "" }}
                          
                          @endempty
                        </div>

                        <div class="col-md-12 label"> 
                          <span class="text-primary">Dirección de domicilio:</span> {{ $estudiante->direccion }}
                        </div>
                        <div class="col-md-12 label"> 
                          <span class="text-primary">Mi dificultad de aprendizaje:</span> 

                          @if(isset( $estudiante->dificultades ))
                            @php
                                $sinDificulta = true;
                            @endphp
                            @foreach ($estudiante->dificultades as $dificultad)
                              @if($dificultad->estatus)
                                @php
                                    $sinDificulta = false;
                                @endphp
                                {{$dificultad->dificultad}} /
                              @endif
                            @endforeach

                            @if ($sinDificulta)
                              <span class="text-default">No posee dificultad</span>
                            @endif
                          @endif
                          
                        </div>
                     
                   
                        
                      </div>
                    </div>
                  </div>
                </div>
      
              </div>
              {{-- Card Representante del estudiante --}}
              <div class="col-xl-12">

                <div class="card">
                  <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                   

                    <div class="container-fluid">
                      <div class="row">
                        <hr>
                        <div class="col-md-12">
                          <h3>Datos Del Representante</h3>
                        </div>

                        @if( $estudiante->representante	)
            
                              
                            <div class="col-md-12 label"> 
                              <span class="text-primary">Nombre:</span> {{ $estudiante->representante->nombre ?? ''}} 
                            </div>
                            <div class="col-md-12 label"> 
                              <span class="text-primary">Cédula:</span> {{ $estudiante->representante->cedula ?? '' }} 
                            </div>
                            <div class="col-md-12 label"> 
                              <span class="text-primary">Cumpleaños:</span> {{ $estudiante->representante->nacimiento ?? '' }} 
                            </div>
                            <div class="col-md-12 label"> 
                              <span class="text-primary">Edad:</span> {{ $estudiante->representante->edad ?? '' }} 
                            </div>

                            <div class="col-md-12 label"> 
                              <span class="text-primary">Teléfono:</span> {{ $estudiante->representante->telefono ?? ''}} 
                            </div>

                            <div class="col-md-12 label"> 
                              <span class="text-primary">Correo:</span> {{ $estudiante->representante->correo ?? ''}}
                            </div>

                            <div class="col-md-12 label"> 
                              <span class="text-primary">Ocupación:</span> {{ $estudiante->representante->ocupacion ?? ''}}
                            </div>

                            <div class="col-md-12 label"> 
                              <span class="text-primary">Direccion de domicilio:</span> {{ $estudiante->representante->direccion ?? ''}}
                            </div> 

                        @else
                          <span class="text-danger">{{ "No tiene representante asignado" }}</span>
                        @endif
                       
                     
                   
                        
                      </div>
                    </div>
                  </div>
                </div>
      
              </div>

              {{-- Card Grupo de estudio --}}

              <div class="col-xl-12">

                <div class="card">
                  <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                   

                    <div class="container-fluid">
                      <div class="row">
                        <hr>
                        <div class="col-md-12">
                          <h3>Incripciones</h3>
                        </div>

                        @if(isset($estudiante->inscripciones[0]))
                          @foreach ($estudiante->inscripciones as $inscripcione)
                              
                            <a class="btn btn-primary" data-bs-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">
                              Click para ver | código: {{ $inscripcione->codigo . " - " }} 
                              @if ($inscripcione->estatus == 3)
                                  <button type="button" class="btn btn-danger">Finalizado</button>
                              @else
                                  <button type="button" class="btn btn-success">En curso</button>
                              @endif
                            </a>
                            <div class="row">
                              <div class="col">
                                <div class="collapse multi-collapse" id="multiCollapseExample1">
                                  <div class="card card-body">
                                    <div class="col-md-12 label"> 
                                      <span class="text-primary">Ver inscripción:</span> 
                                      <form action="{{route('admin.inscripciones.pdf', [ $inscripcione->cedula_estudiante, $inscripcione->codigo ])}}" method="post">
                                        @csrf
                                        @method('get')
                                      
                                        <button type="submit" class="btn btn-none">N° de control:{{ $inscripcione->codigo }}</button>
                                      </form>
                                    
                                    </div>
                                    <div class="col-md-12 label"> 
                                      <span class="text-primary">Ver grupo:</span> 
                                      <form action="{{route('admin.grupos.index')}}" method="post">
                                        @csrf
                                        @method('get')
                                        <input type="hidden" name="filtro" value="{{ $inscripcione->codigo_grupo }}">
                                        <button type="submit" class="btn btn-none">{{ $inscripcione->grupo_nombre }}</button>
                                      </form>
                                    </div>
                                    <div class="col-md-12 label"> 
                                      <span class="text-primary">
                                        Costo del curso: 
                                        <b class="fs-3 text-success"> 
                                          {{ $inscripcione->total }} 
                                        </b>
                                      </span> 
                                    </div>
                                    <div class="col-md-12 label"> 
                                      <span class="text-primary">Abonado: <b class="fs-3">
                                        {{ $inscripcione->abono }}  
                                         
                                      </b></span> 
                                      <span class="text-primary">Pendiente: <b class="fs-3">
                                        {{ $inscripcione->total - $inscripcione->abono }} 
                                      </b></span> 
                                    </div>
                                  </div>
                                </div>
                              </div>
                           
                            </div>

                          @endforeach
                        @else
                          <span class="text-danger">{{ "No tiene inscripcione asignado" }}</span>
                        @endif
                       
                     
                   
                        
                      </div>
                    </div>
                  </div>
                </div>
      
              </div>
            



            </div>
          </section>
          
          
            
          


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
        </div>
      </div>
    </div>
  </div><!-- End Modal Dialog Scrollable-->