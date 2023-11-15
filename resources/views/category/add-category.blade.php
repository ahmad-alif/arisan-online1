@extends('layouts.app')

@section('container')
    @include('layouts.navbar')
    @include('layouts.sidebar')
    <main id="main" class="main">

        <div class="pagetitle border-bottom pb-3">
            <h1>Tambah Kategori</h1>
        </div><!-- End Page Title -->

        <div class="card">
            <div class="card-body pt-3">

                <!-- General Form Elements -->
                <form method="post" enctype="multipart/form-data" action="{{ route('processAddCategory') }}" novalidate>
                    <div class="row mb-3">
                        <div class="col-sm-12">
                            <a href="/data-category" class="btn btn-outline-danger">
                                <i class="bi bi-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>
                    @csrf
                    <div class="row mb-3">
                        <label for="name" class="col-sm-2 col-form-label">Nama Kategori</label>
                        <div class="col-sm-10">
                            <input type="text" name="nama_kategori"
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
                            <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror"
                                id="slug" required disable readonly>
                            @error('slug')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-sm-12 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Tambahkan</button>
                        </div>
                    </div>
                </form><!-- End General Form Elements -->

            </div>
        </div>

    </main>
    @include('layouts.footer')

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


    </html>
