@extends('dashboard.index')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Tambah Kategori | Arisanku')
@section('content')

    <!-- Striped Rows -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-1"><span class="text-muted fw-light">Admin / Data Kategori / </span>Tambah Kategori</h4>

            <div class="card">
                <!-- Account -->
                <form method="POST" action="{{ route('processAddArisan') }}"
                            enctype="multipart/form-data" novalidate>
                <div class="card-body">
                    {{-- <form id="formAccountSettings" method="POST" enctype="multipart/form-data" action="{{ route('processAccountSetting') }}" novalidate>
                    @csrf --}}
                    <div class="row">
                    @csrf
                        <div class="mb-3 col-md-6">
                            <label for="name" class="form-label">Nama Kategori</label>
                            <input class="form-control @error('nama_kategori') is-invalid @enderror" type="text" id="nama_kategori" name="nama_kategori"
                                placeholder="contoh: Furniture" autofocus required />
                                @error('nama_kategori')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="name" class="form-label">Slug</label>
                            <input class="form-control @error('slug') is-invalid @enderror" type="text" id="slug" name="slug"
                                value="" readonly disabled/>
                                @error('slug')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                        </div>

                    </div>
                    <div class="mt-2">
                        <button type="submit" class="btn btn-primary me-2">Tambah Kategori</button>
                        <a class="btn btn-label-danger" href="/data-category">Batal</a>
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
        document.addEventListener('DOMContentLoaded', function() {
            const namaKategoriInput = document.getElementById('nama_kategori');
            const slugInput = document.getElementById('slug');

            namaKategoriInput.addEventListener('input', function() {
                const namaKategori = this.value.toLowerCase(); // Konversi ke huruf kecil
                const slug = namaKategori.replace(/ /g, '-'); // Ganti spasi dengan tanda dash
                slugInput.value = slug;
            });
        });
    </script>

@endsection
