<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <!-- Tambahkan link CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Your App</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    @guest
                        <!-- Tampilkan tombol login jika pengguna belum login -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register.showRoleSelection') }}">Register</a>
                        </li>
                    @else
                        <li class="dropdown-header">
                            <h6>{{ auth()->user()->name }}</h6>
                            <span>Web Designer</span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li><a class="dropdown-item" href="#"><i
                                    class="bi bi-layout-text-sidebar-reverse"></i>Dashboard</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <i class="bi bi-gear"></i>
                                <span>Account Settings</span>
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

                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row">
            @foreach ($arisans as $arisan)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        @if ($arisan->img_arisan)
                            <img src="{{ Storage::url($arisan->img_arisan) }}" class="card-img-top"
                                alt="{{ $arisan->nama_arisan }}">
                        @else
                            <img src="{{ asset('img/default_arisan.jpg') }}" class="card-img-top" alt="Default Image">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $arisan->nama_arisan }}</h5>
                            <p class="card-text">Start Date: {{ $arisan->start_date }}</p>
                            <p class="card-text">End Date: {{ $arisan->end_date }}</p>
                            {{-- <p class="card-text">Owner: {{ $arisan->id_user }}</p> --}}
                            @if ($arisan->user)
                                <p class="card-text">Owner: {{ $arisan->user->name }}</p>
                            @else
                                <p class="card-text">Owner: Tidak Diketahui</p>
                            @endif
                            <a href="{{ route('register.user', ['id_arisan' => $arisan->id_arisan]) }}"
                                class="btn btn-primary">Join</a>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="container mt-4">
        <h2>Rekomendasi Arisan</h2>
        <div class="row">
            @foreach ($rekomendasiArisans as $arisan)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <!-- Tampilkan informasi arisan rekomendasi -->
                        @if ($arisan->img_arisan)
                            <img src="{{ Storage::url($arisan->img_arisan) }}" class="card-img-top"
                                alt="{{ $arisan->nama_arisan }}">
                        @else
                            <img src="{{ asset('img/default_arisan.jpg') }}" class="card-img-top" alt="Default Image">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $arisan->nama_arisan }}</h5>
                            <p class="card-text">Start Date: {{ $arisan->start_date }}</p>
                            <p class="card-text">End Date: {{ $arisan->end_date }}</p>
                            <p class="card-text">Owner: {{ $arisan->user ? $arisan->user->name : 'Tidak Diketahui' }}
                            </p>
                            <a href="{{ route('register.user', ['id_arisan' => $arisan->id_arisan]) }}"
                                class="btn btn-primary">Join</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="container mt-4">
        <h2>Arisan Terbaru</h2>
        <div class="row">
            @foreach ($terbaruArisans as $arisan)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <!-- Tampilkan informasi arisan terbaru -->
                        @if ($arisan->img_arisan)
                            <img src="{{ Storage::url($arisan->img_arisan) }}" class="card-img-top"
                                alt="{{ $arisan->nama_arisan }}">
                        @else
                            <img src="{{ asset('img/default_arisan.jpg') }}" class="card-img-top" alt="Default Image">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $arisan->nama_arisan }}</h5>
                            <p class="card-text">Start Date: {{ $arisan->start_date }}</p>
                            <p class="card-text">End Date: {{ $arisan->end_date }}</p>
                            <p class="card-text">Owner: {{ $arisan->user ? $arisan->user->name : 'Tidak Diketahui' }}
                            </p>
                            <a href="{{ route('register.user', ['id_arisan' => $arisan->id_arisan]) }}"
                                class="btn btn-primary">Join</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>


    <!-- Tambahkan konten halaman di sini -->

    <!-- Tambahkan link JavaScript Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.min.js"></script>
</body>

</html>
