{{-- @extends('dashboard.index')

@section('container')
    @include('layouts.navbar')
    @include('layouts.sidebar')

    @include('layouts.footer')
@endsection --}}

@extends('dashboard.index')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Kelola Kategori | Arisanku')
@section('content')

    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-1"><span class="text-muted fw-light">Admin / Arisan /</span> Kelola Kategori</h4>
            <!-- Striped Rows -->
            <div class="card">
                <div class="table-responsive text-nowrap">
                    {{-- <div class="d-flex justify-content-between align-items-center ms-3 ">
            <div class="col-1">
                <button type="button" class="btn btn-sm btn-primary">
                    <span class="ti-xs ti ti-plus me-1"></span>Tambah
                </button>
            </div>
            <div class="col-1">
                <!-- Area tengah kosong -->
            </div>
            <div class="">
                <form action="/manage-member" method="GET">
                    <div class="input-group input-group-merge card-body">
                        <input type="text" class="form-control" name="search"
                            value="{{ request('search') }}" placeholder="Cari member...">
                    </div>
                </form>
            </div>
        </div> --}}
                    <table class="table table-striped">
                        <div class="row p-3">
                            <div class="col-sm">
                                <button type="button" class="btn btn-sm btn-primary">
                                    <span class="ti-xs ti ti-plus me-1"></span>Tambah
                                </button>
                            </div>
                            <div class="col-sm">

                            </div>
                            <div class="col-sm">
                                <div class="d-flex align-items-center justify-content-between app-academy-md-80">
                                    <input type="search" class="form-control me-1" name="search"
                                    value="{{ request('search') }}" placeholder="Cari kategori...">
                                    <button type="submit" class="btn btn-primary btn-icon"><i class="ti ti-search"></i></button>
                                </div>
                            </div>
                        </div>
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama Kategori</th>
                                <th scope="col">Slug</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            <tr class="align-middle">
                                @foreach ($categories as $category)
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $category->nama_kategori }}</td>
                                    <td>{{ $category->slug }}</td>
                                    <td>{{ $category->created_at }}</td>

                                    <td class="">
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ route('edit-category', ['id' => $category->id]) }}"><i
                                                        class="ti ti-pencil me-1"></i> Ubah</a>
                                                    <button class="button dropdown-item" href=""
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#confirmDeleteModal-{{ $category->id }}">
                                                    <i class="ti ti-trash me-1"></i> Hapus
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                            </tr>
                            @endforeach
                            @foreach ($categories as $category)

            <!-- Add New Credit Card Modal -->
              <div class="modal fade" id="confirmDeleteModal-{{ $category->id }}"
                aria-labelledby="confirmDeleteModalLabel-{{ $category->id }}"
                tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered1 modal-simple modal-add-new-cc">
                  <div class="modal-content p-3 p-md-5">
                    <div class="modal-body">
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      <div class="text-center mb-4">
                        <h1 class="mb-2">🤔</h1>
                        <h3 class="mb-2">Apakah anda ingin menghapus</h3>
                        <h2 class="mb-2">
                            {{ $category->nama_kategori }}
                        </h2>
                        <p class="text-danger">*Data yang sudah dihapus tidak dapat dikembalikan</p>
                      </div>
                      <form id="addNewCCForm" class="row g-3" action="{{ route('delete-category', ['id' => $category->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="col-12 text-center">
                          <button type="submit" class="btn btn-danger me-sm-3 me-1">Hapus</button>
                          <button
                            type="reset"
                            class="btn btn-label-secondary btn-reset"
                            data-bs-dismiss="modal"
                            aria-label="Close">
                            Batal
                          </button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <!--/ Add New Credit Card Modal -->
            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        <!--/ Striped Rows -->

    @endsection
