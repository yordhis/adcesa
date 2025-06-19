 <figure class="text-center my-5">
     <blockquote class="blockquote text-primary fs-2">
         <p>¡Nuestros Servicios y productos!</p>
     </blockquote>
     <figcaption class="blockquote-footer fs-5 mx-5">
         "Hacemos que tus ideas cobren forma, color y presencia en el mundo real. Si puedes imaginarlo, nosotros podemos
         crearlo."<br>

         <cite title="autor" class="text-muted">Adcesa Publicidad</cite>


     </figcaption>
 </figure>
 <div class="bg-primary text-white mb-5 mt-5 py-5">
     <div class="row row-cols-1 row-cols-md-3 g-4 mx-5 " id="servicios">
         @foreach ($productos as $producto)
             <div class="col">
                 <div class="card ">
                     <img src="{{ asset($producto->imagen) }}" class="card-img-top" style="height: 18rem;" alt="imagen-producto">

                     <div class="card-body">
                         <h5 class="card-title fs-3 fw-bold">{{ $producto->nombre }}</h5>
                         <p class="card-text">
                             <b>Descripción:</b> {{ $producto->descripcion . ' ' . $producto->tipo_duracion }} <br>
                             <b>Tipo:</b> {{ $producto->tipo_producto ? 'SERVICIO' : '' }}
                         </p>
                         
                     </div>
                     <div class="card-footer">
                        <div class="d-flex justify-content-between">
                             <a href="{{ $producto->tipo_producto ? route('page.crear.pedido', $producto->id) : route('page.agregar.carrito', $producto->id) }}">
                                 <button class="btn btn-outline-primary">
                                     <i class="bi bi-cart-plus"></i>
                                     {{ $producto->tipo_producto ? 'Realizar pedido' : 'Agregar al carrito' }}
                                 </button>
                             </a>

                             @if (!$producto->tipo_producto)
                                 <p class="text-success fs-4">
                                     {{ $producto->precio ? $producto->precio : 'no disponible' }}
                                     <i class="bi bi-currency-dollar"></i>
                                 </p>
                             @endif
                         </div>
                     </div>
                 </div>
             </div>
         @endforeach
     </div>
 </div>
