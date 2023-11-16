@extends('dashboard.index')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Ubah Owner | Arisanku')
@section('content')

    <!-- Striped Rows -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-1"><span class="text-muted fw-light">Admin / Ubah Pemilik / </span>{{ $owner->name }}</h4>

            <div class="card">
                <!-- Account -->
                <div class="card-body">
                    <div class="d-flex align-items-start align-items-sm-center gap-4">
                        @if ($owner->foto_profil)
                            <img src="{{ Storage::url($owner->foto_profil) }}" alt="Profile"
                                class="d-block w-px-100 h-px-100 rounded" id="uploadedAvatar" />
                        @else
                            <img src="{{ asset('img/default.png') }}" alt="DefualtProfile"
                                class="d-block w-px-100 h-px-100 rounded" id="uploadedAvatar" />
                        @endif

                        <form method="POST" action="{{ route('processEditOwner', ['id' => $owner->id]) }}"
                            enctype="multipart/form-data" novalidate>
                            @csrf
                            <div class="button-wrapper">
                                <label for="upload" class="btn btn-label-primary me-2 mb-1" tabindex="0">
                                    <span class="d-none d-sm-block">Unggah foto baru</span>
                                    <i class="ti ti-upload d-block d-sm-none"></i>
                                    <input type="file" id="formFile" name="foto_profil" class="account-file-input"
                                        hidden accept="image/png, image/jpg, image/jpeg" />
                                </label>

                                <div class="text-muted">Format yang didukung JPG, GIF atau PNG. Ukuran Max 800kb</div>
                            </div>
                            {{-- </form> --}}
                    </div>
                </div>
                <hr class="my-0" />
                <div class="card-body">
                    {{-- <form id="formAccountSettings" method="POST" enctype="multipart/form-data" action="{{ route('processAccountSetting') }}" novalidate>
                    @csrf --}}
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="inputText" class="form-label">Nama</label>
                            <input class="form-control @error('name') is-invalid @enderror" type="text" id="name" name="name"
                                value="{{ $owner->name }}" autofocus required />
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="inputUsername" class="form-label">Username</label>
                            <input class="form-control @error('username') is-invalid @enderror" type="text" name="username" id="username"
                                value="{{ $owner->username }}" required />
                                @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="inputEmail" class="form-label">E-mail</label>
                            <input class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                                value="{{ $owner->email }}" required />
                                @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="organization" class="form-label">No. Telpon</label>
                            <input type="number" class="form-control @error('nohp') is-invalid @enderror" id="nohp" name="nohp"
                                value="{{ $owner->nohp }}" required />
                                @error('nohp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="organization" class="form-label">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password"
                                 required/>
                                @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="text-danger">Isi password apabila ingin mengubah
                                password,
                                Apabila tidak kosongkan
                                saja!</div>
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
