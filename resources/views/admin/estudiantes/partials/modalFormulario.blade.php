       {{-- Boton de agregar estudiante --}}
       <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalformularioCrearEstudiante">
           <i class="bi bi-people"></i>
           Registrar estudiante
       </button>

       <!-- Modal formulario crear estudiante -->
       <div class="modal fade text-start" id="modalformularioCrearEstudiante" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
           aria-labelledby="staticBackdropLabel" aria-hidden="true">
           <div class="modal-dialog  modal-xl">
               <div class="modal-content">
                   <div class="modal-header">
                       <h5 class="modal-title" id="staticBackdropLabel">Registrar estudiante</h5>
                       <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrra"></button>
                   </div>
                   <div class="modal-body">
                       <form action="{{ route('admin.estudiantes.store') }}" method="POST" id="formularioCrearEstudiante"
                           class="row g-3 needs-validation" enctype="multipart/form-data" novalidate>
                           {{--  --}}
                           @csrf
                           @method('POST')


                           {{-- INICIO DE DATOS PERSONALES --}}
                           <div class="col-12">
                               <label for="yourUsername" class="form-label">Nombre y apellido</label>
                               <div class="input-group has-validation">
                                   <span class="input-group-text text-white bg-primary" id="inputGroupPrepend">
                                       <i class="bi bi-people"></i>
                                   </span>
                                   <input type="text" name="nombre" class="form-control" id="yourUsername"
                                       placeholder="Ingrese su nombres y apellidos"
                                       value="{{ $request->nombre ?? old('nombre') }}" required>
                                   <div class="invalid-feedback">Por favor, ingrese nombre! </div>
                                   @error('nombre')
                                       <div class="text-danger">{{ $message }}</div>
                                   @enderror
                               </div>
                           </div>

                           <div class="col-xs-12 col-sm-4">
                               <label for="validationCustom04" class="form-label">Nacionalidad</label>
                               <select name="nacionalidad" class="form-select" id="validationCustom04" required>
                                    @if (old('nacionalidad'))
                                        <option value="{{ old('nacionalidad') }}" selected>
                                            {{ old('nacionalidad') }}
                                        </option>
                                    @endif


                                   <option value="">Seleccione Nacionalidad</option>
                                   <option value="V">V</option>
                                   <option value="E">E</option>
                               </select>
                               <div class="invalid-feedback">
                                   Por favor, ingresar nacionalidad!
                               </div>
                               @error('nacionalidad')
                                   <div class="text-danger">{{ $message }}</div>
                               @enderror
                           </div>

                           <div class="col-xs-12 col-sm-4">
                               <label for="yourPassword" class="form-label">Cédula</label>
                               <input type="number" name="cedula" class="form-control" id="yourUsername"
                                   placeholder="Ingrese número de cédula"
                                   value="{{ $request->cedula ?? old('cedula') }}" 
                                   required>
                               <div class="invalid-feedback">Por favor, Ingrese número de cédula!</div>
                               @error('cedula')
                                   <div class="text-danger"> {{ $message }} </div>
                               @enderror
                           </div>

                           <div class="col-xs-12 col-sm-4">
                               <label for="yourPassword" class="form-label">Teléfono</label>
                               <input type="text" name="telefono" class="form-control" id="yourUsername"
                                   placeholder="Ingrese número de teléfono"
                                   value="{{ $request->telefono ?? old('telefono') }}" 
                                   min="11" max="15" required>
                               <div class="invalid-feedback">Por favor, Ingrese número de teléfono!
                               </div>
                               @error('telefono')
                                   <div class="text-danger"> {{ $message }} </div>
                               @enderror
                           </div>

                           <div class="col-xs-12 col-sm-4">
                               <label for="yourPassword" class="form-label">E-mail</label>
                               <input type="email" name="correo" class="form-control" id="yourUsername"
                                   placeholder="Ingrese dirección de correo."
                                   value="{{ $request->correo ?? old('correo') }}" required>
                               <div class="invalid-feedback">Por favor, Ingrese dirección de correo!
                               </div>
                               @error('correo')
                                   <div class="text-danger"> {{ $message }} </div>
                               @enderror
                           </div>

                           <div class="col-xs-12 col-sm-4">
                               <label for="yourPassword" class="form-label">Fecha de nacimiento</label>
                               <input type="date" name="nacimiento" class="form-control" id="fecha_nacimiento"
                                   placeholder="Ingrese fecha de nacimiento."
                                   value="{{ $request->nacimiento ?? old('nacimiento') }}" required>
                               <div class="invalid-feedback">Por favor, ingrese fecha de nacimiento!
                               </div>
                               @error('nacimiento')
                                   <div class="text-danger"> {{ $message }} </div>
                               @enderror
                           </div>

                           <div class="col-xs-12 col-sm-4">
                               <label for="yourPassword" class="form-label">Edad</label>
                               <input type="number" name="edad" class="form-control" id="edad_estudiante"
                                   placeholder="Ingrese edad." value="{{ $request->edad ?? old('edad') }}" 
                                   min="1" max="120" required>
                               <div class="invalid-feedback">Por favor, Ingrese edad!</div>
                               @error('edad')
                                   <div class="text-danger"> {{ $message }} </div>
                               @enderror
                           </div>

                           <div class="col-12">
                               <label for="yourPassword" class="form-label">Dirección de
                                   habitación</label>
                               <input type="text" name="direccion" class="form-control" id="yourUsername"
                                   placeholder="Ingrese dirección de domicilio."
                                   value="{{ $request->direccion ?? old('direccion') }}" required>
                               <div class="invalid-feedback">Por favor, Ingrese dirección!</div>
                               @error('direccion')
                                   <div class="text-danger"> {{ $message }} </div>
                               @enderror
                           </div>

                           <div class="col-12">
                               <label for="yourPassword" class="form-label">Grado de estudio</label>
                               <input type="text" name="grado" class="form-control" id="yourUsername"
                                   placeholder="Ingrese grado de estudio."
                                   value="{{ $request->grado ?? old('grado') }}" required>
                               <div class="invalid-feedback">Por favor, Ingrese grado de estudio!
                               </div>
                               @error('grado')
                                   <div class="text-danger"> {{ $message }} </div>
                               @enderror
                           </div>

                           <div class="col-12">
                               <label for="yourPassword" class="form-label">Ocupación o
                                   profesión</label>
                               <input type="text" name="ocupacion" class="form-control" id="yourUsername"
                                   placeholder="Ingrese ocupación."
                                   value="{{ $request->ocupacion ?? old('ocupacion') }}" required>
                               <div class="invalid-feedback">Por favor, Ingrese ocupación!</div>
                               @error('ocupacion')
                                   <div class="text-danger"> {{ $message }} </div>
                               @enderror
                           </div>

                           <div class="col-xs-12 col-sm-6">
                               <label for="foto" class="form-label">Subir Foto (Opcional)</label>
                               <input type="file" name="file" class="form-control " id="file"
                                   accept="image/*">
                               @error('file')
                                   <div class="text-danger">{{ $message }}</div>
                               @enderror
                           </div>

                           <div class="col-xs-12 col-sm-6 d-flex flex-column ">
                               <a class="btn btn-dark m-1" id="addRepre">
                                   <i class="bi bi-person-plus"></i>
                                   Agregar Representante
                               </a>
                               
                               <a class="btn btn-dark m-1" id="addDifi">
                                   <i class="bi bi-postcard-heart"></i>
                                   Agregar Dificultad de aprendizaje
                               </a>
                           </div> {{-- FIN DE DATOS PERSONALES --}}


                           {{-- INICIO DE DATOS DEL REPRESENTANTE --}}
                           <div id="agregar-representante" class="row">
                               <div class="col-xs-8 col-sm-11">
                                   <h5 class="mt-3">Representante</h5>
                                   <hr>
                               </div>
                               <div class="col-1">
                                   <span class="btn btn-none text-danger fs-3" id="closeRepre">X</span>
                               </div>

                               <div class="col-sm-12">
                                   <label for="yourUsername" class="form-label">Cédula del
                                       representante</label><br>
                                   <input type="number" name="rep_cedula" class="form-control"
                                       value="{{ old('rep_cedula') }}" id="rep_cedula"
                                       placeholder="Ingrese la cédula del representante.">
                                   <p><small class="text-white card mt-2 p-2 bg-secondary" id="mensajeRepresentante">
                                           Si el representante ya existe los datos se llenaran
                                           automáticamente.
                                       </small></p>
                                   <div class="invalid-feedback">Por favor, Ingrese la cédula del
                                       representante!
                                   </div>
                               </div>
                               {{-- Se muestra la precarga  --}}
                               <span id="preload"></span>
                               <div id="componenteCardRepresentante"></div>

                               <div id="componenteRepresentante" class="row">
                                   <div class="col-sm-12">
                                       <label for="yourName" class="form-label">Nombre del
                                           representante</label>
                                       <input type="text" name="rep_nombre" class="form-control" id="yourName"
                                           value="{{ old('rep_nombre') }}"
                                           placeholder="Ingrese Nombre del representante.">
                                       <div class="invalid-feedback">Por favor, Nombre del
                                           representante!</div>
                                   </div>

                                   <div class="col-12">
                                       <label for="yourUsername" class="form-label">Teléfono </label>
                                       <input type="number" name="rep_telefono" class="form-control"
                                           value="{{ old('rep_telefono') }}" id="yourUsername"
                                           placeholder="Ingrese teléfono del representante.">
                                       <div class="invalid-feedback">Por favor, Ingrese teléfono del
                                           representante!
                                       </div>
                                   </div>

                                   <div class="col-xs-12 col-sm-6">
                                       <label for="yourUsername" class="form-label">Fecha de nacimiento</label>
                                       <input type="date" name="rep_nacimiento" class="form-control" id="rep_nacimiento"
                                           value="{{ old('rep_nacimiento') }}" placeholder="Ingrese edad.">
                                       <div class="invalid-feedback">Por favor, Ingrese fecha de nacimiento!</div>
                                   </div>
                                   <div class="col-xs-12 col-sm-6">
                                       <label for="yourUsername" class="form-label">Edad</label>
                                       <input type="number" name="rep_edad" class="form-control" id="rep_edad"
                                           value="{{ old('rep_edad') }}" placeholder="Ingrese edad.">
                                       <div class="invalid-feedback">Por favor, Ingrese edad!</div>
                                   </div>

                                   <div class="col-12">
                                       <label for="yourUsername" class="form-label">Ocupación</label>
                                       <input type="text" name="rep_ocupacion" class="form-control"
                                           value="{{ old('rep_ocupacion') }}" id="yourUsername"
                                           placeholder="Ingrese ocupación o oficio.">
                                       <div class="invalid-feedback">Por favor, ocupación o oficio!
                                       </div>
                                   </div>

                                   <div class="col-12">
                                       <label for="yourUsername" class="form-label">Dirección del
                                           representante</label>
                                       <input type="text" name="rep_direccion" class="form-control"
                                           value="{{ old('rep_direccion') }}" id="yourUsername"
                                           placeholder="Ingrese dirección del representante.">
                                       <div class="invalid-feedback">Por favor, Ingrese dirección del
                                           representante!
                                       </div>
                                   </div>

                                   <div class="col-12">
                                       <label for="yourUsername" class="form-label">Correo</label>
                                       <input type="email" name="rep_correo" class="form-control"
                                           value="{{ old('rep_correo') }}" id="yourUsername"
                                           placeholder="Ingrese correo.">
                                       <div class="invalid-feedback">Por favor, Ingrese correo
                                           electrónico correcto!
                                       </div>
                                   </div>
                               </div>
                           </div> {{-- FIN DE DATOS DEL REPRESENTANTE --}}

                           {{-- INICIO DE DATOS DE DIFICULTAD DE APRENDIZAJE --}}
                           <div id="agregar-dificultad" class="row">
                               <div class="col-11">
                                   <h5 class="mt-3">Dificultad de aprendizaje</h5>
                                   <hr>
                               </div>
                               <div class="col-1">
                                   <span class="btn btn-none text-danger fs-3" id="closeDifi">X</span>
                               </div>
                               <div class="col-4">
                                   <label for="yourUsername" class="form-label">TDH</label>
                                   <input type="checkbox" name="dif_1" value="TDH" class="form-checkbox"
                                       id="yourUsername">
                               </div>
                               <div class="col-4">
                                   <label for="yourUsername" class="form-label">ASPERGER</label>
                                   <input type="checkbox" name="dif_2" value="ASPERGER" class="form-checkbox"
                                       id="yourUsername">
                               </div>
                               <div class="col-4">
                                   <label for="yourUsername" class="form-label">AUTISMO</label>
                                   <input type="checkbox" name="dif_3" value="AUTISMO" class="form-checkbox"
                                       id="yourUsername">
                               </div>
                           </div> {{-- INICIO DE DATOS DE DIFICULTAD DE APRENDIZAJE --}}



                           <div class="col-12">
                               <button class="btn btn-primary w-100" type="submit">Guardar datos</button>
                           </div>

                       </form>

                   </div>
                   <div class="modal-footer">
                       <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                       {{-- <button type="button" class="btn btn-primary">Understood</button> --}}
                   </div>
               </div>
           </div>
       </div>
       <!-- Cierre Modal formulario crear estudiante -->
