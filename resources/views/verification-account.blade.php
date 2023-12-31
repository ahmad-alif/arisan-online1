@extends('dashboard.index')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Verifikasi Akun')
@section('content')

    <!-- Striped Rows -->
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">

            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <h5 class="card-header">Verifikasi Akun</h5>
                        <!-- Account -->
                        <div class="card-body">
                            <div class="d-flex align-items-start align-items-sm-center gap-4">
                                @if (auth()->user()->foto_ktp)
                                    <span
                                        style="position: relative; display: inline-block; overflow: hidden; border-radius: 50%; width: 100px; height: 100px;">
                                        <img id="previewImage" src="{{ Storage::url(auth()->user()->foto_ktp) }}"
                                            alt="Foto Ktp" class="d-block h-auto rounded user-profile-img"
                                            style="width: 100%; height: 100%; object-fit: cover;" onmouseover="zoomIn(this)"
                                            onmouseout="zoomOut(this)" />
                                    </span>
                                @else
                                    <img src="{{ asset('img/default.png') }}" alt="default"
                                        class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img" width="100px" />
                                @endif

                                <div class="button-wrapper">
                                    @if (auth()->user()->role == 1)
                                        <form action="{{ route('processVerificationAccount') }}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <label for="upload" class="btn btn-primary me-2 mb-3 w-60" tabindex="0">
                                                <span class="d-none d-sm-block">Unggah Foto KTP</span>
                                                <i class="ti ti-upload d-block d-sm-none"></i>
                                                <input type="file" id="upload" class="account-file-input" hidden
                                                    accept="image/png, image/jpeg" name="foto_ktp"
                                                    onchange="previewImage(this)">
                                            </label>
                                            <div class="ml-1">
                                                <button type="submit" class="btn btn-success mb-3 w-60">Simpan</button>
                                            </div>
                                        </form>
                                    @elseif (auth()->user()->role == 0)
                                        <form action="{{ route('processVerificationAccountMember') }}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <label for="upload" class="btn btn-primary me-2 mb-3 w-60" tabindex="0">
                                                <span class="d-none d-sm-block">Unggah Foto KTP</span>
                                                <i class="ti ti-upload d-block d-sm-none"></i>
                                                <input type="file" id="upload" class="account-file-input" hidden
                                                    accept="image/png, image/jpeg" name="foto_ktp"
                                                    onchange="previewImage(this)">
                                            </label>
                                            <div class="ml-1">
                                                <button type="submit" class="btn btn-success mb-3 w-60">Simpan</button>
                                            </div>
                                        </form>
                                    @endif

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
