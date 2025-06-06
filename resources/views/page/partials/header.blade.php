<!-------------- Page Menu ------->
<nav class="navbar sticky-top navbar-expand-lg navbar-light bg-menu">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('page.index') }}">
            <img src="{{ asset('/assets/img/logo.png') }}" alt="logo" class="img-logo">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse col-xs-12 nav justify-content-end text-end" id="navbarNav">
            <ul class="navbar-nav ">
                <li class="nav-item">
                    <a class="nav-link fs-5 {{ url()->current() == route('page.index') ? 'active' : '' }}"
                        aria-current="page" href="{{ route('page.index') }}">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fs-5 {{ url()->current() == route('page.index') ? 'active' : '' }}"
                        aria-current="page" href="{{ route('page.index') }}">Servicio y productos</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle fs-5" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Nosotros
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                        <li><a class="dropdown-item fs-5" href="{{route('page.index')}}#historia">Historia</a></li>
                        <li><a class="dropdown-item fs-5" href="{{route('page.index')}}#equipo">Equipo</a></li>
                      <li><a class="dropdown-item fs-5" href="{{route('page.index')}}#vision">Visión</a></li>
                      <li><a class="dropdown-item fs-5" href="{{route('page.index')}}#mision">Misión</a></li>
                    </ul>
                  </li>
                <li class="nav-item fs-5">
                    <a class="nav-link" href="#contactos">Contactos</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
