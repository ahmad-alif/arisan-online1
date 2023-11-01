@extends('layouts.app')

@section('container')
    @include('layouts.navbar')
    @include('layouts.sidebar')
    <main id="main" class="main">

        <div class="pagetitle border-bottom pb-3">
            <h1>Manage Owner</h1>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body pt-3">

                            <!-- Table with stripped rows -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="col-4">
                                    <a href="/add-owner" class="btn btn-primary"><i class="bi bi-plus"></i>Tambah Owner</a>
                                </div>
                                <div class="col-4 text-center">
                                    <!-- Area tengah kosong -->
                                </div>
                                <div class="col-4">
                                    <form action="/manage-owner" method="GET">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="search"
                                                value="{{ request('search') }}" placeholder="Cari Owner...">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-primary" type="submit">
                                                    <i class="bi bi-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Foto Profil</th>
                                            <th scope="col">Username</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">No HP</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($owners as $owner)
                                            <tr class="align-middle">
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td>
                                                    @if ($owner->foto_profil)
                                                        <img src="{{ Storage::url($owner->foto_profil) }}" alt="Profile"
                                                            class="rounded-circle" width="100">
                                                    @else
                                                        <img src="{{ asset('img/default.png') }}" alt="Default Profile"
                                                            class="rounded-circle" width="100">
                                                    @endif
                                                </td>
                                                <td>{{ $owner->username }}</td>
                                                <td>{{ $owner->name }}</td>
                                                <td>{{ $owner->email }}</td>
                                                <td>{{ $owner->nohp }}</td>
                                                <td>
                                                    @if ($owner->active == 0)
                                                        {{-- <button class="btn btn-sm btn-success">
                                                            <i class="bi bi-check"></i>
                                                        </button> --}}
                                                        <form
                                                            action="{{ route('activate-account-owner', ['id' => $owner->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit"
                                                                class="btn btn-sm btn-success col-6 mb-1">
                                                                <i class="bi bi-check"></i>
                                                            </button>
                                                        </form>
                                                    @elseif ($owner->active == 1)
                                                        <button class="btn btn-sm btn-secondary" disabled>
                                                            <i class="bi bi-check"></i>
                                                        </button>
                                                    @endif
                                                </td>
                                                <td class="">
                                                    {{-- <a href="{{ route('edit-owner', ['id' => $owner->id]) }}"
                                                    class="btn btn-sm btn-primary"> --}}
                                                    <a href="{{ route('edit-owner', ['id' => $owner->id]) }}"
                                                        class="btn btn-sm btn-primary  col-10 mb-1">
                                                        <i class="bi bi-pencil-fill">Edit</i>
                                                    </a>

                                                    <!-- Tombol Delete dengan ikon -->
                                                    <form action="{{ route('delete-owner', ['id' => $owner->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-sm btn-danger col-10 mb-1"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#confirmDeleteModal-{{ $owner->id }}">
                                                            <i class="bi bi-trash-fill">Delete</i>
                                                        </button>
                                                    </form>

                                                    <a href="#" class="btn btn-sm btn-warning col-10 mb-1"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#ownerInfoModal-{{ $owner->id }}">
                                                        <i class="bi bi-info-circle">Info</i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @foreach ($owners as $owner)
                                    <div class="modal fade" id="ownerInfoModal-{{ $owner->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="ownerInfoModalLabel-{{ $owner->id }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="ownerInfoModalLabel-{{ $owner->id }}">
                                                        Informasi owner</h5>

                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <img src="{{ Storage::url($owner->foto_profil) }}"
                                                                alt="Profile" class="rounded-circle" width="150">
                                                        </div>
                                                        <div class="col-md-8">
                                                            <p><strong>Username:</strong> {{ $owner->username }}</p>
                                                            <p><strong>Name:</strong> {{ $owner->name }}</p>
                                                            <p><strong>Email:</strong> {{ $owner->email }}</p>
                                                            <p><strong>No HP:</strong> {{ $owner->nohp }}</p>
                                                            <p><strong>Foto KTP:</strong></p>
                                                            {{-- <img src="{{ Storage::url($owner->foto_ktp) }}" alt="KTP"
                                                                width="250"> --}}
                                                            @if ($owner->foto_ktp == null)
                                                                <p>Foto KTP Belum Ada</p>
                                                            @else
                                                                <img src="{{ Storage::url($owner->foto_ktp) }}"
                                                                    alt="KTP" width="250">
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
                                @foreach ($owners as $owner)
                                    <!-- Modal Konfirmasi Delete -->
                                    <div class="modal fade" id="confirmDeleteModal-{{ $owner->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="confirmDeleteModalLabel-{{ $owner->id }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"
                                                        id="confirmDeleteModalLabel-{{ $owner->id }}">Konfirmasi
                                                        Hapus</h5>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah Anda yakin ingin menghapus owner ini?
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="{{ route('delete-owner', ['id' => $owner->id]) }}"
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
                                {{ $owners->links() }}
                            </div>


                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main>
    @include('layouts.footer')
@endsection
