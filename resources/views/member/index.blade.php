@extends('dashboard.index')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Kelola Anggota | Arisanku')
@section('content')

    <!-- Striped Rows -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-3 mb-4"><span class="text-muted fw-light">Admin /</span> Kelola Anggota</h4>

            <div class="card">
                <div class="table-responsive text-nowrap">
                    <table class="table table-striped">
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
                                <tr class="align-middle">
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>
                                        @if ($member->foto_profil)
                                            <img src="{{ Storage::url($member->foto_profil) }}" alt="Profile"
                                                class="rounded-circle" width="35" height="35">
                                        @else
                                            <img src="{{ asset('img/default.png') }}" alt="Default Profile"
                                                class="rounded-circle" width="35" height="35">
                                        @endif
                                    </td>
                                    <td>{{ $member->username }}</td>
                                    <td>{{ $member->name }}</td>
                                    <td>{{ $member->email }}</td>
                                    <td>{{ $member->nohp }}</td>
                                    <td>
                                        <a href="#memberInfoModal-{{ $member->id }}"
                                            class="btn btn-sm btn-label-warning col-10 mb-1" data-bs-toggle="modal"
                                            data-bs-target="#memberInfoModal-{{ $member->id }}">
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- Modal dan lainnya seperti yang telah Anda tuliskan dalam kode awal -->
                @foreach ($members as $member)
                    <div class="modal fade" id="memberInfoModal-{{ $member->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="memberInfoModalLabel-{{ $member->id }}" aria-hidden="true">
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
                                                <img src="{{ Storage::url($member->foto_profil) }}" alt="Profile"
                                                    class="rounded-circle" width="150">
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
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!--/ Striped Rows -->

        </div>
        <!--/ Responsive Table -->
    </div>
    <!-- / Content -->

@endsection
