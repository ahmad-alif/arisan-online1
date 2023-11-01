@extends('layouts.app')

@section('container')
    @include('layouts.navbar')
    @include('layouts.sidebar')
    <main id="main" class="main">

        <div class="pagetitle border-bottom pb-3">
            <h1>Data Arisan</h1>
        </div><!-- End Page Title -->
        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body pt-3">

                            <!-- Table with stripped rows -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="col-4">
                                    <a href="/arisan/add" class="btn btn-primary"><i class="bi bi-plus"></i>Tambah
                                        arisan</a>
                                </div>
                                <div class="col-4 text-center">
                                    <!-- Area tengah kosong -->
                                </div>
                                <div class="col-4">
                                    <form action="/manage-arisan" method="GET">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="search"
                                                value="{{ request('search') }}" placeholder="Cari arisan...">
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
                                            <th scope="col">Gambar Arisan</th>
                                            <th scope="col">Nama Arisan</th>
                                            <th scope="col">Mulai</th>
                                            <th scope="col">Berakhir</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($arisans as $arisan)
                                            <tr class="align-middle">
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td>
                                                    @if ($arisan->img_arisan)
                                                        <img src="{{ Storage::url($arisan->img_arisan) }}" alt="Arisan"
                                                            class="rounded-circle" width="100">
                                                    @else
                                                        <img src="{{ asset('img/default_arisan.jpg') }}"
                                                            alt="Default Profile" class="rounded-circle" width="100">
                                                    @endif
                                                </td>
                                                <td>{{ $arisan->nama_arisan }}</td>
                                                <td>{{ $arisan->start_date }}</td>
                                                <td>{{ $arisan->end_date }}</td>

                                                <td class="">
                                                    @if ($arisan->status == 0)
                                                        <a href="{{ route('edit-arisan', ['id' => $arisan->id_arisan]) }}"
                                                            class="btn btn-sm btn-primary col-10 mb-1">
                                                            <i class="bi bi-pencil-fill"></i>Edit
                                                        </a>
                                                        <!-- Tombol Delete dengan ikon -->
                                                        <form
                                                            action="{{ route('delete-arisan', ['id' => $arisan->id_arisan]) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-sm btn-danger col-10 mb-1"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#confirmDeleteModal-{{ $arisan->id_arisan }}">
                                                                <i class="bi bi-trash-fill">Delete</i>
                                                            </button>
                                                        </form>
                                                    @elseif ($arisan->status == 1)
                                                        {{-- <a href="{{ route('start-arisan', ['id' => $arisan->id_arisan]) }}"
                                                            class="btn btn-sm btn-success col-10 mb-1">
                                                            Mulai Arisan
                                                        </a> --}}
                                                        <a href="{{ route('start-arisan', ['id' => $arisan->id_arisan]) }}"
                                                            class="btn btn-sm btn-success col-10 mb-1"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#confirmStartModal-{{ $arisan->id_arisan }}">
                                                            Mulai Arisan
                                                        </a>
                                                    @endif


                                                    <a href="#arisanInfoModal-{{ $arisan->id_arisan }}"
                                                        class="btn btn-sm btn-warning col-10 mb-1" data-bs-toggle="modal"
                                                        data-bs-target="#arisanInfoModal-{{ $arisan->id_arisan }}">
                                                        <i class="bi bi-info-circle">Detail</i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                <!-- Modal -->
                                @foreach ($arisans as $arisan)
                                    <div class="modal fade" id="arisanInfoModal-{{ $arisan->id_arisan }}" tabindex="-1"
                                        role="dialog" aria-labelledby="arisanInfoModalLabel-{{ $arisan->id_arisan }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"
                                                        id="arisanInfoModalLabel-{{ $arisan->id_arisan }}">
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
                                                                    alt="Default Profile" class="rounded-circle"
                                                                    width="100">
                                                            @elseif ($arisan->img_arisan)
                                                                <img src="{{ Storage::url($arisan->img_arisan) }}"
                                                                    alt="Arisan" class="rounded-circle" width="100">
                                                            @endif
                                                            <h5>Anggota Arisan({{ count($arisan->members) }} anggota):</h5>
                                                            <ul>
                                                                @if (count($arisan->memberArisans) > 0)
                                                                    @foreach ($arisan->memberArisans as $member)
                                                                        <li>{{ $member->user->username }}
                                                                            ({{ $member->user->name }})
                                                                        </li>
                                                                    @endforeach
                                                                @else
                                                                    <li>Belum ada member.</li>
                                                                @endif
                                                            </ul>
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
                                    <!-- Modal Konfirmasi Delete -->
                                    <div class="modal fade" id="confirmDeleteModal-{{ $arisan->id_arisan }}" tabindex="-1"
                                        role="dialog" aria-labelledby="confirmDeleteModalLabel-{{ $arisan->id_arisan }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"
                                                        id="confirmDeleteModalLabel-{{ $arisan->id_arisan }}">Konfirmasi
                                                        Hapus</h5>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah Anda yakin ingin menghapus arisan ini?
                                                </div>
                                                <div class="modal-footer">
                                                    <form
                                                        action="{{ route('delete-arisan', ['id' => $arisan->id_arisan]) }}"
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
                                @foreach ($arisans as $arisan)
                                    <div class="modal fade" id="confirmStartModal-{{ $arisan->id_arisan }}"
                                        tabindex="-1" role="dialog"
                                        aria-labelledby="confirmStartModalLabel-{{ $arisan->id_arisan }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title"
                                                        id="confirmStartModalLabel-{{ $arisan->id_arisan }}">Konfirmasi
                                                        Mulai Arisan</h5>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah Anda yakin ingin memulai arisan ini?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Batal</button>
                                                    <a href="{{ route('start-arisan', ['id' => $arisan->id_arisan]) }}"
                                                        class="btn btn-success">Ya, Mulai Arisan</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach



                            </div>
                            <!-- End Table with stripped rows -->
                            <div class="d-flex justify-content-center">
                                {{ $arisans->links() }}
                            </div>


                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main>
    @include('layouts.footer')
@endsection
