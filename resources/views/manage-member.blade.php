@extends('layouts.app')

@section('container')
    @include('layouts.navbar')
    @include('layouts.sidebar')
    <main id="main" class="main">

        <div class="pagetitle border-bottom pb-3">
            <h1>Manage member</h1>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body pt-3">

                            <!-- Table with stripped rows -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="col-4">
                                    <a href="/add-member" class="btn btn-primary"><i class="bi bi-plus"></i>Tambah
                                        member</a>
                                </div>
                                <div class="col-4 text-center">
                                    <!-- Area tengah kosong -->
                                </div>
                                <div class="col-4">
                                    <form action="/manage-member" method="GET">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="search"
                                                value="{{ request('search') }}" placeholder="Cari member...">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-primary" type="submit">
                                                    <i class="bi bi-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            @if (session()->has('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            @if (session()->has('loginError'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('loginError') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

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
                                            @if (Auth::user()->role == 2)
                                                <th scope="col">Status</th>
                                            @endif
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($members as $member)
                                            <tr class="align-middle">
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                {{-- <td><img src="{{ Storage::url($member->foto_profil) }}" alt="Profile"
                                                        class="rounded-circle" width="100"></td> --}}
                                                <td>
                                                    @if ($member->foto_profil)
                                                        <img src="{{ Storage::url($member->foto_profil) }}" alt="Profile"
                                                            class="rounded-circle" width="100">
                                                    @else
                                                        <img src="{{ asset('img/default.png') }}" alt="Default Profile"
                                                            class="rounded-circle" width="100">
                                                    @endif
                                                </td>

                                                <td>{{ $member->username }}</td>
                                                <td>{{ $member->name }}</td>
                                                <td>{{ $member->email }}</td>
                                                <td>{{ $member->nohp }}</td>
                                                {{-- <td>{{ $member->active }}</td> --}}
                                                @if (Auth::user()->role == 2)
                                                    <td>
                                                        @if ($member->active == 0)
                                                            {{-- <button class="btn btn-sm btn-success">
                                                            <i class="bi bi-check"></i>
                                                        </button> --}}
                                                            <form
                                                                action="{{ route('activate-account', ['id' => $member->id]) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <button type="submit"
                                                                    class="btn btn-sm btn-success col-6 mb-1">
                                                                    <i class="bi bi-check"></i>
                                                                </button>
                                                            </form>
                                                        @elseif ($member->active == 1)
                                                            <button class="btn btn-sm btn-secondary" disabled>
                                                                <i class="bi bi-check"></i>
                                                            </button>
                                                        @endif
                                                    </td>
                                                @endif


                                                <td class="">
                                                    {{-- <a href="{{ route('edit-member', ['id' => $member->id]) }}"
                                                    class="btn btn-sm btn-primary"> --}}
                                                    @if (Auth::user()->role == 2)
                                                        <a href="{{ route('edit-member', ['id' => $member->id]) }}"
                                                            class="btn btn-sm btn-primary col-10 mb-1">
                                                            <i class="bi bi-pencil-fill">Edit</i>
                                                        </a>

                                                        <!-- Tombol Delete dengan ikon -->
                                                        <form action="{{ route('delete-member', ['id' => $member->id]) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-sm btn-danger col-10 mb-1"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#confirmDeleteModal-{{ $member->id }}">
                                                                <i class="bi bi-trash-fill">Delete</i>
                                                            </button>
                                                        </form>
                                                    @endif
                                                    <a href="#memberInfoModal-{{ $member->id }}"
                                                        class="btn btn-sm btn-warning col-10 mb-1" data-bs-toggle="modal"
                                                        data-bs-target="#memberInfoModal-{{ $member->id }}">
                                                        <i class="bi bi-info-circle">Detail</i>
                                                    </a>

                                                    {{-- <a href="" class="btn btn-sm btn-danger">
                                                        <i class="bi bi-trash-fill"></i> </a> --}}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <!-- Modal -->
                                @foreach ($members as $member)
                                    <div class="modal fade" id="memberInfoModal-{{ $member->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="memberInfoModalLabel-{{ $member->id }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="memberInfoModalLabel-{{ $member->id }}">
                                                        Informasi Member</h5>

                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            @if ($member->foto_profil)
                                                                <img src="{{ Storage::url($member->foto_profil) }}"
                                                                    alt="Profile" class="rounded-circle" width="150">
                                                            @else
                                                                <img src="{{ asset('img/default.png') }}"
                                                                    alt="Default Profile" class="rounded-circle"
                                                                    width="100">
                                                            @endif
                                                        </div>
                                                        <div class="col-md-8">
                                                            <p><strong>Username:</strong> {{ $member->username }}</p>
                                                            <p><strong>Name:</strong> {{ $member->name }}</p>
                                                            <p><strong>Email:</strong> {{ $member->email }}</p>
                                                            <p><strong>No HP:</strong> {{ $member->nohp }}</p>
                                                            <p><strong>Foto KTP:</strong></p>
                                                            {{-- <img src="{{ Storage::url($member->foto_ktp) }}" alt="KTP"
                                                                width="250"> --}}
                                                            @if ($member->foto_ktp == null)
                                                                <p>Foto KTP Belum Ada</p>
                                                            @else
                                                                <img src="{{ Storage::url($member->foto_ktp) }}"
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
                                @foreach ($members as $member)
                                    <!-- Modal Konfirmasi Delete -->
                                    <div class="modal fade" id="confirmDeleteModal-{{ $member->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="confirmDeleteModalLabel-{{ $member->id }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"
                                                        id="confirmDeleteModalLabel-{{ $member->id }}">Konfirmasi
                                                        Hapus</h5>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah Anda yakin ingin menghapus member ini?
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="{{ route('delete-member', ['id' => $member->id]) }}"
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
                                {{ $members->links() }}
                            </div>


                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main>
    @include('layouts.footer')
@endsection
