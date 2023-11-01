@extends('layouts.app')

@section('container')
    @include('layouts.navbar')
    @include('layouts.sidebar')
    <main id="main" class="main">
        <div class="pagetitle border-bottom pb-3">
            <h1>Manage member</h1>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body pt-3">
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
                                                <td>
                                                    <a href="#memberInfoModal-{{ $member->id }}"
                                                        class="btn btn-sm btn-warning col-10 mb-1" data-bs-toggle="modal"
                                                        data-bs-target="#memberInfoModal-{{ $member->id }}">
                                                        <i class="bi bi-info-circle">Detail</i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Modal dan lainnya seperti yang telah Anda tuliskan dalam kode awal -->
                            @foreach ($members as $member)
                                <div class="modal fade" id="memberInfoModal-{{ $member->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="memberInfoModalLabel-{{ $member->id }}"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="memberInfoModalLabel-{{ $member->id }}">
                                                    Informasi Member dan Arisan yang Diikuti</h5>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        @if ($member->foto_profil)
                                                            <img src="{{ Storage::url($member->foto_profil) }}"
                                                                alt="Profile" class="rounded-circle" width="150">
                                                        @else
                                                            <img src="{{ asset('img/default.png') }}" alt="Default Profile"
                                                                class="rounded-circle" width="100">
                                                        @endif
                                                    </div>
                                                    <div class="col-md-8">
                                                        <p><strong>Username:</strong> {{ $member->username }}</p>
                                                        <p><strong>Name:</strong> {{ $member->name }}</p>
                                                        <p><strong>Email:</strong> {{ $member->email }}</p>
                                                        <p><strong>No HP:</strong> {{ $member->nohp }}</p>
                                                        <p><strong>Foto KTP:</strong></p>
                                                        @if ($member->foto_ktp == null)
                                                            <p>Foto KTP Belum Ada</p>
                                                        @else
                                                            <img src="{{ Storage::url($member->foto_ktp) }}" alt="KTP"
                                                                width="250">
                                                        @endif
                                                        <p><strong>Arisan yang Diikuti:</strong></p>
                                                        @foreach ($member->arisans as $arisan)
                                                            <p>{{ $arisan->nama_arisan }}</p>
                                                            <!-- ... (tampilkan informasi arisan lainnya sesuai kebutuhan Anda) ... -->
                                                        @endforeach
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
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    @include('layouts.footer')
@endsection
