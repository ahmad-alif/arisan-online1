{{-- @extends('dashboard.index')

@section('container')
    @include('layouts.navbar')
    @include('layouts.sidebar')

    @include('layouts.footer')
@endsection --}}

@extends('dashboard.index')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Kelola Arisan | Arisanku')
@section('content')

    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-1"><span class="text-muted fw-light">
                    @if (Auth::user()->role == 2)
                        Admin /
                    @elseif (Auth::user()->role == 1)
                        Owner /
                    @endif
                </span> Kelola Arisan</h4>
            <!-- Striped Rows -->

            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card">
                <div class="table-responsive text-nowrap">
                    <table class="table table-striped">
                        <div class="row p-3">
                            <div class="col-sm">
                                <a href="/add-arisan">
                                    <button type="button" class="btn btn-sm btn-primary">
                                        <span class="ti-xs ti ti-plus me-1"></span>Tambah
                                    </button>
                                </a>
                            </div>
                            <div class="col-sm m-2">

                            </div>
                            <div class="col-sm">
                                <div class="d-flex align-items-center justify-content-between app-academy-md-80">
                                    <form action="{{ route('data-arisan.search') }}" method="GET"
                                        class="d-flex align-items-center">
                                        <input type="search" class="form-control me-1" name="search"
                                            value="{{ $search }}" placeholder="Cari...">
                                        <button type="submit" class="btn btn-primary btn-icon"><i
                                                class="ti ti-search"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Gambar Arisan</th>
                                <th scope="col">Nama Arisan</th>
                                <th scope="col">Mulai</th>
                                <th scope="col">Berakhir</th>
                                <th scope="col">Status</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @forelse ($arisans as $arisan)
                                <tr class="align-middle">
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    {{-- <td><img src="{{ Storage::url($arisan->foto_profil) }}" alt="Profile"
                            class="rounded-circle" width="100"></td> --}}
                                    <td>
                                        @if ($arisan->img_arisan)
                                            <div
                                                style="position: relative; display: inline-block; overflow: hidden; border-radius: 50%; width: 40px; height: 40px;">
                                                >
                                                <img style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;"
                                                    class="rounded-circle img-fluid"
                                                    src="{{ Storage::url($arisan->img_arisan) }}"
                                                    alt="{{ $arisan->nama_arisan }}" />
                                            </div>
                                        @else
                                            <img src="{{ asset('img/default_arisan.jpg') }}"
                                                class="object-fit-sm-contain border rounded img-fluid"
                                                style="position: relative; display: inline-block; overflow: hidden; border-radius: 50%; width: 40px; height: 40px;"
                                                alt="Arisan">
                                        @endif
                                    </td>

                                    <td>{{ $arisan->nama_arisan }}</td>
                                    <td>{{ $arisan->start_date }}</td>
                                    <td>{{ $arisan->end_date }}</td>

                                    <td style="align-items: center; justify-content: center;">
                                        @if ($arisan->active == 0)
                                            <button type="button" class="btn btn-label-danger btn-sm"
                                                data-bs-toggle="modal"
                                                data-bs-target="#confirmActivateModal-{{ $arisan->uuid }}">Mati</button>
                                        @elseif ($arisan->active == 1)
                                            {{-- <span class="badge bg-label-success me-1">Aktif</span> --}}
                                            <button type="button" class="btn btn-label-success btn-sm"
                                                data-bs-toggle="modal"
                                                data-bs-target="#confirmDeactivateModal-{{ $arisan->uuid }}">Aktif</button>
                                        @endif
                                    </td>



                                    <td class="">
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                @if ($arisan->status == 1)
                                                    <a class="dropdown-item"
                                                        href="{{ route('start-arisan-owner', ['uuid' => $arisan->uuid]) }}"
                                                        class="btn btn-sm btn-success col-10 mb-1" data-bs-toggle="modal"
                                                        data-bs-target="#confirmStartModal-{{ $arisan->uuid }}">
                                                        <i class="ti ti-player-play me-1"></i> Mulai Arisan</a>
                                                @endif
                                                <a class="dropdown-item"
                                                    href="{{ route('edit-arisan', ['uuid' => $arisan->uuid]) }}"><i
                                                        class="ti ti-pencil me-1"></i> Edit</a>
                                                <button class="button dropdown-item" data-bs-toggle="modal"
                                                    data-bs-target="#confirmDeleteModal-{{ $arisan->uuid }}">
                                                    <i class="ti ti-trash me-1"></i> Hapus
                                                </button>
                                                <a class="dropdown-item"
                                                    href="{{ route('page-arisan', ['uuid' => $arisan->uuid]) }}"><i
                                                        class="ti ti-info-square me-1"></i> Info</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">Tidak ada data yg sama dari
                                        "{{ $search }}".</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <!-- Modal -->
                    @foreach ($arisans as $arisan)
                        <div class="modal fade text-left" id="confirmStartModal-{{ $arisan->uuid }}" tabindex="-1"
                            role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="myModalLabel1">Konfirmasi</h5>
                                    </div>
                                    <div class="modal-body">
                                        <p class="text-wrap text-break">Apakah Anda yakin ingin mulai arisan
                                            <strong>"{{ $arisan->nama_arisan }}"</strong> ?
                                        </p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                            <i class="bx bx-x d-block d-sm-none"></i>
                                            <span>Tidak</span>
                                        </button>
                                        <a href="{{ route('start-arisan-owner', ['uuid' => $arisan->uuid]) }}"
                                            class="btn btn-success ml-1">
                                            <i class="bx bx-check d-block d-sm-none"></i>
                                            <span>Ya, mulai</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @foreach ($arisans as $arisan)
                        @if ($arisan->active == 0)
                            <div class="modal fade" id="confirmActivateModal-{{ $arisan->uuid }}" tabindex="-1"
                                role="dialog" aria-labelledby="confirmActivateModalLabel-{{ $arisan->uuid }}"
                                aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="confirmActivateModalLabel-{{ $arisan->uuid }}">
                                                Konfirmasi Aktivasi</h5>
                                        </div>
                                        <div class="modal-body">
                                            <p class="text-wrap text-break">Apakah Anda yakin ingin mengaktifkan arisan
                                                <strong>"{{ $arisan->nama_arisan }}"</strong>?
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                <i class="bx bx-x d-block d-sm-none"></i>
                                                <span>Tidak</span>
                                            </button>
                                            <form action="{{ route('activate-arisan', ['uuid' => $arisan->uuid]) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-primary ml-1">
                                                    <i class="bx bx-check d-block d-sm-none"></i>
                                                    <span>Ya, Aktifkan</span>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                    @foreach ($arisans as $arisan)
                        @if ($arisan->active == 1)
                            <div class="modal fade" id="confirmDeactivateModal-{{ $arisan->uuid }}" tabindex="-1"
                                role="dialog" aria-labelledby="confirmDeactivateModalLabel-{{ $arisan->uuid }}"
                                aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="confirmDeactivateModalLabel-{{ $arisan->uuid }}">
                                                Konfirmasi Deaktivasi</h5>
                                        </div>
                                        <div class="modal-body">
                                            <p class="text-wrap text-break">Apakah Anda yakin ingin menonaktifkan arisan
                                                <strong>"{{ $arisan->nama_arisan }}"</strong>?
                                            </p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                <i class="bx bx-x d-block d-sm-none"></i>
                                                <span>Tidak</span>
                                            </button>
                                            <form action="{{ route('deactivate-arisan', ['uuid' => $arisan->uuid]) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-danger ml-1">
                                                    <i class="bx bx-check d-block d-sm-none"></i>
                                                    <span>Ya, Nonaktifkan</span>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                    @foreach ($arisans as $arisan)
                        <div class="modal fade" id="arisanInfoModal-{{ $arisan->uuid }}" tabindex="-1" role="dialog"
                            aria-labelledby="arisanInfoModalLabel-{{ $arisan->uuid }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="arisanInfoModalLabel-{{ $arisan->uuid }}">
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
                                                    <img src="{{ asset('img/default_arisan.jpg') }}"
                                                        alt="Default Profile" class="rounded-circle" width="100">
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
                        <!-- Add New Credit Card Modal -->
                        <div class="modal fade" id="confirmDeleteModal-{{ $arisan->uuid }}"
                            aria-labelledby="confirmDeleteModalLabel-{{ $arisan->uuid }}" tabindex="-1"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered1 modal-simple modal-add-new-cc">
                                <div class="modal-content p-3 p-md-5">
                                    <div class="modal-body">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                        <div class="text-center mb-4">
                                            <h1 class="mb-2">🤔</h1>
                                            <h3 class="mb-2">Apakah anda ingin menghapus</h3>
                                            <h2 class="mb-2">
                                                {{ $arisan->nama_arisan }}
                                            </h2>
                                            <p class="text-danger">*Data yang sudah dihapus tidak dapat dikembalikan</p>
                                        </div>
                                        <form id="addNewCCForm" class="row g-3"
                                            action="{{ route('delete-arisan', ['uuid' => $arisan->uuid]) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="col-12 text-center">
                                                <button type="submit" class="btn btn-danger me-sm-3 me-1">Hapus</button>
                                                <button type="reset" class="btn btn-label-secondary btn-reset"
                                                    data-bs-dismiss="modal" aria-label="Close">
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

                    {{-- @foreach ($arisans as $arisan)
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
                    @endforeach --}}

                </div>
                <div class="m-2">
                    <form action="{{ route('export-arisans-excel') }}" method="GET">
                        <button type="submit" class="btn btn-sm btn-success">
                            <span class="ti-xs ti ti-file-spreadsheet me-1"></span>Export Excel
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <!--/ Striped Rows -->

    @endsection
