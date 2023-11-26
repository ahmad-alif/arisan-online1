@extends('dashboard.index')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Kelola Anggota | Arisanku')
@section('content')

    <!-- Striped Rows -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="mb-4"><span class="text-muted fw-light">Admin /</span> Kelola Anggota</h4>

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
                                            class="btn badge bg-label-info" data-bs-toggle="modal"
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
            </div>
            <!--/ Striped Rows -->

        </div>
        <!--/ Responsive Table -->
    </div>
    <!-- / Content -->

@endsection
