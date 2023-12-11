@extends('dashboard.index')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Kelola Setoran')
@section('content')

    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-1">
                <span class="text-muted fw-light">
                    Pemilik /
                </span> Kelola Setoran
            </h4>

            @if (session('success'))
                <div class="alert alert-success d-flex align-items-center" role="alert">
                    <span class="alert-icon text-success me-2">
                        <i class="ti ti-check ti-xs"></i>
                    </span>
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger d-flex align-items-center" role="alert">
                    <span class="alert-icon text-danger me-2">
                        <i class="ti ti-ban ti-xs"></i>
                    </span>
                    {{ session('error') }}
                </div>
            @endif

            <div class="card">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <div class="card-header d-flex flex-wrap justify-content-end gap-3">
                            @if (auth()->user()->role == 2)
                                <div class="d-flex align-items-center justify-content-between">
                                    <form action="{{ route('setoran.search') }}" method="GET"
                                        class="d-flex align-items-center justify-content-between \">
                                        <input type="search"
                                        class="form-control me-1" name="search" value="{{ request('search') }}"
                                        placeholder="Cari...">
                                        <button type="submit" class="btn btn-primary btn-icon"><i
                                                class="ti ti-search"></i></button>
                                    </form>
                                </div>
                            @elseif(auth()->user()->role == 1)
                                <div class="d-flex align-items-center justify-content-between app-academy-md-80">
                                    <form action="{{ route('setoran.search.owner') }}" method="GET"
                                        class="d-flex align-items-center justify-content-between \">
                                        <input type="search"
                                        class="form-control me-1" name="search" value="{{ request('search') }}"
                                        placeholder="Cari...">
                                        <button type="submit" class="btn btn-primary btn-icon"><i
                                                class="ti ti-search"></i></button>
                                    </form>
                                </div>
                            @endif
                        </div>
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Invoice Number</th>
                                <th>Bukti Setoran</th>
                                <th>Verifikasi</th>
                                <th>Diupload pada</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($setoranData as $setoran)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $setoran->invoice_number }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center align-items-center align-self-center">
                                            @if ($setoran->bukti_setoran)
                                                <a href="#" data-bs-toggle="modal"
                                                    data-bs-target="#imageModal{{ $setoran->id }}">
                                                    <img src="{{ asset('storage/bukti_setoran/' . $setoran->bukti_setoran) }}"
                                                        alt="Bukti Setoran" class="thumbnail-img" width="80px">
                                                </a>

                                                <!-- Image Modal -->
                                                <div class="modal fade" id="imageModal{{ $setoran->id }}" tabindex="-1"
                                                    aria-labelledby="imageModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="imageModalLabel">Bukti Setoran
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body text-center">
                                                                <img src="{{ asset('storage/bukti_setoran/' . $setoran->bukti_setoran) }}"
                                                                    class="img-fluid" alt="Bukti Setoran" width="400px">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                No Image
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center align-items-center align-self-center">
                                            @if ($setoran->status == 0)
                                                <span class="badge bg-label-danger"><i class="ti ti-xbox-x"></i></span>
                                            @elseif($setoran->status == 1)
                                                <span class="badge bg-label-success"><i
                                                        class="ti ti-circle-check"></i></span>
                                            @else
                                                <span class="badge bg-label-secondary"><i
                                                        class="ti ti-question-mark"></i></span>
                                            @endif
                                        </div>
                                    </td>

                                    <td>{{ \Carbon\Carbon::parse($setoran->created_at)->format('d F Y') }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center align-items-center align-self-center">
                                            @if ($setoran->status != 1)
                                                <form action="{{ route('update-setoran-status', $setoran->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('patch')
                                                    <button type="button" class="btn btn-sm btn-label-warning"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#confirmVerifikasiModal{{ $setoran->id }}">
                                                        <i class="ti ti-edit-circle fs-6"></i>
                                                    </button>
                                                </form>
                                            @else
                                                <p class="text-success"><i class="ti ti-circle-check"></i></p>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Belum ada setoran.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    @if (auth()->user()->role == 2)
                    @elseif (auth()->user()->role == 1)
                        <div class="m-2">
                            <form action="{{ route('export-setoran') }}" method="GET">
                                <button type="submit" class="btn btn-sm btn-success">
                                    <span class="ti-xs ti ti-file-spreadsheet me-1"></span>Export Excel
                                </button>
                            </form>
                        </div>
                    @endif
                    <div class="d-flex justify-content-center">
                        {{ $setoranData->links() }}
                    </div>

                    @foreach ($setoranData as $setoran)
                        <div class="modal fade" id="confirmVerifikasiModal{{ $setoran->id }}" tabindex="-1"
                            role="dialog" aria-labelledby="confirmVerifikasiModalLabel{{ $setoran->id }}"
                            aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="confirmVerifikasiModalLabel{{ $setoran->id }}">
                                            Konfirmasi Verifikasi Setoran</h5>
                                    </div>
                                    <div class="modal-body">
                                        <p>Apakah Anda yakin ingin memverifikasi setoran ini?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Batal</button>
                                        <form action="{{ route('update-setoran-status', $setoran->id) }}" method="post">
                                            @csrf
                                            @method('patch')
                                            <button type="submit" class="btn btn-success">Ya, Verifikasi</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>

@endsection
