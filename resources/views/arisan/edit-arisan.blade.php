@extends('layouts.app')

@section('container')
    @include('layouts.navbar')
    @include('layouts.sidebar')
    <main id="main" class="main">

        <div class="pagetitle border-bottom pb-3">
            <h1>Edit arisan</h1>
        </div><!-- End Page Title -->

        <div class="card mb-5">
            <div class="card-body pt-3">

                <!-- General Form Elements -->
                <form method="post" action="{{ route('processEditArisan', ['id' => $arisan->id_arisan]) }}" novalidate
                    enctype="multipart/form-data">

                    @csrf
                    <!-- ... Form input fields ... -->
                    <div class="row mb-3">
                        <div class="col-sm-12">
                            <a href="/manage-arisan" class="btn btn-outline-danger">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Nama Arisan</label>
                        <div class="col-sm-10">
                            <input type="text" name="nama_arisan" value="{{ $arisan->nama_arisan }}"
                                class="form-control @error('nama_arisan') is-invalid @enderror" id="nama_arisan" required>
                            @error('nama_arisan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Mulai</label>
                        <div class="col-sm-10">
                            <input type="date" name="start_date" value="{{ $arisan->start_date }}"
                                class="form-control @error('start_date') is-invalid @enderror" id="start_date" required>
                            @error('start_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Berakhir</label>
                        <div class="col-sm-10">
                            <input type="date" name="end_date" value="{{ $arisan->end_date }}"
                                class="form-control @error('end_date') is-invalid @enderror" id="end_date" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- <div class="row mb-3">
                        <label for="inputEmail" class="col-sm-2 col-form-label">No HP</label>
                        <div class="col-sm-10">
                            <input type="number" name="nohp" value="{{ $arisan->nohp }}"
                                class="form-control @error('nohp') is-invalid @enderror" id="nohp" required>
                            @error('nohp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div> --}}
                    <div class="row mb-3">
                        <div class="col-sm-12 d-flex justify-content-center">
                            @if ($arisan->img_arisan)
                                <img src="{{ Storage::url($arisan->img_arisan) }}" alt="Arisan" class="rounded-circle"
                                    width="100">
                            @else
                                <img src="{{ asset('img/default_arisan.jpg') }}" alt="Default Profile"
                                    class="rounded-circle" width="100">
                            @endif
                        </div>
                    </div>
                    <div class="row mb-1">
                        <label for="inputNumber" class="col-sm-2 col-form-label">Ubah Gambar</label>

                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-12">
                            <input accept="image/png, image/jpeg" class="form-control" type="file" name="img_arisan"
                                id="formFile">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Ubah</button>
                        </div>
                    </div>
                </form><!-- End General Form Elements -->

            </div>
        </div>

    </main>
    @include('layouts.footer')
@endsection
