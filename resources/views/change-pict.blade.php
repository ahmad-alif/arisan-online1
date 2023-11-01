@extends('layouts.app')

@section('container')
    @include('layouts.navbar')
    @include('layouts.sidebar')
    <main id="main" class="main">

        <div class="pagetitle border-bottom pb-3">
            <h1>Ubah Foto Profil</h1>
        </div><!-- End Page Title -->

        <div class="card">
            <div class="card-body pt-3">

                <!-- General Form Elements -->
                <form method="POST" action="{{ route('update-pict') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-sm-12 d-flex justify-content-center">
                            <img src="{{ Storage::url(auth()->user()->foto_profil) }}" class="img-thumbnail img-preview"
                                width="200">
                        </div>
                    </div>
                    <div class="row mb-1">
                        <label for="inputNumber" class="col-sm-2 col-form-label">Ubah Foto Profil</label>

                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-12">
                            <input class="form-control" type="file" name="foto_profil" id="formFile">
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
