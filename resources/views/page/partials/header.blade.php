<!-------------- Page Menu ------->
<nav class="navbar sticky-top navbar-expand-lg navbar-light bg-menu" id="header">
    <div class="container-fluid">
        <!-- Logo de la empresa -->
        <a class="navbar-brand" href="{{ route('page.index') }}">
            <img src="{{ asset('/assets/img/logo.png') }}" alt="logo" class="img-logo ">
        </a>

        <!-- Carrito de compras para móvil (visible solo en xs, sm, md) -->
        <button class="btn btn-primary position-relative p-2  d-inline d-lg-none" type="button"
            data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight_cart_shoping"
            aria-controls="offcanvasRight_cart_shoping">
            <i class="bi bi-cart-fill fs-4"></i>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                {{ session('carrito') ? count(session('carrito')) : 0 }}
            </span>
        </button>

        <!-- Botón de menú responsive -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>



        <!-- Menú de navegación -->
        <div class="collapse navbar-collapse col-xs-12 nav justify-content-end text-end" id="navbarNav">
            <ul class="navbar-nav ">
                <!-- Enlaces de navegación -->
                <!-- inicio -->
                <li class="nav-item">
                    <a class="nav-link fs-5 {{ url()->current() == route('page.index') ? 'active' : '' }}"
                        aria-current="page" href="{{ route('page.index') }}">Inicio</a>
                </li>

                <!-- servicios y productos -->
                <li class="nav-item">
                    <a class="nav-link fs-5 {{ url()->current() == route('page.index') ? 'active' : '' }}"
                        aria-current="page" href="{{ route('page.index') }}#servicios">Servicio y productos</a>
                </li>

                <!-- Nosotros -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle fs-5" href="#" id="navbarScrollingDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Nosotros
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                        <li><a class="dropdown-item fs-5" href="{{ route('page.index') }}#quienes_somos">¿Quiénes
                                somos?</a></li>
                        <li><a class="dropdown-item fs-5" href="{{ route('page.index') }}#mision">Misión</a></li>
                        <li><a class="dropdown-item fs-5" href="{{ route('page.index') }}#vision">Visión</a></li>
                    </ul>
                </li>

                <!-- Contactos -->
                <li class="nav-item fs-5">
                    <a class="nav-link" href="#contactos">Contactos</a>
                </li>

                @if (Auth::user())
                    <!-- Profile Nav -->
                    <li class="nav-item dropdown pt-0 pe-3 fs-5">

                        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#"
                            data-bs-toggle="dropdown">
                            <img src="{{ Auth::user()->foto ? asset(Auth::user()->foto) : asset('assets/img/avatar-' . Auth::user()->sexo . '.png') }}"
                                alt="Profile" width="20" class="rounded-circle">
                            <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->nombres }}</span>
                        </a><!-- End Profile Iamge Icon -->

                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                            <li class="dropdown-header">
                                <h6>{{ Auth::user()->nombres }}</h6>
                                <span>{{ Auth::user()->apellidos }}</span>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <!-- Perfil -->
                            <li>
                                <a class="dropdown-item d-flex align-items-center"
                                    href="{{ route('page.cliente.perfil', Auth::user()->id) }}">
                                    <i class="bi bi-person"></i>
                                    <span>Mi Perfil</span>
                                </a>
                            </li><!-- End perfil-->

                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <!-- Pedidos -->
                            <li>
                                <a class="dropdown-item d-flex align-items-center"
                                    href="{{ route('page.cliente.perfil', Auth::user()->id) }}">
                                    <i class="bi bi-cart"></i>
                                    <span>Pedidos</span>
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <!-- Cerrar sesión-->
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}">
                                    <i class="bi bi-box-arrow-right"></i>
                                    <span class="text-danger">Cerrar sesión</span>
                                </a>
                            </li><!-- Fin Cerrar sesión-->

                        </ul><!-- End Profile Dropdown Items -->
                    </li><!-- End Profile Nav -->
                @else
                    <!-- Identificar me! -->
                    <li class="nav-item dropdown pt-0 pe-3 fs-5">

                        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#"
                            data-bs-toggle="dropdown">

                            <span class="d-none d-md-block dropdown-toggle ps-2">Iniciar o Registrar</span>
                        </a><!-- End Profile Iamge Icon -->

                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">

                            <!-- Login -->
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="{{ route('login.index') }}">
                                    <i class="bi bi-box-arrow-in-right text-primary"></i>
                                    <span>Iniciar sesión</span>
                                </a>
                            </li><!-- End login-->

                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <!-- Registro -->
                            <li>
                                <a class="dropdown-item d-flex align-items-center"
                                    href="{{ route('page.clientes.crear.sesion') }}">
                                    <i class="bi bi-person-add"></i>
                                    <span>¡Registrate!</span>
                                </a>
                            </li>
                        </ul><!-- End Identificar Dropdown Items -->
                    </li><!-- End Identificar me! -->
                @endif

                <!-- Carrito de compras -->
                {{-- <button class="btn btn-none position-relative p-0 mx-3" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasRight_cart_shoping" aria-controls="offcanvasRight_cart_shoping">
                    <i class="bi bi-cart fs-4"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        {{ session('carrito') ? count(session('carrito')) : 0}}
                    </span>
                </button> --}}

                <!-- Carrito de compras para escritorio (visible en lg y más) -->
                <button class="btn btn-none position-relative p-0 mx-3 d-none d-lg-inline" type="button"
                    data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight_cart_shoping"
                    aria-controls="offcanvasRight_cart_shoping">
                    <i class="bi bi-cart fs-4"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        {{ session('carrito') ? count(session('carrito')) : 0 }}
                    </span>
                </button>




            </ul>
        </div>


    </div>
</nav>
<!-------------- End Page Menu ------->

<!-- Carrito de compras -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight_cart_shoping"
    aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasRightLabel">Carrito de compras</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        @if (session('carrito'))
            @php
                $totalPagar = 0;
            @endphp
            @foreach (session('carrito') as $producto)
                @php
                    $totalPagar = $totalPagar + $producto['subtotal'];
                @endphp

                <div class="card mb-3" >
                    <div class="row g-0">
                        <div class="col-md-4">
                            <img src="{{ asset($producto['imagen']) }}" height="150" class="img-fluid rounded-start"
                                alt="{{ $producto['nombre_producto'] }}">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{ $producto['nombre_producto'] }}</h5>
                                <p class="card-text">Cantidad: {{ $producto['cantidad'] }}</p>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card-footer d-flex justify-content-between">
                                <p class="card-text">Precio Unitario: {{ $producto['precio'] }}</p>
                                <p class="card-text">Subtotal: {{ $producto['subtotal'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <!-- total a pagar -->
            <div class="text-center m-2">
                <hr>
                <p>Total a pagar: {{ $totalPagar }} $</p>
                <hr>
            </div>
        @else
            <p class="text-center">No hay productos en el carrito</p>
        @endif

        <!-- botenes del carrito de compras -->
        <div class="text-center m-2">
            <a href="{{ route('page.index') }}/#servicios" class="btn btn-primary ">
                <i class="bi bi-shop"></i>
                Seguir comprando
            </a>
        </div>
        <div class="text-center m-2">
            <a href="{{ route('page.index') }}" class="btn btn-success ">
                <i class="bi bi-paypal"></i>
                Finalizar compra
            </a>
            <a href="{{ route('page.index') }}/#servicios" class="btn btn-warning ">
                <i class="bi bi-cart-fill"></i>
                Ver carrito
            </a>
        </div>
    </div>
</div>
