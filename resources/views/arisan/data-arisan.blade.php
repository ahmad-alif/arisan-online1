{{-- @extends('dashboard.index')

@section('container')
    @include('layouts.navbar')
    @include('layouts.sidebar')

    @include('layouts.footer')
@endsection --}}

@extends('dashboard.index')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Kelola Arisan')
@section('content')

    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-1"><span class="text-muted fw-light">
                @if (Auth::user()->role == 2)
                / Admin /
                @elseif (Auth::user()->role == 1)
                / Owner /
                @elseif (Auth::user()->role == 0)
                / Pengguna /
                @endif</span> Kelola Arisan</h4>
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
                                <th scope="col">Gambar Arisan</th>
                                <th scope="col">Nama Arisan</th>
                                <th scope="col">Mulai</th>
                                <th scope="col">Berakhir</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($arisans as $arisan)
                                <tr class="align-middle">
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    {{-- <td><img src="{{ Storage::url($arisan->foto_profil) }}" alt="Profile"
                            class="rounded-circle" width="100"></td> --}}
                                    <td>
                                        @if ($arisan->img_arisan)
                                            <img src="{{ Storage::url($arisan->img_arisan) }}" alt="Arisan"
                                                class="rounded-circle" width="35">
                                        @else
                                            <img src="{{ asset('img/default_arisan.jpg') }}" alt="Default Profile"
                                                class="rounded-circle" width="35">
                                        @endif
                                    </td>

                                    <td>{{ $arisan->nama_arisan }}</td>
                                    <td>{{ $arisan->start_date }}</td>
                                    <td>{{ $arisan->end_date }}</td>

                                    {{-- <td>{{ $arisan->active }}</td> --}}



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
                    <!-- Modal -->
                    @foreach ($arisans as $arisan)
                        <div class="modal fade" id="arisanInfoModal-{{ $arisan->id_arisan }}" tabindex="-1" role="dialog"
                            aria-labelledby="arisanInfoModalLabel-{{ $arisan->id_arisan }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="arisanInfoModalLabel-{{ $arisan->id_arisan }}">
                                            Informasi arisan</h5>

                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <p><strong>Nama Arisan:</strong> {{ $arisan->nama_arisan }}</p>
                                                <p><strong>Mulai:</strong> {{ $arisan->start_date }}</p>
                                                <p><strong>Berakhir:</strong> {{ $arisan->end_date }}</p>
                                                <p><strong>Gambar Arisan:</strong></p>
                                                {{-- <img src="{{ Storage::url($arisan->foto_ktp) }}" alt="KTP"
                                      width="250"> --}}
                                                @if ($arisan->img_arisan == null)
                                                    <img src="{{ asset('img/default_arisan.jpg') }}" alt="Default Profile"
                                                        class="rounded-circle" width="100">
                                                @elseif ($arisan->img_arisan)
                                                    <img src="{{ Storage::url($arisan->img_arisan) }}" alt="Arisan"
                                                        class="rounded-circle" width="100">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @foreach ($arisans as $arisan)
                        <!-- Modal Konfirmasi Delete -->
                        <div class="modal fade" id="confirmDeleteModal-{{ $arisan->id_arisan }}" tabindex="-1"
                            role="dialog" aria-labelledby="confirmDeleteModalLabel-{{ $arisan->id_arisan }}"
                            aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="confirmDeleteModalLabel-{{ $arisan->id_arisan }}">
                                            Konfirmasi
                                            Hapus</h5>
                                    </div>
                                    <div class="modal-body">
                                        Apakah Anda yakin ingin menghapus arisan ini?
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{ route('delete-arisan', ['id' => $arisan->id_arisan]) }}"
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
            </div>
        </div>
        <!--/ Striped Rows -->

    @endsection
