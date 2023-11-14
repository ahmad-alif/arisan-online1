@extends('layouts.app')

@section('container')
    @include('layouts.navbar')
    @include('layouts.sidebar')
    <main id="main" class="main">

        <div class="pagetitle border-bottom pb-3">
            <h1>Edit member</h1>
        </div><!-- End Page Title -->

        <div class="card mb-5">
            <div class="card-body pt-3">

                <!-- General Form Elements -->
                <form method="post" action="{{ route('processEditMember', ['id' => $member->id]) }}" novalidate
                    enctype="multipart/form-data">
                    @csrf
                    <!-- ... Form input fields ... -->
                    <div class="row mb-3">
                        <div class="col-sm-12">
                            <a href="/manage-member" class="btn btn-outline-danger">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" value="{{ $member->name }}"
                                class="form-control @error('name') is-invalid @enderror" id="name" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Username</label>
                        <div class="col-sm-10">
                            <input type="text" name="username" value="{{ $member->username }}"
                                class="form-control @error('username') is-invalid @enderror" id="username" required>
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" name="email" value="{{ $member->email }}"
                                class="form-control @error('email') is-invalid @enderror" id="email" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror" id="password" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-danger">Isi password apabila ingin mengubah
                                password,
                                Apabila tidak kosongkan
                                saja!</small>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="inputEmail" class="col-sm-2 col-form-label">No HP</label>
                        <div class="col-sm-10">
                            <input type="number" name="nohp" value="{{ $member->nohp }}"
                                class="form-control @error('nohp') is-invalid @enderror" id="nohp" required>
                            @error('nohp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-12 d-flex justify-content-center">
                            <img id="preview-image" src="{{ Storage::url($member->foto_profil) }}"
                                class="img-thumbnail img-preview" width="200">
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
