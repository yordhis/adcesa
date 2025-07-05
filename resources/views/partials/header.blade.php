    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="{{ route('admin.panel.index') }}" class="">
                <img src="{{ asset('assets/img/logo.png') }}" height="50" width="100" alt="">
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->


        <!-- Init Notifications -->
        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <!-- End Profile Nav -->
                <li class="nav-item dropdown pe-3">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#"
                        data-bs-toggle="dropdown">
                        <img src="{{ Auth::user()->foto ? asset(Auth::user()->foto) : asset('assets/img/avatar-m.png') }}" alt="Avatar img"
                            class="rounded-circle">
                        <span class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->nombres ?? '' }}</span>
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6>{{ Auth::user()->nombre }}</h6>
                            <span>{{ Auth::user()->rol ? 'Aministrador' : 'Asistente' }}</span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>



                        <li>
                            <form action="{{ route('logout') }}" method="post" class="text-center">
                                @csrf
                                @method('post')
                                <button type="submit" class="btn btn-node ">
                                    <i class="bi bi-box-arrow-right"></i>
                                    <span>Salir</span>
                                </button>
                                </a>
                            </form>
                        </li>

                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->
