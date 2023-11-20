@extends('dashboard.index')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Edit Arisan | Arisanku')
@section('content')

    <!-- Striped Rows -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-1"><span class="text-muted fw-light">Owner / Kelola Arisan / </span>Edit Arisan</h4>

            <div class="card">
                <!-- Account -->
                <form method="POST" action="{{ route('processEditArisan', ['id' => $arisan->id_arisan]) }}"
                    enctype="multipart/form-data" novalidate>
                    @csrf
                    <div class="card-body">
                        <div class="d-flex align-items-start align-items-sm-center gap-4">

                            <img id="preview" src="{{ $arisan->img_arisan ? Storage::url($arisan->img_arisan) : '' }}"
                                alt="Preview" style="max-width: 100px; margin-top: 10px; display: block;">

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
                        </div>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="nama_arisan" class="form-label">Nama Arisan</label>
                                <input class="form-control @error('nama_arisan') is-invalid @enderror" type="text"
                                    id="nama_arisan" name="nama_arisan" value="{{ $arisan->nama_arisan }}" autofocus
                                    required placeholder="contoh: Arisan Mobil Semanggi" />
                                @error('nama_arisan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="id_user" class="form-label">ID User (Owner)</label>
                                <input class="form-control" type="text" id="id_user" name="id_user"
                                    value="{{ $arisan->user->name }}" readonly>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="max_member" class="form-label">Maksimal Anggota</label>
                                <input class="form-control @error('max_member') is-invalid @enderror" type="number"
                                    id="max_member" name="max_member" value="{{ $arisan->max_member }}" autofocus required
                                    placeholder="contoh: 10" />
                                @error('max_member')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="start_date" class="form-label">Tanggal Mulai</label>
                                <input name="start_date" class="form-control @error('start_date') is-invalid @enderror"
                                    type="date" value="{{ $arisan->start_date }}" id="start_date" required />
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
                                    <option value="1" {{ $arisan->deposit_frequency == 1 ? 'selected' : '' }}>1 minggu
                                    </option>
                                    <option value="2" {{ $arisan->deposit_frequency == 2 ? 'selected' : '' }}>2 minggu
                                    </option>
                                    <option value="4" {{ $arisan->deposit_frequency == 4 ? 'selected' : '' }}>1 bulan
                                    </option>
                                </select>
                                @error('deposit_frequency')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="3"
                                    required>{{ $arisan->deskripsi }}</textarea>
                                @error('deskripsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="payment_amount" class="form-label">Jumlah Deposit</label>
                                <input class="form-control @error('payment_amount') is-invalid @enderror" type="text"
                                    id="payment_amount" name="payment_amount" value="{{ $arisan->payment_amount }}"
                                    autofocus required placeholder="contoh: 100000" />
                                @error('payment_amount')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary me-2">Simpan Perubahan</button>
                            <a class="btn btn-label-danger" href="/manage-arisan">Batal</a>
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

    <!-- ... Other scripts ... -->

@endsection
