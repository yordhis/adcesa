 <!-- Modal Dialog Scrollable -->
 <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCrearNivel">
     <i class="bi bi-plus"></i>Crear nivel
 </button>
 <div class="modal fade" id="modalCrearNivel" tabindex="-1">
     <div class="modal-dialog modal-dialog-scrollable">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title">Formulario para crear nivel</h5>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">

                 <form action="{{ route('admin.niveles.store') }}" method="post"
                     class="row g-3 needs-validation text-start" enctype="multipart/form-data" novalidate>
                     @csrf
                     @method('post')

                     <div class="col-12">
                         <label for="yourUsername" class="form-label">Código
                             <span class=" text-primary">(Es automático)</span>
                         </label>
                         <div class="input-group has-validation">
                             <span class="input-group-text text-white bg-primary" id="inputGroupPrepend">
                                 <i class="bi bi-upc-scan"></i>
                             </span>
                             <input type="text" name="codigo" class="form-control fs-5 text-danger"
                                 id="yourUsername" value="{{ $codigo ?? $request->codigo }}" readonly required>

                             <div class="invalid-feedback">Por favor, ingrese codigo! </div>
                             @error('codigo')
                                 <div class="text-danger">{{ $message }}</div>
                             @enderror
                         </div>
                     </div>

                     <div class="col-12">
                         <label for="yourPassword" class="form-label">Nombre del nivel</label>
                         <input type="text" name="nombre" class="form-control" id="yourUsername"
                             placeholder="Ingrese nombre del nivel" value="{{ old('nombre') ?? $request->nombre }}"
                             required>
                         <div class="invalid-feedback">Por favor, Ingrese nombre del nivel!</div>
                         @error('nombre')
                             <div class="text-danger">{{ $message }}</div>
                         @enderror
                     </div>

                     <div class="col-12">
                         <label for="yourPassword" class="form-label">Precio</label>
                         <input type="number" name="precio" class="form-control" id="yourUsername"
                             placeholder="Ingrese costo del nivel" value="{{ old('precio') ?? $request->precio }}"
                             required>
                         <div class="invalid-feedback">Por favor, Ingrese costo del nivel!</div>
                         @error('precio')
                             <div class="text-danger">{{ $message }}</div>
                         @enderror
                     </div>

                     <div class="col-12">
                         <label for="yourPassword" class="form-label">Libro</label>
                         <input type="text" name="libro" class="form-control" id="yourUsername"
                             placeholder="Ingrese nombre del libro para este nivel." value="{{ old('libro') ?? $request->libro }}"
                             required>
                         <div class="invalid-feedback">Por favor, Ingrese nombre del libro para este nivel!</div>
                         @error('libro')
                             <div class="text-danger">{{ $message }}</div>
                         @enderror
                     </div>

                     <div class="col-sm-8 col-xs-12">
                         <label for="yourPassword" class="form-label">Tiempo de duración del nivel</label>
                         <input type="number" name="duracion" class="form-control" id="yourUsername"
                             placeholder="Ingrese Tiempo de duración del nivel." value="{{ old('duracion') ?? $request->duracion }}"
                             required>
                         <div class="invalid-feedback">Por favor, Tiempo de duración del nivel!</div>
                         @error('duracion')
                             <div class="text-danger">{{ $message }}</div>
                         @enderror
                     </div>

                     <div class="col-sm-4 col-xs-12">
                         <label for="validationCustom04" class="form-label">Tipo de plazo</label>
                         <select name="tipo_duracion" class="form-select" id="validationCustom04" required>
                             @if (old('tipo_duracion'))
                                 <option value="{{ old('tipo_duracion') }}" selected>
                                     {{ old('tipo_duracion') }}</option>
                             @else
                                 <option selected disabled value="">Seleccione el plazo</option>
                             @endif

                             <option value="Dias">Dias</option>
                             <option value="Meses">Meses</option>
                         </select>
                         <div class="invalid-feedback">
                             Por favor, Seleccione tiempo!
                         </div>
                         @error('tipo_duracion')
                             <div class="text-danger">{{ $message }}</div>
                         @enderror
                     </div>

                     <div class="col-12">
                         <label for="validationCustom04" class="form-label">Imagen para la web</label>
                         <input type="file" name="file" class="form-control" id="imagen_nivel" 
                         accept="image/*"
                         required>
                         <div class="invalid-feedback">
                             Por favor, Agregue una imagen para el sitio web!
                         </div>
                         @error('imagen')
                             <div class="text-danger">{{ $message }}</div>
                         @enderror
                     </div>

                     <div class="col-12">
                        <label for="validationCustom04" class="form-label"> Tipo Nivel </label>
                        <select name="tipo_nivel" class="form-select" id="validationCustom04" required>
                            @if (old('tipo_nivel'))
                                <option value="{{ old('tipo_nivel') }}" selected>
                                    {{ old('tipo_nivel')  == 'ninio' ? 'Niños' : 'Adultos'}}</option>
                            @else
                                <option selected disabled value="">Seleccione categoria</option>
                            @endif

                            <option value="ninio">Niños</option>
                            <option value="adulto">Adultos</option>
                        </select>
                        <div class="invalid-feedback">
                            Por favor, Seleccione para que categoria es el curso!
                        </div>
                        @error('tipo_nivel')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>


                     <div class="col-12">
                         <button class="btn btn-primary w-100" type="submit">Crear nivel</button>
                     </div>

                 </form>

             </div>
         </div>
     </div>
 </div><!-- End Modal Dialog Scrollable-->
