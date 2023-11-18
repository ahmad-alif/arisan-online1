@extends('dashboard.index')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Tambah Arisan | Arisanku')
@section('content')

    <!-- Striped Rows -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-1"><span class="text-muted fw-light">Owner / Kelola Arisan / </span>Tambah Arisan</h4>

            <div class="card">
                <!-- Account -->
                <form method="POST" action="{{ route('processAddArisanOwner') }}"
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
                            <label for="nama_arisan" class="form-label">Nama Arisan</label>
                            <input class="form-control @error('nama_arisan') is-invalid @enderror" type="text" id="nama_arisan" name="nama_arisan"
                                value="" autofocus required placeholder="contoh: Arisan Mobil Semanggi"/>
                                @error('nama_arisan')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="max_member" class="form-label">Maksimal Anggota</label>
                            <input class="form-control @error('max_member') is-invalid @enderror" type="number" id="max_member" name="max_member"
                                value="" autofocus required placeholder="contoh: 10"/>
                                @error('max_member')
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
                            <label for="deposit_frequency" class="form-label">Jangka Deposit</label>
                            <select class="form-select form-control @error('deposit_frequency') is-invalid @enderror" id="deposit_frequency" name="deposit_frequency" aria-label="Default select example" required>
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
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="3"></textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="payment_amount" class="form-label">Jumlah Deposit</label>
                            <input class="form-control @error('payment_amount') is-invalid @enderror" type="text" id="payment_amount" name="payment_amount"
                                value="" autofocus required placeholder="contoh: Rp. 100.000"/>
                                @error('payment_amount')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                        </div>
                    </div>
                    <div class="mt-2">
                        <button type="submit" class="btn btn-primary me-2">Tambah Arisan</button>
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
    <script>
        // Fungsi untuk mengonversi angka menjadi format mata uang Rupiah
        function formatRupiah(angka) {
            var reverse = angka.toString().split('').reverse().join(''),
                ribuan = reverse.match(/\d{1,3}/g);
            ribuan = ribuan.join('.').split('').reverse().join('');
            return 'Rp. ' + ribuan;
        }

        // Fungsi untuk memformat input setiap kali ada perubahan
        function updateRupiah() {
            var input = document.getElementById('payment_amount');
            var value = input.value.replace(/\D/g, ''); // Menghapus karakter non-digit
            input.value = formatRupiah(value);
        }

        // Menambahkan event listener untuk memanggil fungsi setiap kali ada perubahan pada input
        document.getElementById('payment_amount').addEventListener('input', updateRupiah);
    </script>
@endsection
