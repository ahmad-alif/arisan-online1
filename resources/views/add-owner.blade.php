@extends('dashboard.index')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Tambah Pemilik | Arisanku')
@section('content')

    <!-- Striped Rows -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-1"><span class="text-muted fw-light">Admin / Kelola Pemilik / </span>Tambah Pemilik</h4>
            <div class="card">
                <!-- Account -->
                <div class="card-body">
                    <h4>Tambah Pemilik dengan cepat🚀</h4>
                    <form method="post" enctype="multipart/form-data" action="{{ route('processAddOwner') }}" novalidate>
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="inputText" class="form-label">Nama</label>
                            <input class="form-control @error('name')
                            is-invalid
                            @enderror" type="text" id="name" name="name"
                                value="" autofocus required />
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="inputUsername" class="form-label">Username</label>
                            <input class="form-control @error('username')
                            is-invalid
                        @enderror" type="text" name="username" id="username"
                                value="" required />
                                @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="inputEmail" class="form-label">E-mail</label>
                            <input class="form-control @error('email')
                            is-invalid
                        @enderror" id="email" name="email"
                                value="" required />
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="organization" class="form-label">No. Telpon</label>
                            <input type="number" class="form-control @error('nohp')
                            is-invalid
                        @enderror" id="nohp" name="nohp"
                                value="" required />
                                @error('nohp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="organization" class="form-label">Password</label>
                            <input type="password" class="form-control @error('password')
                            is-invalid
                        @enderror" id="password" name="password"
                                 required/>
                                @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                    <div class="mt-2">
                        <button type="submit" class="btn btn-primary me-2">Simpan perubahan</button>
                        <a class="btn btn-label-danger" href="/manage-owner">Batal</a>
                    </div>
                    </form>
                </div>

            </div>
            <!--/ Striped Rows -->

        </div>
        <!--/ Responsive Table -->
    </div>
    <!-- / Content -->

@endsection
