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
                <form method="POST" action="{{ route('processAddArisan') }}" enctype="multipart/form-data" novalidate>
                    <div class="card-body">
                        <div class="d-flex align-items-start align-items-sm-center gap-4">

                            <img id="preview" src="" alt="Preview"
                                style="max-width: 100px; margin-top: 10px; display: none;">

                            <div class="button-wrapper">
                                <label for="upload" class="btn btn-label-primary me-2 mb-1" tabindex="0">
                                    <span class="d-none d-sm-block">Unggah foto baru</span>
                                    <i class="ti ti-upload d-block d-sm-none"></i>
                                    <input type="file" id="upload" name="img_arisan" class="account-file-input "
                                        hidden accept="image/png, image/jpg, image/jpeg" onchange="previewImage(this);" />
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
                                <input class="form-control @error('nama_arisan') is-invalid @enderror" type="text"
                                    id="nama_arisan" name="nama_arisan" value="" autofocus required />
                                @error('nama_arisan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="owner" class="form-label">Pilih Owner</label>
                                <select class="form-select form-control @error('id_user') is-invalid @enderror"
                                    id="owner" name="id_user" aria-label="Default select example" required>
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
                                <label for="max_member" class="form-label">Maksimal Anggota</label>
                                <input class="form-control @error('max_member') is-invalid @enderror" type="number"
                                    id="max_member" name="max_member" value="{{ old('max_member') }}" autofocus required
                                    placeholder="contoh: 10" />
                                @error('max_member')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="start_date" class="form-label">Tanggal Mulai</label>

                                <input name="start_date" class="form-control @error('start_date') is-invalid @enderror"
                                    type="date" value="{{ old('start_date') }}" id="start_date" required />

                                @error('start_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="deposit_frequency" class="form-label">Jangka Deposit</label>
                                <select class="form-select form-control @error('deposit_frequency') is-invalid @enderror"
                                    id="deposit_frequency" name="deposit_frequency" aria-label="Default select example"
                                    required>
                                    <option disabled selected>Harap pilih jangka deposit</option>
                                    <option value="1">1 minggu</option>
                                    <option value="2">2 minggu</option>
                                    <option value="4">1 bulan</option>
                                </select>
                                @error('deposit_frequency')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi"
                                    value="{{ old('deskripsi') }}" rows="3" required></textarea>
                                @error('deskripsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="payment_amount" class="form-label">Jumlah Deposit</label>
                                <input class="form-control @error('payment_amount') is-invalid @enderror" type="text"
                                    id="payment_amount" name="payment_amount" value="{{ old('payment_amount') }}" autofocus
                                    required placeholder="contoh: 100000" />
                                @error('payment_amount')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="nama_bank" class="form-label">Nama Bank</label>
                                <select class="form-select @error('nama_bank') is-invalid @enderror" id="nama_bank"
                                    name="nama_bank" required>
                                    <option disabled selected>Pilih Bank</option>
                                    <option value="BRI">Bank Rakyat Indonesia (BRI)</option>
                                    <option value="BCA">Bank Central Asia (BCA)</option>
                                    <option value="BNI">Bank Negara Indonesia (BNI)</option>
                                </select>
                                @error('nama_bank')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="no_rekening" class="form-label">Nomor Rekening</label>
                                <input class="form-control @error('no_rekening') is-invalid @enderror" type="text"
                                    id="no_rekening" name="no_rekening" value="{{ old('no_rekening') }}" required
                                    placeholder="contoh: 1234 5678 9012 3456" />
                                @error('no_rekening')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="nama_pemilik_rekening" class="form-label">Nama Pemilik Rekening</label>
                                <input class="form-control @error('nama_pemilik_rekening') is-invalid @enderror"
                                    type="text" id="nama_pemilik_rekening" name="nama_pemilik_rekening"
                                    value="{{ old('nama_pemilik_rekening') }}" required
                                    placeholder="contoh: Budi Setiawan" />
                                @error('nama_pemilik_rekening')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="fee_admin" class="form-label">Biaya Admin</label>
                                <input class="form-control @error('fee_admin') is-invalid @enderror" type="text"
                                    id="fee_admin" name="fee_admin" value="{{ old('fee_admin') }}" required />
                                @error('fee_admin')
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
