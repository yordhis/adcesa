@extends('layouts.app')

@section('title', 'Editar Profesor')


@section('content')

@if( session('mensaje') )
  @include('partials.alert')
@endif

<div class="container">
    <section class="section register d-flex flex-column align-items-center justify-content-center ">
      <div class="container">
        <div class="row justify-content-center">
          <div class=" col-sm-8 d-flex flex-column align-items-center justify-content-center">

            <div class="card ">

              <div class="card-body">

                <div class=" pb-2">
                  <h5 class="card-title text-center pb-0 fs-2">Editar Profesor</h5>
                  <p class="text-center text-danger small">Rellene todos los campos</p>
                </div>

                


                <form action="{{ route('admin.profesores.update', $profesore->id) }}" method="post" class="row g-3 needs-validation"
                enctype="multipart/form-data"
                novalidate>
                 @csrf
                 @method('put')  
                 
                  <div class="col-12">
                        <label for="yourUsername" class="form-label">Nombre y apellido</label>
                        <div class="input-group has-validation">
                          <span class="input-group-text text-white bg-primary" id="inputGroupPrepend">@</span>
                          <input type="text" name="nombre" class="form-control" id="yourUsername" 
                          placeholder="Ingrese su nombres y apellidos"
                          value="{{ old('nombre') ?? $profesore->nombre }}"
                          required>
                          <div class="invalid-feedback">Por favor, ingrese nombre! </div>
                          @error('nombre')
                            <div class="text-danger"> {{ $message }} </div>
                          @enderror
                        </div>
                      </div>

                      <div class="col-xs-12 col-sm-4">
                        <label for="validationCustom04" class="form-label">Nacionalidad</label>
                        <select name="nacionalidad"  class="form-select" id="validationCustom04" required>
                          <option selected disabled value="">Seleccione Nacionalidad</option>
                         
                          @if (isset($profesore->nacionalidad))
                            @if($profesore->nacionalidad == "V")
                              <option value="V" selected>V</option>
                              @else
                              <option value="E" selected>E</option>
                            @endif
                          @endif

                          <option value="V">V</option>
                          <option value="E">E</option>
                        </select>
                        <div class="invalid-feedback">
                         Por favor, ingresar nacionalidad!
                        </div>
                        @error('nacionalidad')
                          <div class="text-danger"> {{ $message }} </div>
                        @enderror
                      </div>
                     
    
                      <div class="col-xs-12 col-sm-4">
                        <label for="yourPassword" class="form-label">Cédula</label>
                        <div class="input-group">
                          <input type="text" name="cedula" class="form-control bg-muted" id="inputCedula" 
                          placeholder="Ingrese número de cédula"
                          value="{{ old('cedula') ?? $profesore->cedula  }}"
                          disabled
                          readonly
                          required>
                          <button type="button" class="btn btn-warning" id="activarEdicionDeCedula">
                            <i class="bi bi-pencil"></i>
                          </button>
                        </div>
                        <div class="invalid-feedback">Por favor, Ingrese número de cédula!</div>
                        @error('cedula')
                          <div class="text-danger"> {{ $message }} </div>
                        @enderror
                      </div>

                      <div class="col-xs-12 col-sm-4">
                        <label for="yourPassword" class="form-label">Teléfono</label>
                        <input type="text" name="telefono" class="form-control" id="yourUsername" 
                        placeholder="Ingrese número de teléfono"
                        value="{{ old('telefono') ?? $profesore->telefono }}"
                        required>
                        <div class="invalid-feedback">Por favor, Ingrese número de teléfono!</div>
                        @error('telefono')
                          <div class="text-danger"> {{ $message }} </div>
                        @enderror
                      </div>

                      <div class="col-12">
                        <label for="correo" class="form-label">E-mail</label>
                        <input type="email" name="correo" class="form-control" id="correo" 
                        placeholder="Ingrese dirección de correo."
                        value="{{ old('correo') ?? $profesore->correo }}"
                        required>
                        <div class="invalid-feedback">Por favor, Ingrese dirección de correo!</div>
                        @error('correo')
                          <div class="text-danger"> {{ $message }} </div>
                        @enderror
                      </div>

                      <div class="col-xs-12 col-sm-6">
                        <label for="yourPassword" class="form-label">Fecha de nacimiento</label>
                        <input type="date" name="nacimiento" class="form-control" id="yourUsername" 
                        placeholder="Ingrese fecha de nacimiento."
                        value="{{ old('nacimiento') ?? $profesore->nacimiento }}"
                        required>
                        <div class="invalid-feedback">Por favor, ingrese fecha de nacimiento!</div>
                        @error('nacimiento')
                          <div class="text-danger"> {{ $message }} </div>
                        @enderror
                      </div>

                      <div class="col-xs-12 col-sm-6">
                        <label for="yourPassword" class="form-label">Edad</label>
                        <input type="number" name="edad" class="form-control" id="yourUsername" 
                        placeholder="Ingrese edad."
                        value="{{ old('edad') ?? $profesore->edad }}"
                        required>
                        <div class="invalid-feedback">Por favor, Ingrese edad!</div>
                        @error('edad')
                          <div class="text-danger"> {{ $message }} </div>
                        @enderror
                      </div>

                      <div class="col-12">
                        <label for="direccion" class="form-label">Dirección de habitación</label>
                        <input type="text" name="direccion" class="form-control" id="direccion" 
                        placeholder="Ingrese dirección de domicilio."
                        value="{{ old('direccion') ?? $profesore->direccion }}"
                        required>
                        <div class="invalid-feedback">Por favor, Ingrese edad!</div>
                        @error('direccion')
                          <div class="text-danger"> {{ $message }} </div>
                        @enderror
                      </div>

                      <div class="col-xs-12 col-sm-6">
                        <label for="file" class="form-label">Subir Foto (Opcional)</label>
                        <input type="file" name="file" class="form-control " id="file">
                        {{-- <div class="invalid-feedback">Ingrese una imagen valida</div> --}}
                      </div>

                      <div class="col-xs-12 col-sm-6 card">
                        <img src="{{asset($profesore->foto)}}" class="img-fluid rounded" alt="">                        
                      </div>

                  
                      <div class="col-12">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" name="estatus" value="1"
                            {{ $profesore->estatus == 1 ? "checked" : ""}}>
                            <label class="form-check-label 
                              {{ $profesore->estatus == 1 ? "text-success" : "text-danger"}}" 
                             for="flexSwitchCheckChecked">
                              {{ $profesore->estatus == 1 ? "Profesor Activo" : "Profesor Inactivo"}}
                            </label>
                        </div>
                    </div>
                  
                  <div class="col-12">
                    <button class="btn btn-primary w-100" type="submit">Guardar cambios</button>
                  </div>
                  
                </form>

              </div>
            </div>


          </div>
        </div>
      </div>

    </section>
    <script src="{{ asset('assets/js/profesores/editar.js') }}"></script>
@endsection


