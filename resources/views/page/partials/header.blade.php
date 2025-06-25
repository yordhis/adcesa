<!-------------- Page Menu ------->
<nav class="navbar sticky-top navbar-expand-lg navbar-light bg-menu" id="header">
    <div class="container-fluid">
        <!-- Logo de la empresa -->
        <a class="navbar-brand" href="{{ route('page.index') }}">
            <img src="{{ asset('/assets/img/logo.png') }}" alt="logo" class="img-logo ">
        </a>

        <!-- Buscador de productos -->
        {{-- <form class="w-50" role="search">
            <div class="input-group">
                <input class="form-control " type="search" name="buscar_producto_servicio"
                    placeholder="Buscar producto o servicio" aria-label="Search" />
                <button class="btn btn-outline-primary" type="submit"><i class="bi bi-search"></i></button>

            </div>
        </form> --}}

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
                            <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
                            <span class="d-none d-md-block dropdown-toggle ps-2">K. Anderson</span>
                        </a><!-- End Profile Iamge Icon -->

                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                            <li class="dropdown-header">
                                <h6>Kevin Anderson</h6>
                                <span>Web Designer</span>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <!-- Perfil -->
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                                    <i class="bi bi-person"></i>
                                    <span>Mi Perfil</span>
                                </a>
                            </li><!-- End perfil-->

                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <!-- Pedidos -->
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                                    <i class="bi bi-cart"></i>
                                    <span>Pedidos</span>
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <!-- Cerrar sesión-->
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="#">
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
                                <a class="dropdown-item d-flex align-items-center" href="{{route('login.index')}}">
                                    <i class="bi bi-box-arrow-in-right text-primary"></i>
                                    <span>Iniciar sesión</span>
                                </a>
                            </li><!-- End login-->

                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <!-- Registro -->
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="{{route('page.clientes.crear.sesion')}}">
                                    <i class="bi bi-person-add"></i>
                                    <span>¡Registrate!</span>
                                </a>
                            </li>
                        </ul><!-- End Identificar Dropdown Items -->
                    </li><!-- End Identificar me! -->
                @endif








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

<!-- Carrito de compras -->
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

{{-- <!-- ======= Header ======= -->
  <header id="header" class="header bg-white fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">NiceAdmin</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div><!-- End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->

        <li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-bell"></i>
            <span class="badge bg-primary badge-number">4</span>
          </a><!-- End Notification Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
            <li class="dropdown-header">
              You have 4 new notifications
              <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-exclamation-circle text-warning"></i>
              <div>
                <h4>Lorem Ipsum</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>30 min. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-x-circle text-danger"></i>
              <div>
                <h4>Atque rerum nesciunt</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>1 hr. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-check-circle text-success"></i>
              <div>
                <h4>Sit rerum fuga</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>2 hrs. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="notification-item">
              <i class="bi bi-info-circle text-primary"></i>
              <div>
                <h4>Dicta reprehenderit</h4>
                <p>Quae dolorem earum veritatis oditseno</p>
                <p>4 hrs. ago</p>
              </div>
            </li>

            <li>
              <hr class="dropdown-divider">
            </li>
            <li class="dropdown-footer">
              <a href="#">Show all notifications</a>
            </li>

          </ul><!-- End Notification Dropdown Items -->

        </li><!-- End Notification Nav -->

        <li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-chat-left-text"></i>
            <span class="badge bg-success badge-number">3</span>
          </a><!-- End Messages Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
            <li class="dropdown-header">
              You have 3 new messages
              <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="message-item">
              <a href="#">
                <img src="assets/img/messages-1.jpg" alt="" class="rounded-circle">
                <div>
                  <h4>Maria Hudson</h4>
                  <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                  <p>4 hrs. ago</p>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="message-item">
              <a href="#">
                <img src="assets/img/messages-2.jpg" alt="" class="rounded-circle">
                <div>
                  <h4>Anna Nelson</h4>
                  <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                  <p>6 hrs. ago</p>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="message-item">
              <a href="#">
                <img src="assets/img/messages-3.jpg" alt="" class="rounded-circle">
                <div>
                  <h4>David Muldon</h4>
                  <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                  <p>8 hrs. ago</p>
                </div>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li class="dropdown-footer">
              <a href="#">Show all messages</a>
            </li>

          </ul><!-- End Messages Dropdown Items -->

        </li><!-- End Messages Nav -->

        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2">K. Anderson</span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <h6>Kevin Anderson</h6>
              <span>Web Designer</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-person"></i>
                <span>My Profile</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                <i class="bi bi-gear"></i>
                <span>Account Settings</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                <i class="bi bi-question-circle"></i>
                <span>Need Help?</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="#">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header --> --}}
