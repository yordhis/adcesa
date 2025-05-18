@extends('layouts.app')

@section('title', 'Editar Plan de Pago')


@section('content')

    @isset($respuesta)
        @include('partials.alert')
    @endisset
    <div id="alert"></div>

    <div class="container">
        <section class="section register d-flex flex-column align-items-center justify-content-center ">
            <div class="container">
                <div class="row justify-content-center">
                    <div class=" col-sm-8 d-flex flex-column align-items-center justify-content-center">

                        <div class="card ">

                            <div class="card-body">

                                <div class=" pb-2">
                                    <h5 class="card-title text-center pb-0 fs-2">Editar plan de pago</h5>
                                    <p class="text-center text-danger small">Rellene todos los campos</p>
                                </div>




                                <form action="{{ route('admin.planes.update', $plane->id) }}" method="post"
                                    class="row g-3 needs-validation" enctype="multipart/form-data" novalidate>
                                    @csrf
                                    @method('put')

                                    <input type="hidden" name="urlPrevious" value="{{ old('urlPrevious') ?? $urlPrevious }}">

                                    <div class="col-12">
                                        <label for="yourUsername" class="form-label">Código
                                            <span class=" text-primary">(Es automático)</span>
                                        </label>
                                        <div class="input-group has-validation">
                                            <span class="input-group-text text-white bg-primary" id="inputGroupPrepend">
                                                <i class="bi bi-upc-scan"></i>
                                            </span>
                                            <input type="text" name="codigo" class="form-control fs-5 text-danger"
                                                id="yourUsername" value="{{ $plane->codigo }}" readonly required>
                                            <div class="invalid-feedback">Por favor, ingrese codigo! </div>
                                        </div>
                                        @error('codigo')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <label for="yourPassword" class="form-label">Nombre del plan</label>
                                        <input type="text" name="nombre" class="form-control" id="yourUsername"
                                            placeholder="Ingrese nombre del nivel" value="{{ old('nombre') ?? $plane->nombre }}" required>
                                        <div class="invalid-feedback">Por favor, Ingrese nombre del plan!</div>

                                        @error('nombre')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>


                                    <div class="col-12">
                                        <label for="yourPassword" class="form-label">Decripcion del plan</label>
                                        <input type="text" name="descripcion" class="form-control" id="yourUsername"
                                            placeholder="Ingrese la descripción del plan." value="{{ old('descripcion') ?? $plane->descripcion }}"
                                            required>
                                        <div class="invalid-feedback">Por favor, Ingrese la descripción del plan!</div>
                                        @error('descripcion')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="col-12 ">
                                        <label for="yourPassword" class="form-label">Porcentaje descuento (%)</label>
                                        <input type="number" name="porcentaje_descuento" step="1" class="form-control" id="porcentaje_descuento"
                                            placeholder="Ingrese el porcentaje descuento en números enteros ejemplo: 30 = 30%."
                                            min="0"
                                            value="{{ old('porcentaje_descuento') ?? $plane->porcentaje_descuento }}" 
                                            required>
                                        <div class="invalid-feedback">Por favor, Ingrese porcentaje descuento! sino desea descuento ingrese CERO (0)</div>
                                    </div>

                                    <div class="col-12 ">
                                        <label for="cantidad_estudiantes" class="form-label">Cantidad de estudiantes para aplicar al plan</label>
                                        <input type="number" name="cantidad_estudiantes" step="1" class="form-control" id="cantidad_estudiantes"
                                            placeholder="Ingrese Porcentaje descuento."
                                            min="1"
                                            value="{{ old('cantidad_estudiantes') ?? $plane->cantidad_estudiantes}}" 
                                            required>
                                        <div class="invalid-feedback">Por favor, Ingrese una cantidad valida de estudiantes!</div>
                                    </div>

                                    <div class="col-sm-4 col-xs-12 ">
                                        <label for="yourPassword" class="form-label">Cantidad de cuotas</label>
                                        <input type="number" name="cantidad_cuotas" class="form-control" id="yourUsername"
                                            placeholder="Ingrese cantidad de cuotas"
                                            min="1"
                                            max="5"
                                            value="{{ old('cantidad_cuotas') ?? $plane->cantidad_cuotas }}" 
                                            required>
                                        <div class="invalid-feedback">Por favor, Ingrese cantidad de cuotas!</div>
                                    </div>
                
                                    <div class="col-sm-8 col-xs-12">
                                        <label for="validationCustom04" class="form-label">Plazo de pago</label>
                                        <select name="plazo" class="form-select" id="validationCustom04" required>
                                            @if (isset($plane->plazo))
                                              <option value="{{$plane->plazo }}" selected>{{ $plane->plazo }} Días</option>
                                        
                                            @endif
                                
                
                                            <option value="">Seleccione cantidad de dias</option>
                                            <option value="1">1 Días</option>
                                            <option value="7">7 Días</option>
                                            <option value="15">15 Días</option>
                                            <option value="30">30 Días</option>
                                            <option value="45">45 Días</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Por favor, Seleccione plazo de pago!
                                        </div>
                                    </div> 

                                    <div class="col-12">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" name="estatus" value="2"
                                            {{ $plane->estatus == 2 ? "checked" : ""}}>
                                            <label class="form-check-label" for="flexSwitchCheckChecked">
                                                Activa para mostrar el plan en la pagina web
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
    @endsection
