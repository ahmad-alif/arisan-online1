@extends('dashboard.index')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Ubah Kata Sandi')
@section('content')

    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">


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
                                <form method="POST" action="{{ route('update-password') }}" novalidate="novalidate" enctype="multipart/form-data">
                                    @csrf
                                    <h5 class="card-text text-uppercase">Ubah Password</h5>
                                    <div class="row">
                                        <div class="mb-3 col-md-12">
                                            <label for="firstName" class="form-label">Kata Sandi Lama</label>
                                            <input class="form-control" type="password" id="old_password" name="old_password"
                                                autofocus />
                                            <div id="password-feedback"></div>
                                        </div>
                                        <div class="mb-3 col-md-12">
                                            <label for="firstName" class="form-label">Kata Sandi Baru</label>
                                            <input class="form-control" type="password" id="new_password" name="new_password"
                                                autofocus />
                                        </div>
                                        <div class="mb-3 col-md-12">
                                            <label for="firstName" class="form-label">Konfirmasi Kata Sandi Baru</label>
                                            <input class="form-control" type="password" id="new_password_confirmation"
                                                name="new_password_confirmation" />
                                        </div>

                                        <div class="mb-3 col-md-12">
                                            <div id="password-error" class="text-danger"></div>
                                        </div>

                                    </div>
                                    <div class="mt-2">
                                        <button type="submit" class="btn btn-primary me-2">Ubah sandi</button>
                                        {{-- <button type="reset" class="btn btn-label-secondary">Cancel</button> --}}
                                        <button type="reset" class="btn btn-label-secondary waves-effect">Reset</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>


                </div>


            </div>

        </div>
    </div>

    {{-- <script>
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
    </script> --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#old_password').on('input', function() {
                var oldPassword = $(this).val();

                // Buat permintaan Ajax untuk memeriksa kata sandi lama
                $.ajax({
                    url: '{{ route('check-old-password') }}',
                    type: 'POST',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'old_password': oldPassword
                    },
                    success: function(response) {
                        if (response.valid) {
                            $('#password-feedback').html('<p class="text-success">Password lama benar.</p>');
                        } else {
                            $('#password-feedback').html('<p class="text-danger">Password lama salah.</p>');
                        }
                    }
                });
            });
        });
      </script>


      <script>
        $(document).ready(function() {
            $('#new_password_confirmation').on('input', function() {
                var new_password = $('#new_password').val();
                var confirmPassword = $(this).val();
                var errorDiv = $('#password-error');

                if (new_password === confirmPassword) {
                    errorDiv.text('');
                } else {
                    errorDiv.text('Password Tidak Cocok');
                }
            });
        });
      </script>
@endsection
