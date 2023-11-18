@extends('dashboard.index')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Tambah Arisan | Arisanku')
@section('content')

    <!-- Striped Rows -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-1"><span class="text-muted fw-light">Admin / Data Arisan / </span>Tambah Arisan</h4>

            <div class="card">
                <!-- Account -->
                <form method="POST" action="{{ route('processAddArisan') }}"
                            enctype="multipart/form-data" novalidate>
                <div class="card-body">
                    <div class="d-flex align-items-start align-items-sm-center gap-4">

                            <img id="preview" src="" alt="Preview"
                            style="max-width: 100px; margin-top: 10px; display: none;">

                            <div class="button-wrapper">
                                <label for="upload" class="btn btn-label-primary me-2 mb-1" tabindex="0">
                                    <span class="d-none d-sm-block">Unggah foto baru</span>
                                    <i class="ti ti-upload d-block d-sm-none"></i>
                                    <input type="file" id="upload" name="img_arisan" class="account-file-input "
                                        hidden accept="image/png, image/jpg, image/jpeg" onchange="previewImage(this);"/>
                                </label>
                                @error('img_arisan')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
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
                    @csrf
                        <div class="mb-3 col-md-6">
                            <label for="name" class="form-label">Nama Arisan</label>
                            <input class="form-control @error('nama_arisan') is-invalid @enderror" type="text" id="nama_arisan" name="nama_arisan"
                                value="" autofocus required />
                                @error('nama_arisan')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="owner" class="form-label">Pilih Owner</label>
                            <select class="form-select form-control @error('id_user') is-invalid @enderror" id="owner" name="id_user" aria-label="Default select example" required>
                                <option disabled selected>Harap pilih owner</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                            @error('id_user')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="start_date" class="form-label">Tanggal Mulai</label>

                                <input name="start_date" class="form-control @error('start_date') is-invalid @enderror" type="date" value=" {{ now()->format('d-m-Y') }}" id="start_date" required/>

                            @error('start_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="end_date" class="form-label">Tanggal Selesai</label>

                                <input name="end_date" class="form-control @error('end_date') is-invalid @enderror" type="date" value=" {{ now()->format('d-m-Y') }}" id="end_date" required/>

                            @error('end_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="mt-2">
                        <button type="submit" class="btn btn-primary me-2">Tambah Arisan</button>
                        <a class="btn btn-label-danger" href="/data-arisan">Batal</a>
                    </div>

                </div>
            </form>
            </div>
            <!--/ Striped Rows -->

        </div>
        <!--/ Responsive Table -->
    </div>
    <!-- / Content -->
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
