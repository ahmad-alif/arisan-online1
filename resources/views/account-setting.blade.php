@extends('layouts.app')

@section('container')
    @include('layouts.navbar')
    @include('layouts.sidebar')
    <main id="main" class="main">

        <div class="pagetitle border-bottom pb-3">
            <h1>Pengaturan Akun</h1>
        </div><!-- End Page Title -->

        <div class="card">
            <div class="card-body pt-3">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif


                <!-- General Form Elements -->
                <form method="post" enctype="multipart/form-data" action="{{ route('processAccountSetting') }}" novalidate>
                    @csrf
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" class="form-control" id="name"
                                value="{{ auth()->user()->name }}" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Username</label>
                        <div class="col-sm-10">
                            <input type="text" name="username" class="form-control" id="username"
                                value="{{ auth()->user()->username }}" required disabled>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" name="email" class="form-control" id="email"
                                value="{{ auth()->user()->email }}" required disabled>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputNumber" class="col-sm-2 col-form-label">No HP</label>
                        <div class="col-sm-10">
                            <input type="number" name="nohp" class="form-control" id="nohp"
                                value="{{ auth()->user()->nohp }}" required disabled>
                        </div>
                    </div>
                    {{-- <div class="row mb-3">
                        <label for="inputNumber" class="col-sm-2 col-form-label">Ubah Foto Profil</label>
                        <div class="col-sm-10">
                            <input class="form-control" type="file" id="formFile">
                        </div>
                    </div> --}}

                    <div class="row mb-3">
                        <div class="col-sm-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>

                </form><!-- End General Form Elements -->

            </div>
        </div>

    </main>
    @include('layouts.footer')
@endsection
