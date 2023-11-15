@extends('layouts.app')

@section('container')
    @include('layouts.navbar')
    @include('layouts.sidebar')
    <main id="main" class="main">

        <div class="pagetitle border-bottom pb-3">
            <h1>Tambah Arisan</h1>
        </div><!-- End Page Title -->

        <div class="card">
            <div class="card-body pt-3">

                <!-- General Form Elements -->
                <form method="post" enctype="multipart/form-data" action="{{ route('processAddArisan') }}" novalidate>
                    <div class="row mb-3">
                        <div class="col-sm-12">
                            <a href="/manage-arisan" class="btn btn-outline-danger">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>
                    @csrf
                    <div class="row mb-3">
                        <label for="name" class="col-sm-2 col-form-label">Nama Arisan</label>
                        <div class="col-sm-10">
                            <input type="text" name="nama_arisan"
                                class="form-control @error('nama_arisan') is-invalid @enderror" id="nama_arisan" required>
                            @error('nama_arisan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="owner" class="col-sm-2 col-form-label">Pilih Owner</label>
                        <div class="col-sm-10">
                            <select name="id_user" class="form-control @error('id_user') is-invalid @enderror"
                                id="owner" required>
                                <option value="" disabled selected>Pilih Owner</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                            @error('id_user')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>


                    <div class="row mb-3">
                        <label for="start_date" class="col-sm-2 col-form-label">Mulai</label>
                        <div class="col-sm-10">
                            <input type="date" name="start_date"
                                class="form-control @error('start_date') is-invalid @enderror" id="start_date" required>
                            @error('start_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="end_date" class="col-sm-2 col-form-label">Berakhir</label>
                        <div class="col-sm-10">
                            <input type="date" name="end_date"
                                class="form-control @error('end_date') is-invalid @enderror" id="end_date" required>
                            @error('end_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="img_arisan" class="col-sm-2 col-form-label">Gambar Arisan</label>
                        <div class="col-sm-10">
                            <input type="file" name="img_arisan"
                                class="form-control @error('img_arisan') is-invalid @enderror" id="img_arisan" required
                                onchange="previewImage(this);">
                            @error('img_arisan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <img id="preview" src="" alt="Preview"
                                style="max-width: 100px; margin-top: 10px; display: none;">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Tambahkan</button>
                        </div>
                    </div>
                </form><!-- End General Form Elements -->

            </div>
        </div>

    </main>
    @include('layouts.footer')

    <script>
        function previewImage(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview').src = e.target.result;
                    document.getElementById('preview').style.display = 'block';
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
