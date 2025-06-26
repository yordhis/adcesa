 <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
     <!-- Profile Edit Form -->
     <form action="{{ route('page.clientes.update', $cliente->id) }}" method="post" class="row g-3 needs-validation"
         enctype="multipart/form-data">
         @csrf
         @method('PUT')

         <!-- Foto de perfil -->
         <div class="row mb-3">
             <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">
                 Foto de perfil
             </label>
             <div class="col-md-8 col-lg-9">
                 <img src="{{ Auth::user()->foto ? asset(Auth::user()->foto) : asset('assets/img/avatar-' . Auth::user()->sexo . '.png') }}"
                     alt="Profile">
                 <div class="pt-2">
                     <input type="file" class="btn btn-primary btn-sm form-control text-start w-50" name="file"
                         id="file">
                 </div>
             </div>
         </div><!-- Fin Foto de perfil -->

         <!-- Nombres -->
         <div class="row mb-3">
             <label for="nombres" class="col-md-4 col-lg-3 col-form-label">Nombres</label>
             <div class="col-md-8 col-lg-9">
                 <input name="nombres" type="text" class="form-control" id="nombres"
                     value="{{ old('nombres') ?? $cliente->nombres }}" required>
             </div>
         </div>

         <!-- Apellidos -->
         <div class="row mb-3">
             <label for="apellidos" class="col-md-4 col-lg-3 col-form-label">Apellidos</label>
             <div class="col-md-8 col-lg-9">
                 <input name="apellidos" type="text" class="form-control" id="apellidos"
                     value="{{ old('apellidos') ?? $cliente->apellidos }}" required>
             </div>
         </div>

         <!-- Nacionalidad -->
         <div class="row mb-3">
             <label for="nacionalidad" class="col-md-4 col-lg-3 col-form-label">Nacionalidad</label>
             <div class="col-md-8 col-lg-9">
                 <select name="nacionalidad" class="form-select" id="nacionalidad" required>
                     @if ($cliente->nacionalidad)
                         <option value="{{ $cliente->nacionalidad }}" selected>
                             {{ $cliente->nacionalidad }}
                         </option>
                     @endif
                     <option value="">Seleccione Nacionalidad</option>
                     @if (old('nacionalidad'))
                         <option value="{{ old('nacionalidad') }}" selected>
                             {{ old('nacionalidad') }}</option>
                     @endif
                     <option value="V">V</option>
                     <option value="E">E</option>
                     <option value="J">J</option>
                 </select>
             </div>
         </div>

         <!-- Cédula o DNI -->
         <div class="row mb-3">
             <label for="cedula" class="col-md-4 col-lg-3 col-form-label">Cédula o
                 DNI</label>
             <div class="col-md-8 col-lg-9">
                 <input name="cedula" type="number" class="form-control" id="cedula"
                     value="{{ old('cedula') ?? $cliente->cedula }}" required>
             </div>
         </div>

         <!-- Fecha de nacimiento -->
         <div class="row mb-3">
             <label for="cedula" class="col-md-4 col-lg-3 col-form-label">Fecha de nacimiento</label>
             <div class="col-md-8 col-lg-9">
                 <input type="date" name="fecha_nacimiento" class="form-control" id="fecha_nacimiento"
                     placeholder="Ingrese fecha de nacimiento."
                     value="{{ old('fecha_nacimiento') ?? $cliente->fecha_nacimiento }}" required>
             </div>
         </div>

         <!-- Genero -->
         <div class="row mb-3">
             <label for="sexo" class="col-md-4 col-lg-3 col-form-label">Genero</label>
             <div class="col-md-8 col-lg-9">
                 <select name="sexo" class="form-select" id="sexo" required>
                     @if ($cliente->sexo)
                         <option value="{{ $cliente->sexo }}" selected>
                             {{ $cliente->sexo }}
                         </option>
                     @endif
                     <option value="">Seleccione sexo</option>
                     @if (old('sexo'))
                         <option value="{{ old('sexo') }}" selected>{{ old('sexo') }}
                         </option>
                     @endif
                     <option value="M">M</option>
                     <option value="F">F</option>
                 </select>
             </div>
         </div>

         <!-- Dirección -->
         <div class="row mb-3">
             <label for="direccion" class="col-md-4 col-lg-3 col-form-label">Dirección</label>
             <div class="col-md-8 col-lg-9">
                 <textarea required name="direccion" class="form-control" id="direccion" style="height: 100px">{{ old('direccion') ?? $cliente->direccion }}</textarea>
             </div>
         </div>

         <!-- Teléfono -->
         <div class="row mb-3">
             <label for="telefono" class="col-md-4 col-lg-3 col-form-label">Teléfono</label>
             <div class="col-md-8 col-lg-9">
                 <input name="telefono" type="text" class="form-control" id="telefono"
                     value="{{ old('telefono') ?? $cliente->telefono }}" required>
             </div>
         </div>

         <!-- Email -->
         <div class="row mb-3">
             <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
             <div class="col-md-8 col-lg-9">
                 <input name="email" type="email" class="form-control" id="Email"
                     value="{{ old('email') ?? $cliente->email }}" required>
             </div>
         </div>

         <!-- Pais - Opcional -->
         <div class="row mb-3">
             <label for="pais" class="col-md-4 col-lg-3 col-form-label">País</label>
             <div class="col-md-8 col-lg-9">
                 <input name="pais" type="pais" class="form-control" id="pais"
                     placeholder="Ingrese país en el que reside actualmente"
                     value="{{ old('pais') ?? $cliente->pais }}">
             </div>
         </div>

         <!-- Estado - Opcional -->
         <div class="row mb-3">
             <label for="estado" class="col-md-4 col-lg-3 col-form-label">Estado</label>
             <div class="col-md-8 col-lg-9">
                 <input name="estado" type="estado" class="form-control" id="estado"
                     placeholder="Ingrese estado en el que reside actualmente"
                     value="{{ old('estado') ?? $cliente->estado }}">
             </div>
         </div>

         <!-- Ciudad - Opcional -->
         <div class="row mb-3">
             <label for="ciudad" class="col-md-4 col-lg-3 col-form-label">Ciudad</label>
             <div class="col-md-8 col-lg-9">
                 <input name="ciudad" type="ciudad" class="form-control" id="ciudad"
                     placeholder="Ingrese ciudad en el que reside actualmente"
                     value="{{ old('ciudad') ?? $cliente->ciudad }}">
             </div>
         </div>


         <div class="text-center">
             <button type="submit" class="btn btn-primary">Guardar cambios</button>
         </div>
     </form><!-- End Profile Edit Form -->
 </div>
