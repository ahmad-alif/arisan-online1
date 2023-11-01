@extends('layouts.app')

@section('container')
    @include('layouts.navbar')
    @include('layouts.sidebar')
    <main id="main" class="main">

        <div class="pagetitle border-bottom pb-3">
            <h1>Data Category</h1>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body pt-3">

                            <!-- Table with stripped rows -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="col-4">
                                    <a href="/add-category" class="btn btn-primary"><i class="bi bi-plus"></i> Add
                                        Category</a>
                                </div>
                                <div class="col-4 text-center">
                                    <!-- Middle area is empty -->
                                </div>
                                <form action="{{ route('search-category') }}" method="GET">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="search"
                                            value="{{ $search }}" placeholder="Search Category...">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-primary" type="submit">
                                                <i class="bi bi-search"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="table-responsive">
                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nama Kategori</th>
                                            <th scope="col">Slug</th>
                                            <th scope="col">Created At</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $category)
                                            <tr class="align-middle">
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td>{{ $category->nama_kategori }}</td>
                                                <td>{{ $category->slug }}</td>
                                                <td>{{ $category->created_at }}</td>
                                                <td>
                                                    <a href="{{ route('edit-category', ['id' => $category->id]) }}"
                                                        class="btn btn-sm btn-primary col-10 mb-1">
                                                        <i class="bi bi-pencil-fill"></i> Edit
                                                    </a>
                                                    {{-- <form action="{{ route('delete-category', ['id' => $category->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger col-10 mb-1">
                                                            <i class="bi bi-trash-fill"></i> Delete
                                                        </button>
                                                    </form> --}}
                                                    <form action="{{ route('delete-category', ['id' => $category->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-sm btn-danger col-10 mb-1"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#confirmDeleteCategoryModal-{{ $category->id }}">
                                                            <i class="bi bi-trash-fill">Delete</i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @foreach ($categories as $category)
                                    <!-- Modal Konfirmasi Delete -->
                                    <div class="modal fade" id="confirmDeleteCategoryModal-{{ $category->id }}"
                                        tabindex="-1" role="dialog"
                                        aria-labelledby="confirmDeleteCategoryModalLabel-{{ $category->id }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"
                                                        id="confirmDeleteCategoryModalLabel-{{ $category->id }}">Konfirmasi
                                                        Hapus Kategori</h5>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah Anda yakin ingin menghapus kategori ini?
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="{{ route('delete-category', ['id' => $category->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Tidak</button>
                                                        <button type="submit" class="btn btn-danger">Ya</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                            <!-- End Table with stripped rows -->
                            <div class="d-flex justify-content-center">
                                {{-- Pagination links here --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    @include('layouts.footer')
@endsection
