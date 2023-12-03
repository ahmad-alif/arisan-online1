@extends('dashboard.index')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Kelola Owner | Arisanku')
@section('content')

    <!-- Striped Rows -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-1"><span class="text-muted fw-light">Admin /</span> Kelola Owner</h4>

            <div class="card">
                <div class="table-responsive text-nowrap">
                    <table class="table table-striped">
                        <div class="row p-3">
                            <div class="col-sm"><a href="/add-owner">
                                    <button type="button" class="btn btn-sm btn-primary">
                                        <span class="ti-xs ti ti-user-plus me-1"></span>Tambah
                                    </button></a>
                            </div>
                            <div class="col-sm m-2">

                            </div>
                            <div class="col-sm">
                                <div class="d-flex align-items-center justify-content-between app-academy-md-80">
                                    <input type="search" class="form-control me-1" name="search"
                                        value="{{ request('search') }}" placeholder="Cari owner...">
                                    <button type="submit" class="btn btn-primary btn-icon"><i
                                            class="ti ti-search"></i></button>
                                </div>
                            </div>
                        </div>
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col" style="text-align: center; vertical-align: middle;">Foto Profil</th>
                                <th scope="col">Username</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Email</th>
                                <th scope="col">No HP</th>
                                <th scope="col">Status</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($owners as $owner)
                                <tr class="align-middle">
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td style="display: flex; justify-content: center;">
                                        <div class="ti ti-lg text-danger me-3">
                                            @if ($owner->foto_profil)
                                                <img src="{{ Storage::url($owner->foto_profil) }}" alt="Profile"
                                                    class="rounded-circle" width="35" />
                                            @else
                                                <i class="ti ti-user-circle ti-lg text-info"></i>
                                                {{-- <img src="{{ asset('img/default.png') }}" alt="Default Profile"
                                class="rounded-circle" width="100"> --}}
                                            @endif
                                        </div>
                                    </td>
                                    <td>{{ $owner->username }}</td>
                                    <td>{{ $owner->name }}</td>
                                    <td>{{ $owner->email }}</td>
                                    <td>{{ $owner->nohp }}</td>
                                    <td style="align-items: center; justify-content: center;">
                                        @if ($owner->active == 0)
                                            <button type="button" class="btn btn-label-danger btn-sm"
                                                data-bs-toggle="modal" data-bs-target="#confirmActivateModal">Mati</button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="confirmActivateModal" tabindex="-1" role="dialog"
                                                aria-labelledby="confirmActivateModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="confirmActivateModalLabel">
                                                                Konfirmasi Aktivasi Akun</h5>

                                                        </div>
                                                        <div class="modal-body">
                                                            <p>Apakah Anda yakin ingin mengaktifkan akun
                                                                <strong>
                                                                    {{ $owner->name }}?
                                                                </strong>
                                                            </p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Batal</button>
                                                            <form
                                                                action="{{ route('activate-account-owner', ['id' => $owner->id]) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <button type="submit" class="btn btn-success">Ya,
                                                                    Aktifkan</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @elseif ($owner->active == 1)
                                            <span class="badge bg-label-success me-1">Aktif</span>
                                        @endif
                                    </td>

                                    <td>
                                        <div class="dropdown mr-4">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item"
                                                    href="{{ route('edit-owner', ['id' => $owner->id]) }}"><i
                                                        class="ti ti-pencil me-1"></i> Ubah</a>

                                                <button class="button dropdown-item" href="" data-bs-toggle="modal"
                                                    data-bs-target="#confirmDeleteModal-{{ $owner->id }}">
                                                    <i class="ti ti-trash me-1"></i> Hapus
                                                </button>

                                                <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                    data-bs-target="#ownerInfoModal-{{ $owner->id }}">
                                                    <i class="ti ti-info-square me-1"></i> Info
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            @foreach ($owners as $owner)
                                <div class="modal fade" id="ownerInfoModal-{{ $owner->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="ownerInfoModalLabel-{{ $owner->id }}"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-simple modal-add-new-cc">
                                        <div class="modal-content p-3 p-md-5">
                                            <div class="modal-body">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                                <div class="text-center mb-4">
                                                    <h2 class="mb-2">{{ $owner->username }}</h2>
                                                </div>
                                                <div class="row g-3">
                                                    <div class="col-12 text-center">
                                                        @if ($owner->foto_profil)
                                                            <img src="{{ Storage::url($owner->foto_profil) }}"
                                                                alt="Foto Profil" class="rounded-circle" width="100">
                                                        @else
                                                            <img src="{{ asset('img/default.png') }}"
                                                                alt="Default Profile" class="rounded-circle"
                                                                width="100">
                                                        @endif
                                                    </div>
                                                    <div class="col-12">
                                                        <label class="form-label">Nama: </label>
                                                        <p>{{ $owner->name }}</p>
                                                    </div>
                                                    <div class="col-12">
                                                        <label class="form-label">Email: </label>
                                                        <p>{{ $owner->email }}</p>
                                                    </div>
                                                    <div class="col-12">
                                                        <label class="form-label">No HP: </label>
                                                        <p>{{ $owner->nohp }}</p>
                                                    </div>
                                                    <div class="col-12">
                                                        <label class="form-label">Arisans:</label>
                                                        @if ($owner->arisans_owner->isEmpty())
                                                            <p>Tidak ada arisan.</p>
                                                        @else
                                                            <div class="row">
                                                                @foreach ($owner->arisans_owner as $arisan)
                                                                    <div class="col-md-4 mb-3">
                                                                        <div class="card">
                                                                            {{-- <img src="{{ Storage::url($arisan->img_arisan) }}"
                                                                                class="card-img-top" alt="Arisan Image"> --}}
                                                                            <div
                                                                                style="position: relative; width: 100%; padding-bottom: 100%;">
                                                                                <img style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;"
                                                                                    class="border rounded img-fluid"
                                                                                    src="{{ Storage::url($arisan->img_arisan) }}"
                                                                                    alt="{{ $arisan->nama_arisan }}" />
                                                                            </div>
                                                                            <div class="card-body">
                                                                                <h5 class="card-title"
                                                                                    style="font-size: 14px;">
                                                                                    {{ Str::limit($arisan->nama_arisan, 10, '...') }}
                                                                                </h5>
                                                                                <p class="card-text"
                                                                                    style="font-size: 12px;">
                                                                                    {{ Str::limit($arisan->deskripsi, 12, '...') }}
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            @foreach ($owners as $owner)
                                <!-- Add New Credit Card Modal -->
                                <div class="modal fade" id="confirmDeleteModal-{{ $owner->id }}"
                                    aria-labelledby="confirmDeleteModalLabel-{{ $owner->id }}" tabindex="-1"
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
                                                        {{ $owner->username }}
                                                    </h2>
                                                    <p class="text-danger">*Data yang sudah dihapus tidak dapat
                                                        dikembalikan
                                                    </p>
                                                </div>
                                                <form id="addNewCCForm" class="row g-3"
                                                    action="{{ route('delete-owner', ['id' => $owner->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="col-12 text-center">
                                                        <button type="submit"
                                                            class="btn btn-danger me-sm-3 me-1">Hapus</button>
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

                        </tbody>

                    </table>
                </div>
                <div class="col-sm m-2">
                    <form action="{{ route('export-owners-excel') }}" method="GET">
                        <button type="submit" class="btn btn-sm btn-success">
                            <span class="ti-xs ti ti-file-spreadsheet me-1"></span>Export Excel
                        </button>
                    </form>
                </div>
            </div>
            <!--/ Striped Rows -->

        </div>
        <!--/ Responsive Table -->
    </div>
    <!-- / Content -->

@endsection
