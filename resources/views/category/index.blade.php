{{-- @extends('dashboard.index')

@section('container')
    @include('layouts.navbar')
    @include('layouts.sidebar')

    @include('layouts.footer')
@endsection --}}

@extends('dashboard.index')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Kelola Kategori')
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
                        <div class="row">
                            <div class="col-sm">
                                <button type="button" class="btn btn-sm btn-primary">
                                    <span class="ti-xs ti ti-plus me-1"></span>Tambah
                                </button>
                            </div>
                            <div class="col-sm">
                            </div>
                            <div class="col-sm">
                                <input type="text" class="form-control" name="search" value=""
                                    placeholder="Cari member...">
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
                                                <a class="dropdown-item" href="javascript:void(0);"><i
                                                        class="ti ti-pencil me-1"></i> Edit</a>
                                                <a class="dropdown-item" href="javascript:void(0);"><i
                                                        class="ti ti-trash me-1"></i> Delete</a>
                                                <a class="dropdown-item" href="javascript:void(0);"><i
                                                        class="ti ti-info-square me-1"></i> Info</a>
                                            </div>
                                        </div>
                                    </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        <!--/ Striped Rows -->

    @endsection
