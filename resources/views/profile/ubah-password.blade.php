@extends('dashboard.index')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Ubah Kata Sandi')
@section('content')

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
                            <a class="nav-link" href="/profile/ubah-foto"><i class="ti ti-camera me-1 ti-xs"></i>
                                Ubah Foto</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="/profile/ubah-password"><i class="ti-xs ti ti-lock me-1"></i>
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
                <div class="col-xl-12 col-lg-5 col-md-5">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="card-body">
                                <form id="formAccountSettings" enctype="multipart/form-data" method="POST"
                                    action="{{ route('update-password') }}">
                                    @csrf
                                    <h5 class="card-text text-uppercase">Ubah Password</h5>
                                    <div class="row">
                                        <div class="mb-3 col-md-12">
                                            <label for="firstName" class="form-label">Kata Sandi Baru</label>
                                            <input class="form-control" type="password" id="password" name="password"
                                                autofocus />
                                        </div>
                                        <div class="mb-3 col-md-12">
                                            <label for="firstName" class="form-label">Konfirmasi Kata Sandi Baru</label>
                                            <input class="form-control" type="password" id="password_confirmation"
                                                name="password_confirmation" />
                                        </div>

                                        <div class="mb-3 col-md-12">
                                            <small id="passwordMismatch" class="text-danger"></small>
                                        </div>

                                    </div>
                                    <div class="mt-2">
                                        <button type="submit" class="btn btn-primary me-2">Save changes</button>
                                        {{-- <button type="reset" class="btn btn-label-secondary">Cancel</button> --}}
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>


                </div>


            </div>

        </div>
    </div>

    <script>
        const passwordInput = document.getElementById('password');
        const passwordConfirmationInput = document.getElementById('password_confirmation');
        const passwordMismatchElement = document.getElementById('passwordMismatch');

        passwordInput.addEventListener('keyup', () => {
            if (passwordConfirmationInput.value) {
                if (passwordInput.value !== passwordConfirmationInput.value) {
                    passwordMismatchElement.textContent = 'Kata sandi tidak sama';
                } else {
                    passwordMismatchElement.textContent = '';
                }
            }
        });

        passwordConfirmationInput.addEventListener('keyup', () => {
            if (passwordInput.value) {
                if (passwordInput.value !== passwordConfirmationInput.value) {
                    passwordMismatchElement.textContent = 'Kata sandi tidak sama';
                } else {
                    passwordMismatchElement.textContent = '';
                }
            }
        });
    </script>
@endsection
