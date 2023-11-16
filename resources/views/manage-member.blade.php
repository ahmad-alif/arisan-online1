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
                            <div class="col-sm">

                            </div>
                            <div class="col-sm">
                                <div class="d-flex align-items-center justify-content-between app-academy-md-80">
                                    <input type="search" class="form-control me-1" name="search"
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
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($members as $member)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>
                                        @if ($member->foto_profil)
                                            <img src="{{ Storage::url($member->foto_profil) }}" alt="Profile"
                                                class="rounded-circle" width="35" height="35">
                                        @else
                                            <i class="ti ti-user-circle ti-lg text-info"></i>
                                        @endif
                                    </td>
                                    <td>{{ $member->username }}</td>
                                    <td>{{ $member->name }}</td>
                                    <td>{{ $member->email }}</td>
                                    <td>{{ $member->nohp }}</td>
                                    @if (Auth::user()->role == 2)
                                        <td>
                                            @if ($member->active == 0)
                                                <form action="{{ route('activate-account', ['id' => $member->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <span class="badge bg-label-success me-1">Aktif</span>
                                                </form>
                                            @elseif ($member->active == 1)
                                                <button type="button" class="btn btn-label-danger btn-sm">Mati</button>
                                            @endif
                                        </td>
                                    @endif
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </button>

                                            <div class="dropdown-menu">
                                                @if (Auth::user()->role == 2)
                                                    @if ($member->active == 0)
                                                        <a class="dropdown-item disabled" href="javascript:void(0);"><i
                                                                class="ti ti-circle-check me-1"></i> Teraktifasi</a>
                                                    @elseif ($member->active == 1)
                                                        <a class="dropdown-item " href="javascript:void(0);"><i
                                                                class="ti ti-circle-check me-1"></i> Aktifkan</a>
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
                                                <a class="dropdown-item" href="javascript:void(0);"><i
                                                        class="ti ti-info-square me-1"></i> Info</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
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
                                                    <p class="text-danger">*Data yang sudah dihapus tidak dapat dikembalikan
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
