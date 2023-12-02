@extends('dashboard.index')

@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Tambah Pemilik | Arisanku')

@section('content')
    <!-- Striped Rows -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-1">
                <span class="text-muted fw-light">Admin / Kelola Member / </span>Tambah Member
            </h4>
            <div class="card">
                <!-- Account -->
                <div class="card-body">
                    <h4>Tambah Member dengan cepat🚀</h4>
                    <form method="post" enctype="multipart/form-data" action="{{ route('processAddOwner') }}" novalidate>
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="inputText" class="form-label">Nama</label>
                                <input class="form-control @error('name') is-invalid @enderror" type="text"
                                    id="name" name="name" autofocus required value="{{ old('name') }}" />
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="inputUsername" class="form-label">Username</label>
                                <input class="form-control @error('username') is-invalid @enderror" type="text"
                                    name="username" id="username" value="{{ old('username') }}" required />
                                <div id="usernameAvailability">
                                    <div id="loading" style="display: none;">
                                        <img src="img/loading.gif" alt="Loading..." width="20" height="20">
                                    </div>
                                    <div id="availabilityMessage"></div>
                                </div>
                                @error('username')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="inputEmail" class="form-label">E-mail</label>
                                <input class="form-control @error('email') is-invalid @enderror" id="email"
                                    name="email" value="{{ old('email') }}" required />
                                <div id="emailAvailability">
                                    <div id="loading" style="display: none;">
                                        <img src="img/loading.gif" alt="Loading..." width="20" height="20">
                                    </div>
                                    <div id="availabilityMessageEmail" class="mt-2"></div>
                                </div>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="organization" class="form-label">No. Telepon <small>(Whatsapp)</small></label>
                                <input type="number" class="form-control @error('nohp') is-invalid @enderror"
                                    id="nohp" name="nohp" value="{{ old('nohp') }}" required />
                                <div id="nohpAvailability">
                                    <div id="loading" style="display: none;">
                                        <img src="img/loading.gif" alt="Loading..." width="20" height="20">
                                    </div>
                                    <div id="availabilityMessageNohp" class="mt-2"></div>
                                </div>
                                @error('nohp')
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

@endsection
