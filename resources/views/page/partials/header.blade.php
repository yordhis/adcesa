<!-------------- Page Menu ------->
<nav class="navbar sticky-top navbar-expand-lg navbar-light bg-menu">
    <div class="container-fluid">
        <!-- Logo de la empresa -->
        <a class="navbar-brand" href="{{ route('page.index') }}">
            <img src="{{ asset('/assets/img/logo.png') }}" alt="logo" class="img-logo">
        </a>

        <!-- Buscador de productos -->
        <form class="w-50" role="search">
            <div class="input-group">
                <input class="form-control " type="search" name="buscar_producto_servicio"
                    placeholder="Buscar producto o servicio" aria-label="Search" />
                <button class="btn btn-outline-primary" type="submit"><i class="bi bi-search"></i></button>

            </div>
        </form>

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
                        <li><a class="dropdown-item fs-5" href="{{ route('page.index') }}#quienes_somos">¿Quiénes somos?</a></li>
                        <li><a class="dropdown-item fs-5" href="{{ route('page.index') }}#mision">Misión</a></li>
                        <li><a class="dropdown-item fs-5" href="{{ route('page.index') }}#vision">Visión</a></li>
                    </ul>
                </li>

                <!-- Contactos -->
                <li class="nav-item fs-5">
                    <a class="nav-link" href="#contactos">Contactos</a>
                </li>

                <!-- Carrito de compras -->

                <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasRight_cart_shoping" aria-controls="offcanvasRight_cart_shoping">
                    <i class="bi bi-cart"></i>
                </button>



            </ul>
        </div>


    </div>
</nav>
<!-------------- End Page Menu ------->

<!-- Offcanvas para el carrito de compras -->
<!-- Si el carrito está vacío, mostrar un mensaje -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight_cart_shoping"
    aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasRightLabel">Carrito de compras</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <p class="text-center">No hay productos en el carrito</p>
        <div class="text-center">
            <a href="{{ route('page.index') }}" class="btn btn-primary">Seguir comprando</a>
        </div>
    </div>
</div>
