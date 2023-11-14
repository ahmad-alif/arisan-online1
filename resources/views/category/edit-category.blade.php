@extends('layouts.app')

@section('container')
    @include('layouts.navbar')
    @include('layouts.sidebar')
    <main id="main" class="main">

        <div class="pagetitle border-bottom pb-3">
            <h1>Edit Kategori</h1>
        </div><!-- End Page Title -->

        <div class="card mb-5">
            <div class="card-body pt-3">

                <!-- General Form Elements -->
                <form method="post" action="{{ route('processEditCategory', ['id' => $category->id]) }}" novalidate
                    enctype="multipart/form-data" id="editCategoryForm">
                    @csrf
                    @method('PUT') {{-- Menggunakan metode PUT untuk proses edit --}}

                    <div class="row mb-3">
                        <div class="col-sm-12">
                            <a href="/data-category" class="btn btn-outline-danger">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Nama Kategori</label>
                        <div class="col-sm-10">
                            <input type="text" name="nama_kategori" value="{{ $category->nama_kategori }}"
                                class="form-control @error('nama_kategori') is-invalid @enderror" id="nama_kategori"
                                required>
                            @error('nama_kategori')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="name" class="col-sm-2 col-form-label">Slug</label>
                        <div class="col-sm-10">
                            <input type="text" name="slug" value="{{ $category->slug }}" class="form-control"
                                @error('slug') is-invalid @enderror" id="slug" required disable readonly>
                            @error('slug')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Tambahkan field lainnya sesuai dengan atribut yang sesuai dengan model Kategori --}}

                    <div class="row mb-3">
                        <div class="col-sm-12 d-flex justify-content-end">
                            <button type="button" class="btn btn-primary mr-2" data-bs-toggle="modal"
                                data-bs-target="#confirmationModal">
                                <i class="bi bi-pencil-fill"></i> Edit
                            </button>
                        </div>
                    </div>
                </form><!-- End General Form Elements -->

            </div>
        </div>
        <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog"
            aria-labelledby="confirmationModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmationModalLabel">Konfirmasi Edit</h5>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin mengedit data ini?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                        <button type="submit" form="editCategoryForm" class="btn btn-primary">Ya</button>
                    </div>
                </div>
            </div>
        </div>
    </main>
    @include('layouts.footer')
    </div>
@endsection

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
