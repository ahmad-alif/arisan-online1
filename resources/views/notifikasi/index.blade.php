@extends('dashboard.index')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Kelola Notifikasi')
@section('content')

    <!-- Striped Rows -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-1"><span class="text-muted fw-light">Admin /</span> Kelola Notifikasi</h4>

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
                                <a href="/add-notifikasi">
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
                                        value="{{ request('search') }}" placeholder="Cari...">
                                    <button type="submit" class="btn btn-primary btn-icon"><i
                                            class="ti ti-search"></i></button>
                                </div>
                            </div>
                        </div>
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Judul</th>
                                <th scope="col">Isi</th>
                                <th scope="col">Kepada</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @foreach ($notifications as $notification)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $notification->judul }}</td>
                                    <td>{{ $notification->isi }}</td>
                                    <td><button type="button" class="btn btn-link btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#ownerInfoModal{{ $notification->user->id }}">
                                            {{ $notification->user->username }}
                                        </button></td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                                data-bs-toggle="dropdown">
                                                <i class="ti ti-dots-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item"
                                                    href="{{ route('edit-notifikasi', ['slug' => $notification->slug]) }}">
                                                    <i class="ti ti-pencil me-1"></i> Ubah
                                                </a>
                                                {{-- <button class="button dropdown-item" href="" data-bs-toggle="modal"
                                                    data-bs-target="#confirmDeleteModal-{{ $notification->slug }}">
                                                    <i class="ti ti-trash me-1"></i> Hapus
                                                </button> --}}
                                                <button class="button dropdown-item" data-bs-toggle="modal"
                                                    data-bs-target="#confirmDeleteModal{{ $notification->slug }}">
                                                    <i class="ti ti-trash me-1"></i> Hapus
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <div class="modal fade" id="confirmDeleteModal{{ $notification->slug }}" tabindex="-1"
                                    role="dialog" aria-labelledby="confirmDeleteModalLabel{{ $notification->slug }}"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title"
                                                    id="confirmDeleteModalLabel{{ $notification->slug }}">Konfirmasi
                                                    Penghapusan
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Anda yakin ingin menghapus notifikasi ini?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Batal</button>
                                                <form
                                                    action="{{ route('delete-notifikasi', ['slug' => $notification->slug]) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            @foreach ($owners as $owner)
                <div class="modal fade" id="ownerInfoModal{{ $owner->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="ownerInfoModalLabel{{ $owner->id }}" aria-hidden="true">
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
                                            <img src="{{ Storage::url($owner->foto_profil) }}" alt="Foto Profil"
                                                class="rounded-circle" width="100">
                                        @else
                                            <img src="{{ asset('img/default.png') }}" alt="Default Profile"
                                                class="rounded-circle" width="100">
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
                                                                <h5 class="card-title" style="font-size: 14px;">
                                                                    {{ Str::limit($arisan->nama_arisan, 10, '...') }}
                                                                </h5>
                                                                <p class="card-text" style="font-size: 12px;">
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
            <!--/ Striped Rows -->

        </div>
        <!--/ Responsive Table -->
    </div>
    <!-- / Content -->

@endsection
