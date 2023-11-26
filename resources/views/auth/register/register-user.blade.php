<!DOCTYPE html>

<html lang="en" class="light-style layout-wide customizer-hide" dir="ltr" data-theme="theme-default"
    data-assets-path="../../assets/" data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Daftar sebagai pengguna arisan | Arisanku</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../../assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
        rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="../../assets/vendor/fonts/fontawesome.css" />
    <link rel="stylesheet" href="../../assets/vendor/fonts/tabler-icons.css" />
    <link rel="stylesheet" href="../../assets/vendor/fonts/flag-icons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../../assets/vendor/css/rtl/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../../assets/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../../assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../../assets/vendor/libs/node-waves/node-waves.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/typeahead-js/typeahead.css" />
    <!-- Vendor -->
    <link rel="stylesheet" href="../../assets/vendor/libs/@form-validation/umd/styles/index.min.css" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="../../assets/vendor/css/pages/page-auth.css" />

    <!-- Helpers -->
    <script src="../../assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="../../assets/vendor/js/template-customizer.js"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../../assets/js/config.js"></script>
</head>

<body>
    <!-- Content -->

    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-4">
                <!-- Register Card -->
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center mb-4 mt-2">
                            <a href="index.html" class="app-brand-link gap-2">
                                <span class="app-brand-logo demo">
                                    <svg width="32" height="22" viewBox="0 0 32 22" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z"
                                            fill="#7367F0" />
                                        <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd"
                                            d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z"
                                            fill="#161616" />
                                        <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd"
                                            d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z"
                                            fill="#161616" />
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z"
                                            fill="#7367F0" />
                                    </svg>
                                </span>
                                <span class="app-brand-text demo text-body fw-bold ms-1">Arisanku</span>
                            </a>
                        </div>
                        <!-- /Logo -->
                        <h4 class="mb-1 pt-2">Mulai perjalanan arisan anda🚀</h4>
                        <p class="mb-4">Daftar sebagai pengguna</p>

                        <form class="mb-3" id="formregisteruser" enctype="multipart/form-data"
                            action="{{ route('register.processUser') }}" method="POST" novalidate>
                            @csrf
                            <div class="mb-3">
                                <label for="yourName" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Masukkan nama lengkap anda" autofocus required autofocus
                                    value="{{ old('name') }}" />
                            </div>
                            <div class="mb-3">
                                <label for="yourEmail" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email"
                                    placeholder="contohemail123@mail.com" required autofocus
                                    value="{{ old('email') }}" />
                                <div id="emailAvailability"></div>
                            </div>
                            <div class="mb-3">
                                <label for="yourUsername" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username"
                                    placeholder="Masukkan username anda" autofocus required autofocus
                                    value="{{ old('username') }}" />
                                <div id="usernameAvailability"></div>
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <label class="form-label" for="yourPassword">Password</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="yourPassword" class="form-control" name="password"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        aria-describedby="password" required />
                                    <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                    @error('password')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <label class="form-label" for="konfirmasiPassword">Konfirmasi Password</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="konfirmasiPassword" class="form-control"
                                        name="konfirmasipassword"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        aria-describedby="password" required />
                                    <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="nohp" class="form-label">Nomor Handphone (Whatsapp)</label>
                                <div class="input-group">
                                    <span class="input-group-text">ID (+62)</span>
                                    <input type="text" id="nohp" name="nohp"
                                        class="form-control multi-steps-mobile" placeholder="8xxxxxxxx" required
                                        autofocus value="{{ old('nohp') }}"
                                        oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                        />
                                </div>
                                <div id="nohpAvailability"></div>
                            </div>

                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="terms-conditions"
                                        name="terms" />
                                    <label class="form-check-label" for="terms-conditions">
                                        Saya menyetujui
                                        <a href="javascript:void(0);">kebijakan & ketentuan privasi</a>
                                    </label>
                                </div>
                            </div>
                            <button class="btn btn-primary d-grid w-100">Daftar</button>
                        </form>

                        <p class="text-center">
                            <span>Sudah punya akun?</span>
                            <a href="/login">
                                <span>Masuk saja</span>
                            </a>
                        </p>

                        {{-- <div class="divider my-4">
                <div class="divider-text">or</div>
              </div>

              <div class="d-flex justify-content-center">
                <a href="javascript:;" class="btn btn-icon btn-label-facebook me-3">
                  <i class="tf-icons fa-brands fa-facebook-f fs-5"></i>
                </a>

                <a href="javascript:;" class="btn btn-icon btn-label-google-plus me-3">
                  <i class="tf-icons fa-brands fa-google fs-5"></i>
                </a>

                <a href="javascript:;" class="btn btn-icon btn-label-twitter">
                  <i class="tf-icons fa-brands fa-twitter fs-5"></i>
                </a>
              </div> --}}
                    </div>
                </div>
                <!-- Register Card -->
            </div>
        </div>
    </div>

    <!-- / Content -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->

    <script src="../../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../../assets/vendor/libs/popper/popper.js"></script>
    <script src="../../assets/vendor/js/bootstrap.js"></script>
    <script src="../../assets/vendor/libs/node-waves/node-waves.js"></script>
    <script src="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="../../assets/vendor/libs/hammer/hammer.js"></script>
    <script src="../../assets/vendor/libs/i18n/i18n.js"></script>
    <script src="../../assets/vendor/libs/typeahead-js/typeahead.js"></script>
    <script src="../../assets/vendor/js/menu.js"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="../../assets/vendor/libs/@form-validation/umd/bundle/popular.min.js"></script>
    <script src="../../assets/vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js"></script>
    <script src="../../assets/vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js"></script>

    <!-- Main JS -->
    <script src="../../assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="../../assets/js/pages-auth.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#username').on('keyup', function() {
                var username = $(this).val();

                // Hapus pesan jika input kosong
                if (username === '') {
                    $('#usernameAvailability').empty();
                    return;
                }

                $.ajax({
                    url: '{{ route('checkUsernameAvailability') }}', // Ganti dengan URL yang sesuai
                    type: 'POST',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'username': username
                    },
                    success: function(response) {
                        if (response.available) {
                            $('#usernameAvailability').html(
                                '<p class="text-success">Username tersedia.</p>');
                        } else {
                            $('#usernameAvailability').html(
                                '<p class="text-danger">Username sudah terpakai.</p>');
                        }
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#email').on('keyup', function() {
                var email = $(this).val();

                // Hapus pesan jika input kosong
                if (username === '') {
                    $('#emailAvailability').empty();
                    return;
                }

                $.ajax({
                    url: '{{ route('checkEmailAvailability') }}', // Ganti dengan URL yang sesuai
                    type: 'POST',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'email': email
                    },
                    success: function(response) {
                        if (response.available) {
                            $('#emailAvailability').html(
                                '<p class="text-success">Email tersedia.</p>');
                        } else {
                            $('#emailAvailability').html(
                                '<p class="text-danger">Email sudah terpakai.</p>');
                        }
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#nohp').on('keyup', function() {
                var nohp = $(this).val();

                // Hapus pesan jika input kosong
                if (nohp === '') {
                    $('#nohpAvailability').empty();
                    return;
                }

                $.ajax({
                    url: '{{ route('checkNoHpAvailability') }}', // Ganti dengan URL yang sesuai
                    type: 'POST',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'nohp': nohp
                    },
                    success: function(response) {
                        if (response.available) {
                            $('#nohpAvailability').html(
                                '<p class="text-success">No HP tersedia.</p>');
                        } else {
                            $('#nohpAvailability').html(
                                '<p class="text-danger">No HP sudah terpakai.</p>');
                        }
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            var acceptTermsCheckbox = $('#acceptTerms');
            var registerButton = $('#registerButton');

            // Fungsi untuk memeriksa status checkbox
            function checkCheckboxStatus() {
                var isChecked = acceptTermsCheckbox.is(':checked');
                if (isChecked) {
                    registerButton.prop('disabled', false);
                } else {
                    registerButton.prop('disabled', true);
                }
            }

            // Panggil fungsi saat halaman dimuat
            checkCheckboxStatus();

            // Tambahkan event listener untuk checkbox
            acceptTermsCheckbox.on('change', function() {
                checkCheckboxStatus();
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var passwordInput = document.getElementById('yourPassword');
            var confirmPasswordInput = document.getElementById('konfirmasiPassword');
            var confirmPasswordIcon = document.querySelector('#konfirmasiPassword + .input-group-text i');

            function checkPasswordMatch() {
                var password = passwordInput.value;
                var confirmPassword = confirmPasswordInput.value;

                if (password === confirmPassword) {
                    confirmPasswordInput.classList.remove('is-invalid');
                    confirmPasswordIcon.classList.remove('text-danger');
                } else {
                    confirmPasswordInput.classList.add('is-invalid');
                    confirmPasswordIcon.classList.add('text-danger');
                }
            }

            confirmPasswordInput.addEventListener('input', checkPasswordMatch);
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var form = document.getElementById('formregisteruser');

            form.addEventListener('submit', function() {
                var nohpInput = document.getElementById('nohp');
                var inputValue = nohpInput.value;

                // Menghapus angka 0 di depan nomor handphone sebelum mengirim formulir
                if (inputValue.charAt(0) === '0') {
                    nohpInput.value = inputValue.slice(1);
                }
            });
        });
    </script>


</body>

</html>
