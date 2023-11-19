@extends('dashboard.index')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Ubah Foto')
@section('content')

    <!-- Striped Rows -->
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">

            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-pills flex-column flex-sm-row mb-4">
                        <li class="nav-item">
                            <a class="nav-link" href="/profile"><i class="ti ti-user-check me-1 ti-xs"></i>
                                Profil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/profile/ubah-profile"><i class="ti-xs ti ti-id me-1"></i>
                                Ubah Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="/profile/ubah-foto"><i class="ti ti-camera me-1 ti-xs"></i>
                                Ubah Foto</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/profile/ubah-password"><i class="ti-xs ti ti-lock me-1"></i>
                                Ubah Password</a>
                        </li>
                    </ul>
                </div>
            </div>

            @if (session('success'))
                <div class="alert alert-success d-flex align-items-center" role="alert">
                    <span class="alert-icon text-success me-2">
                        <i class="ti ti-check ti-xs"></i>
                    </span>
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <span class="alert-icon text-danger me-2">
                        <i class="ti ti-ban ti-xs"></i>
                    </span>
                    {{ session('error') }}
                </div>
            @endif

            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <h5 class="card-header">Ubah Foto Profil</h5>
                        <!-- Account -->
                        <div class="card-body">
                            <div class="d-flex align-items-start align-items-sm-center gap-4">
                                @if (auth()->user()->foto_profil)
                                    <span
                                        style="position: relative; display: inline-block; overflow: hidden; border-radius: 50%; width: 100px; height: 100px;">
                                        <img id="previewImage" src="{{ Storage::url(auth()->user()->foto_profil) }}"
                                            alt="user image" class="d-block h-auto rounded user-profile-img"
                                            style="width: 100%; height: 100%; object-fit: cover;" onmouseover="zoomIn(this)"
                                            onmouseout="zoomOut(this)" />
                                    </span>
                                @else
                                    <img src="{{ asset('img/default.png') }}" alt="default user image"
                                        class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img" width="100px" />
                                @endif

                                <div class="button-wrapper">
                                    <form action="{{ route('update-foto') }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <label for="upload" class="btn btn-primary me-2 mb-3 w-60" tabindex="0">
                                            <span class="d-none d-sm-block">Unggah Foto Baru</span>
                                            <i class="ti ti-upload d-block d-sm-none"></i>
                                            <input type="file" id="upload" class="account-file-input" hidden
                                                accept="image/png, image/jpeg" name="foto_profil"
                                                onchange="previewImage(this)">
                                        </label>
                                        {{-- <button type="button" class="btn btn-label-secondary account-image-reset mb-3">
                                            <i class="ti ti-refresh-dot d-block d-sm-none"></i>
                                            <span class="d-none d-sm-block">Reset</span>
                                        </button> --}}
                                        <div class="ml-1">
                                            <button type="submit" class="btn btn-success mb-3 w-60">Simpan
                                                Perubahan</button>
                                        </div>
                                    </form>

                                    <small class="text-muted">Hanya JPG, GIF or PNG yang bisa di unggah. Maksimal ukuran 2MB
                                    </small>
                                </div>
                            </div>
                        </div>
                        <hr class="my-0" />
                        <!-- /Account -->
                    </div>
                </div>
            </div>



        </div>
    </div>
    <script>
        function previewImage(input) {
            var preview = document.querySelector('.user-profile-img');
            var file = input.files[0];
            var reader = new FileReader();

            reader.onloadend = function() {
                preview.src = reader.result;
            };

            if (file) {
                reader.readAsDataURL(file);
            } else {
                preview.src = "{{ asset('img/default.png') }}"; // Ganti dengan URL gambar default
            }
        }
    </script>

@endsection
