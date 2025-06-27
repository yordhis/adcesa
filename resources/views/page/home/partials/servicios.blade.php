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
 <div class="bg-primary text-white mb-5 mt-5 py-5"
     style="background-image: url('{{ asset('assets/img/fondo-catalogo.png') }}'); 
         background-position: center;">
     <div class="row row-cols-1 row-cols-md-3 g-4 mx-5 " id="servicios">
         @foreach ($productos as $producto)
             <div class="col">
                 <div class="card shadow-lg ">
                     <img src="{{ asset($producto->imagen) }}" class="card-img-top" style="height: 18rem;"
                         alt="imagen-producto">

                     <div class="card-body">
                         <h5 class="card-title fs-3 fw-bold">{{ $producto->nombre }}</h5>
                         <p class="card-text">
                             <b>Descripción:</b> {{ $producto->descripcion . ' ' . $producto->tipo_duracion }} <br>
                         </p>

                     </div>
                     <div class="card-footer">
                         <div class="d-flex justify-content-between">
                             @if ($producto->tipo_producto)
                                 <a
                                     href="{{ $producto->tipo_producto ? route('page.crear.pedido', $producto->id) : route('page.agregar.carrito', $producto->id) }}">
                                     <button class="btn btn-outline-primary">
                                         <i class="bi bi-pencil-square"></i>
                                         {{ $producto->tipo_producto ? 'Realizar pedido' : '' }}
                                     </button>
                                 </a>
                             @else
                                 <form action="{{ route('page.finalizar.pedido') }}" method="post"
                                     enctype="multipart/form-data" id="formularioPedido">
                                     @csrf
                                     @method('POST')
                                     <input type="hidden" name="id_producto" value="{{ $producto->id }}">
                                     <input type="hidden" name="tipo_producto" value="{{ $producto->tipo_producto }}">
                                     <input type="hidden" name="cantidad" value="1">
                                     <input type="hidden" name="precio" value="{{ $producto->precio }}">
                                     <input type="hidden" name="precioUnitario" value="{{ $producto->precio }}">
                                     <input type="hidden" name="vista" value="vista_inicio" id="vista">
                                     <button type="submit" class="btn btn-outline-primary">
                                        <i class="bi bi-cart-plus"></i>
                                        Agregar al carrito
                                    </button>
                                 </form>
                             @endif

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
