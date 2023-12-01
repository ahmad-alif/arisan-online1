@extends('dashboard.index')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Kelola Member')
@section('content')

    <!-- Striped Rows -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-1"><span class="text-muted fw-light">Admin /</span> Kelola Pengguna</h4>

            <div class="card">
                <div class="table-responsive text-nowrap">

                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (session()->has('loginError'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('loginError') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <table class="table table-striped">
                        <div class="row p-3">
                            <div class="col-sm">
                                <a href="/add-member">
                                    <button type="button" class="btn btn-sm btn-primary">
                                        <span class="ti-xs ti ti-user-plus me-1"></span>Tambah
                                    </button>
                                </a>
                            </div>
                            <div class="col-sm m-2">

                            </div>
                            <div class="col-sm">
                                <div class="d-flex align-items-center justify-content-between app-academy-md-80">
                                    <input type="search" class="form-control me-2" name="search"
                                        value="{{ request('search') }}" placeholder="Cari member...">
                                    <button type="submit" class="btn btn-primary btn-icon"><i
                                            class="ti ti-search"></i></button>
                                </div>
                            </div>
                        </div>
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Foto Profil</th>
                                <th scope="col">Username</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">No HP</th>
                                @if (Auth::user()->role == 2)
                                    <th scope="col">Status</th>
                                @endif
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($members as $member)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td style="display: flex; justify-content: center;">
                                        <div class="ti ti-lg text-danger me-5 ">
                                        @if ($member->foto_profil)
                                            <img src="{{ Storage::url($member->foto_profil) }}" alt="Profile"
                                                class="rounded-circle" width="35" height="35">
                                        @else
                                            <i class="ti ti-user-circle ti-lg text-info"></i>
                                        @endif
                                        </div>
                                    </td>
                                    <td>{{ $member->username }}</td>
                                    <td>{{ $member->name }}</td>
                                    <td>{{ $member->email }}</td>
                                    <td>{{ $member->nohp }}</td>
                                    @if (Auth::user()->role == 2)
                                        <td>
                                            @if ($member->active == 0)
                                                <button type="button" class="btn btn-label-danger btn-sm"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#confirmActivateModal-{{ $member->id }}">Mati</button>

                                                <div class="modal fade" id="confirmActivateModal-{{ $member->id }}"
                                                    tabindex="-1" role="dialog"
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
                                                                        {{ $member->name }}?
                                                                    </strong>
                                                                </p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Batal</button>
                                                                <form
                                                                    action="{{ route('activate-account', ['id' => $member->id]) }}"
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
                                            @elseif ($member->active == 1)
                                                <span class="badge bg-label-success me-1">Aktif</span>
                                            @endif
                                        </td>
                                    @endif
                                    <td class="me-3">
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </button>

                                            <div class="dropdown-menu">
                                                @if (Auth::user()->role == 2)
                                                    @if ($member->active == 0)
                                                        <button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                            data-bs-target="#confirmActivateModal-{{ $member->id }}"><i
                                                                class="ti ti-circle-check me-1"></i> Aktivasi</a></button>
                                                    @elseif ($member->active == 1)
                                                        <a class="dropdown-item disabled" href="javascript:void(0);"><i
                                                                class="ti ti-circle-check me-1"></i> Teraktivasi</a>
                                                    @endif
                                                @endif

                                                <a class="dropdown-item"
                                                    href="{{ route('edit-member', ['id' => $member->id]) }}"><i
                                                        class="ti ti-pencil me-1"></i> Ubah</a>
                                                <button class="button dropdown-item" href="" data-bs-toggle="modal"
                                                    data-bs-target="#confirmDeleteModal-{{ $member->id }}">
                                                    <i class="ti ti-trash me-1"></i> Hapus
                                                </button>
                                                {{-- </form> --}}
                                                <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                    data-bs-target="#memberInfoModal-{{ $member->id }}">
                                                    <i class="ti ti-info-square me-1"></i> Info
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            @foreach ($members as $member)
                                <div class="modal fade" id="memberInfoModal-{{ $member->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="memberInfoModalLabel-{{ $member->id }}"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-simple modal-add-new-cc">
                                        <div class="modal-content p-3 p-md-5">
                                            <div class="modal-body">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                                <div class="text-center mb-4">
                                                    <h2 class="mb-2">{{ $member->username }}</h2>
                                                </div>
                                                <div class="row g-3">
                                                    <div class="col-12 text-center">
                                                        @if ($member->foto_profil)
                                                            <img src="{{ Storage::url($member->foto_profil) }}"
                                                                alt="Foto Profil" class="rounded-circle" width="100">
                                                        @else
                                                            <img src="{{ asset('img/default.png') }}"
                                                                alt="Default Profile" class="rounded-circle"
                                                                width="100">
                                                        @endif
                                                    </div>
                                                    <div class="col-12">
                                                        <label class="form-label">Nama: </label>
                                                        <p>{{ $member->name }}</p>
                                                    </div>
                                                    <div class="col-12">
                                                        <label class="form-label">Username: </label>
                                                        <p>{{ $member->username }}</p>
                                                    </div>
                                                    <div class="col-12">
                                                        <label class="form-label">Email: </label>
                                                        <p>{{ $member->email }}</p>
                                                    </div>
                                                    <div class="col-12">
                                                        <label class="form-label">No HP: </label>
                                                        <p>{{ $member->nohp }}</p>
                                                    </div>
                                                    <div class="row">
                                                        <label class="form-label">Arisan yg diikuti: </label>
                                                        @if ($member->joinedArisans->isEmpty())
                                                            <p>{{ $member->name }} belum mengikuti arisan.</p>
                                                        @else
                                                            @foreach ($member->joinedArisans as $arisan)
                                                                {{-- <div class="col-md-4 mb-3"> --}}
                                                                <div class="col-xl-4 col-md-4 col-6 mb-3">
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
                                                                                style="font-size: 14px; margin-left: -8px;">
                                                                                {{ Str::limit($arisan->nama_arisan, 10, '...') }}
                                                                            </h5>
                                                                            <p class="card-text"
                                                                                style="font-size: 12px; margin-left: -8px;">
                                                                                {{ Str::limit($arisan->deskripsi, 12, '...') }}
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            @foreach ($members as $member)
                                <!-- Add New Credit Card Modal -->
                                <div class="modal fade" id="confirmDeleteModal-{{ $member->id }}"
                                    aria-labelledby="confirmDeleteModalLabel-{{ $member->id }}" tabindex="-1"
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
                                                        {{ $member->username }}
                                                    </h2>
                                                    <p class="text-danger">*Data yang sudah dihapus tidak dapat
                                                        dikembalikan
                                                    </p>
                                                </div>
                                                <form id="addNewCCForm" class="row g-3"
                                                    action="{{ route('delete-member', ['id' => $member->id]) }}"
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
            </div>
            <!--/ Striped Rows -->

        </div>
        <!--/ Responsive Table -->
    </div>
    <!-- / Content -->

@endsection
