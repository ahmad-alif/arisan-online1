<!DOCTYPE html>

<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr"
    data-theme="theme-default" data-assets-path="/assets/" data-template="vertical-menu-template-starter">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>@yield('pageTitle')</title>
    <meta name="description" content="" />
    <link rel="icon" type="image/x-icon" href="/assets/img/favicon/favicon.ico" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="/assets/vendor/fonts/tabler-icons.css" />
    <link rel="stylesheet" href="/assets/vendor/fonts/fontawesome.css" />
    <link rel="stylesheet" href="/assets/vendor/css/rtl/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="/assets/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="/assets/css/demo.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/animate-css/animate.css" />
    <link rel="stylesheet" href="/assets/vendor/libs/node-waves/node-waves.css" />
    <link rel="stylesheet" href="/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <script src="/assets/vendor/js/helpers.js"></script>
    <script src="/assets/vendor/js/template-customizer.js"></script>
    <script src="/assets/js/config.js"></script>
    <style>
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background-color: #f8f7fa;
        }

        ::-webkit-scrollbar-thumb {
            background-color: #7367f0;
            border-radius: 5px;
        }
    </style>
    {{-- <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> --}}
</head>

<body>
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">

            @include('layouts.sidebar')
            <div class="layout-page">
                @include('layouts.navbar')
                <div class="content-wrapper">
                    @yield('content')
                </div>
                @stack('scripts')
                @include('layouts.footer')
                <div class="content-backdrop fade"></div>
            </div>
        </div>
    </div>

    <div class="layout-overlay layout-menu-toggle"></div>
    <div class="drag-target"></div>
    </div>
    <script src="/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="/assets/vendor/libs/popper/popper.js"></script>
    <script src="/assets/vendor/js/bootstrap.js"></script>
    <script src="/assets/vendor/libs/node-waves/node-waves.js"></script>
    <script src="/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="/assets/vendor/libs/hammer/hammer.js"></script>
    <script src="/assets/vendor/js/menu.js"></script>
    <script src="/assets/js/ui-modals.js"></script>
    <script src="/assets/js/main.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}"
            switch (type) {
                case 'info':
                    toastr.info(" {{ Session::get('message') }} ");
                    break;

                case 'success':
                    toastr.success(" {{ Session::get('message') }} ");
                    break;

                case 'warning':
                    toastr.warning(" {{ Session::get('message') }} ");
                    break;

                case 'error':
                    toastr.error(" {{ Session::get('message') }} ");
                    break;
            }
        @endif
    </script>
    {{-- <script>
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
    </script> --}}
    <script>
        $(document).ready(function() {
            $('#username').on('keyup', function() {
                var username = $(this).val();

                // Hapus pesan jika input kosong
                if (username === '') {
                    $('#loading').hide();
                    $('#availabilityMessage').empty();
                    return;
                }

                // Tampilkan animasi loading
                $('#loading').show();

                $.ajax({
                    url: '{{ route('checkUsernameAvailability') }}',
                    type: 'POST',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'username': username
                    },
                    success: function(response) {
                        // Sembunyikan animasi loading
                        $('#loading').hide();

                        // Tampilkan pesan ketersediaan
                        $('#availabilityMessage').html(response.message);
                    }
                });

                checkUsernameAvailability();

                $('#username').on('keyup', function() {
                    checkUsernameAvailability();
                });
            });
        });
    </script>

    {{-- <script>
        $(document).ready(function() {
            $('#email').on('keyup', function() {
                var email = $(this).val();

                // Hapus pesan jika input kosong
                if (email === '') {
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
    </script> --}}
    <script>
        $(document).ready(function() {
            $('#email').on('keyup', function() {
                var email = $(this).val();

                // Hapus pesan jika input kosong
                if (email === '') {
                    $('#loadingEmail').hide();
                    $('#availabilityMessageEmail').empty();
                    return;
                }

                // Tampilkan animasi loading
                $('#loadingEmail').show();

                $.ajax({
                    url: '{{ route('checkEmailAvailability') }}',
                    type: 'POST',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'email': email
                    },
                    success: function(response) {
                        // Sembunyikan animasi loading
                        $('#loadingEmail').hide();

                        // Tampilkan pesan ketersediaan
                        $('#availabilityMessageEmail').html(response.message);
                    }
                });
                checkEmailAvailability();
                $('#email').on('keyup', function() {
                    checkEmailAvailability();
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
                checkNohpAvailability();
                $('#nohp').on('keyup', function() {
                    checkNohpAvailability();
                });
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const inputFotoKTP = document.querySelector('input[name="foto_ktp"]');
            const previewImage = document.getElementById('preview-image');

            inputFotoKTP.addEventListener('change', function() {
                const file = inputFotoKTP.files[0];
                if (file) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        previewImage.src = e.target.result;
                    };

                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const inputFotoProfil = document.querySelector('input[name="foto_profil"]');
            const previewImage = document.getElementById('previewImage');

            inputFotoProfil.addEventListener('change', function() {
                const file = inputFotoProfil.files[0];
                if (file) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        previewImage.src = e.target.result;
                    };

                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
</body>

</html>
