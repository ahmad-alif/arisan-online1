<!-- resources/views/layouts/navbar.blade.php -->

{{-- @auth
    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        {{ auth()->user()->name }}
    </a>
    <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="{{ route('dashboard') }}"><i
                    class="bi bi-layout-text-sidebar-reverse"></i>Dashboard</a></li>

        <li>
            <hr class="dropdown-divider">
        </li>
        <li>
            <form action="{{ route('logout') }}" method="post">
                @csrf
                <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right"></i>Logout</button>
            </form>
        </li>
    </ul>
@else
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">Login</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('register') }}">Register</a>
        </li>
    </ul>
@endauth --}}
<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <a href="/dashboard" class="logo d-flex align-items-center">
            <img src="/img/logo.png" alt="">
            <span class="d-none d-lg-block">Arisanku</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->

    {{-- <div class="search-bar">
        <form class="search-form d-flex align-items-center" method="POST" action="#">
            <input type="text" name="query" placeholder="Search" title="Enter search keyword">
            <button type="submit" title="Search"><i class="bi bi-search"></i></button>
        </form>
    </div> --}}

    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">

            <li class="nav-item d-block d-lg-none">
                <a class="nav-link nav-icon search-bar-toggle " href="#">
                    <i class="bi bi-search"></i>
                </a>
            </li><!-- End Search Icon-->

            <li class="nav-item dropdown pe-3">

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    @if (auth()->user()->foto_profil)
                        <img src="{{ Storage::url(auth()->user()->foto_profil) }}" alt="Profile"
                            class="rounded-circle">
                    @else
                        <img src="{{ asset('img/default.png') }}" alt="Default Profile" class="rounded-circle">
                    @endif
                    <span class="d-none d-md-block dropdown-toggle ps-2">{{ auth()->user()->name }}</span>
                </a><!-- End Profile Iamge Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6>{{ auth()->user()->name }}</h6>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li><a class="dropdown-item" href="/dashboard"><i
                                class="bi bi-layout-text-sidebar-reverse"></i>Dashboard</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    @if (auth()->user()->active == 0)
                        <li>
                            <a class="dropdown-item d-flex align-items-center text-danger fw-bold"
                                href="/verification-account">
                                <i class="bi bi-check2-circle"></i>
                                <span>Verifikasi Akun</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                    @endif

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="/account-setting">
                            <i class="bi bi-gear"></i>
                            <span>Pengaturan Akun</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="/change-pict">
                            <i class="bi bi-person-bounding-box"></i>
                            <span>Ubah Foto</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="/change-password">
                            <i class="bi bi-key"></i>
                            <span>Ubah Password</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <button type="submit" class="dropdown-item"><i
                                    class="bi bi-box-arrow-right"></i>Logout</button>
                        </form>
                    </li>

                </ul><!-- End Profile Dropdown Items -->
            </li><!-- End Profile Nav -->

        </ul>
    </nav><!-- End Icons Navigation -->

</header>
