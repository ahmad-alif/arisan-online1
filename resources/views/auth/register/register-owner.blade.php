@extends('layouts.auth-main')
@section('container')
    {{-- <form method="post" enctype="multipart/form-data" action="{{ route('register.processOwner') }}">
        @csrf
        <div>
            <label for="name">Nama</label>
            <input type="text" name="name" id="name" required>
        </div>
        <div>
            <label for="username">Username</label>
            <input type="text" name="username" id="username" required>
        </div>
        <div>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
        </div>
        <div>
            <label for="nohp">Nomor Handphone</label>
            <input type="text" name="nohp" id="nohp" required>
        </div>
        <div>
            <label for="role">Role</label>
            <input type="text" name="role" id="role" value="1" required>
        </div>
        <div>
            <label for="active">Active</label>
            <input type="text" name="active" id="active" value="1" required>
        </div>

        <div>
            <button type="submit">Register</button>
        </div>
    </form> --}}

    <main>
        <div class="container">

            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            {{-- <div class="d-flex justify-content-center py-4">
                                <a href="index.html" class="logo d-flex align-items-center w-auto">
                                    <img src="assets/img/logo.png" alt="">
                                </a>
                            </div> --}}

                            <div class="card mb-3">

                                <div class="card-body">

                                    <div class="pt-2 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Buat Akun</h5>
                                    </div>

                                    <form method="post" enctype="multipart/form-data"
                                        action="{{ route('register.processOwner') }}" novalidate>
                                        @csrf
                                        <div class="col-12">
                                            <label for="yourName" class="form-label">Nama</label>
                                            <input type="text" name="name" class="form-control" id="nama"
                                                required autofocus value="{{ old('name') }}">
                                        </div>

                                        <div class="col-12">
                                            <label for="yourEmail" class="form-label">Email</label>
                                            <input type="email" name="email" class="form-control" id="email"
                                                required value="{{ old('email') }}" placeholder="example@example.com">

                                        </div>

                                        <div class="col-12">
                                            <label for="yourUsername" class="form-label">Username</label>
                                            <input type="text" name="username" class="form-control" id="username"
                                                required value="{{ old('username') }}">
                                            <div id="usernameAvailability"></div>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourPassword" class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control" id="yourPassword"
                                                required">
                                            @error('password')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-12">
                                            <label for="nohp">Nomor Handphone</label>
                                            <div class="input-group has-validation">
                                                <span class="input-group-text" id="inputGroupPrepend">+62</span>
                                                <input type="number" name="nohp" class="form-control" id="nohp"
                                                    required value="{{ old('nohp') }}">
                                            </div>
                                            <div id="nohpAvailability"></div>
                                        </div>

                                        {{-- <div class="col-12">
                                            <div>
                                                <label for="role">Role</label>
                                                <input type="hidden" name="role" class="form-control" id="role"
                                                    value="1" required>
                                            </div>

                                        </div>
                                        <div class="col-12">
                                            <div>
                                                <label for="active">Active</label>
                                                <input type="hidden" name="active" class="form-control" id="active"
                                                    value="1" required>
                                            </div>
                                        </div> --}}
                                        <div class="col-12 my-3">
                                            <div class="form-check">
                                                <input class="form-check-input" name="terms" type="checkbox"
                                                    value="" id="acceptTerms" required>
                                                <label class="form-check-label" for="acceptTerms">I agree and accept the
                                                    <a href="">terms and conditions</a></label>
                                                <div class="invalid-feedback">You must agree before submitting.</div>
                                            </div>
                                        </div>
                                        <div class="col-12 my-2">
                                            <button class="btn btn-primary w-100" id="registerButton" type="submit">Buat
                                                Akun</button>
                                        </div>
                                        <div class="col-12">
                                            <p class="small mb-0">Sudah punya akun? <a href="/login">Log in</a></p>
                                        </div>
                                    </form>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </section>

        </div>
    </main>
@endsection
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
    const togglePasswordButton = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('yourPassword');
    const toggleIcon = document.getElementById('toggleIcon');

    togglePasswordButton.addEventListener('click', () => {
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.classList.remove('bi-eye-slash');
            toggleIcon.classList.add('bi-eye');
        } else {
            passwordInput.type = 'password';
            toggleIcon.classList.remove('bi-eye');
            toggleIcon.classList.add('bi-eye-slash');
        }
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
