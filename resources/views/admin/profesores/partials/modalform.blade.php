<!-- Vertically centered Modal -->
<button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#modalRegistrarProfesor">
    <i class="bi bi-person-plus"></i> Registrar profesor
</button>

<div class="modal fade" id="modalRegistrarProfesor" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Registrar profesor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-start">
                <form action="{{ route('admin.profesores.store') }}" method="post" class="row g-3 needs-validation" 
                enctype="multipart/form-data"
                novalidate>
                 @csrf
                 @method('post')  
                 
                  <div class="col-12">
                        <label for="yourUsername" class="form-label">Nombre y apellido</label>
                        <div class="input-group has-validation">
                          <span class="input-group-text text-white bg-primary" id="inputGroupPrepend">
                            <i class="bi bi-people"></i>
                          </span>
                          <input type="text" name="nombre" class="form-control" id="nombre" 
                          placeholder="Ingrese su nombres y apellidos"
                          value="{{ old('nombre') ?? '' }}"
                          required>
                          <div class="invalid-feedback">Por favor, ingrese nombre! </div>
                          @error('nombre')
                            <div class="text-danger">{{ $message }}</div>
                          @enderror
                        </div>
                      </div>

                      <div class="col-xs-12 col-sm-6">
                        <label for="nacionalidad" class="form-label">Nacionalidad</label>
                        <select name="nacionalidad"  class="form-select" id="nacionalidad" required>
                          @if (isset($request->nacionalidad))
                            <option value="{{ $request->nacionalidad }}" selected >{{ $request->nacionalidad }}</option>
                          @endif
                          <option value="">Seleccione Nacionalidad</option>
                          @error('nacionalidad')
                            <option value="{{ old('nacionalidad') }}" selected>{{ old('nacionalidad') }}</option>  
                          @enderror
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
                     
    
                      <div class="col-xs-12 col-sm-6">
                        <label for="cedula" class="form-label">Cédula</label>
                        <input type="number" name="cedula" class="form-control" id="cedula" 
                        placeholder="Ingrese número de cédula"
                        value="{{ old('cedula') ?? '' }}"
                        required>
                        <div class="invalid-feedback">Por favor, Ingrese número de cédula valido!</div>
                        @error('cedula')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>

                      <div class="col-12">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="phone" name="telefono" class="form-control" id="telefono" 
                        placeholder="Ingrese número de teléfono"
                        value="{{ old('telefono') ?? ''}}"
                        required>
                        <div class="invalid-feedback">Por favor, Ingrese número de teléfono valido!</div>
                        @error('telefono')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>

                      <div class="col-12">
                        <label for="correo" class="form-label">E-mail</label>
                        <input type="email" name="correo" class="form-control" id="correo" 
                        placeholder="Ingrese dirección de correo."
                        value="{{ old('correo') ?? '' }}"
                        required>
                        <div class="invalid-feedback">Por favor, Ingrese dirección de correo!</div>
                        @error('correo')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>

                      <div class="col-12">
                        <label for="nacimiento" class="form-label">Fecha de nacimiento</label>
                        <input type="date" name="nacimiento" class="form-control" id="nacimiento" 
                        placeholder="Ingrese fecha de nacimiento."
                        value="{{  old('nacimiento') ?? '' }}"
                        required>
                        <div class="invalid-feedback">Por favor, ingrese fecha de nacimiento!</div>
                        @error('nacimiento')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>

                      <div class="col-12">
                        <label for="edad" class="form-label">Edad</label>
                        <input type="number" name="edad" class="form-control" id="edad" 
                        placeholder="Ingrese edad."
                        value="{{ old('edad') ?? ''}}"
                        required>
                        <div class="invalid-feedback">Por favor, Ingrese edad!</div>
                        @error('edad')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>

                      <div class="col-12">
                        <label for="direccion" class="form-label">Dirección de habitación</label>
                        <input type="text" name="direccion" class="form-control" id="direccion" 
                        placeholder="Ingrese dirección de domicilio."
                        value="{{  old('direccion') ?? '' }}"
                        required>
                        <div class="invalid-feedback">Por favor, Ingrese dirección!</div>
                        @error('direccion')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>

                      <div class="col-12">
                        <label for="file" class="form-label">Subir Foto (Opcional)</label>
                        <input type="file" name="file" class="form-control " id="file" accept="image/*">
                        {{-- <div class="invalid-feedback">Ingrese una imagen valida</div> --}}
                        @error('file')
                          <div class="text-danger">{{ $message }}</div>
                        @enderror
                      </div>
    
                 
            </div>
            <div class="modal-footer">
                <div class="col-12">
                    <button class="btn btn-primary w-100" type="submit">Crear profesor</button>
                  </div>
                  
                </form>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div><!-- End Vertically centered Modal-->
