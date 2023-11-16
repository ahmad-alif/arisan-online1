@extends('dashboard.index')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Ubah Kategori arisan | Arisanku')
@section('content')

    <!-- Striped Rows -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-1"><span class="text-muted fw-light">Admin / Ubah Pemilik / </span>{{ $category->nama_kategori }}</h4>

            <div class="card">
                <!-- Account -->
                <div class="card-body">
                    <form id="editCategoryForm" method="POST" enctype="multipart/form-data" action="{{ route('processEditCategory', ['id' => $category->id]) }}" novalidate>
                    @csrf
                    @method('PUT') {{-- Menggunakan metode PUT untuk proses edit --}}
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="inputText" class="form-label">Nama Kategori</label>
                            <input class="form-control @error('nama_kategori') is-invalid @enderror" type="text" id="nama_kategori" name="nama_kategori"
                                value="{{ $category->nama_kategori }}" autofocus required />
                                @error('nama_kategori')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="inputText" class="form-label">Slug</label>
                            <input class="form-control @error('slug') is-invalid @enderror" type="text" id="slug" name="slug"
                                value="{{ $category->slug }}" autofocus required />
                                @error('slug')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                        </div>

                    </div>
                    <div class="mt-2">
                        <button type="submit" class="btn btn-primary me-2">Simpan perubahan</button>
                        <a class="btn btn-label-danger" href="/data-category">Batal</a>
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
