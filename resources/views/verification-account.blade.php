@extends('layouts.app')

@section('container')
    @include('layouts.navbar')
    @include('layouts.sidebar')
    <main id="main" class="main">

        <div class="pagetitle border-bottom pb-3">
            <h1>Verifikasi Akun</h1>
        </div><!-- End Page Title -->

        <div class="card">
            <div class="card-body pt-3">

                <!-- General Form Elements -->
                <form method="POST" action="{{ route('processVerificationAccount') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        @if (auth()->user()->foto_ktp)
                            <div class="col-sm-12 d-flex justify-content-center">
                                <img id="preview-image" src="{{ Storage::url(auth()->user()->foto_ktp) }}"
                                    class="img-thumbnail img-preview" width="200">
                            </div>
                        @else
                            <div class="col-sm-12 d-flex justify-content-center">
                                <p class="fw-bold text-danger mb-3">Belum ada foto KTP. Silahkan Upload foto KTP!</p>
                            </div>
                            <div class="col-sm-12 d-flex justify-content-center">
                                <img id="preview-image" class="img-thumbnail img-preview" width="200">
                            </div>
                        @endif

                    </div>
                    <div class="row mb-1">
                        <label for="inputNumber" class="col-sm-2 col-form-label">Upload Foto KTP</label>

                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-12">
                            <input class="form-control" type="file" name="foto_ktp" id="formFile">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-12 d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>

                </form><!-- End General Form Elements -->

            </div>
        </div>

    </main>
    @include('layouts.footer')
@endsection

{{-- <script>
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
</script> --}}
