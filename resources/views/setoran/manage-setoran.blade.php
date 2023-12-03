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

            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Invoice Number</th>
                            <th>Bukti Setoran</th>
                            <th>Status</th>
                            <th>Diupload pada</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($setoranData as $setoran)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $setoran->invoice_number }}</td>
                                <td>
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
                                                        <h5 class="modal-title" id="imageModalLabel">Bukti Setoran</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
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
                                </td>
                                <td>{{ $setoran->status }}</td>
                                <td>{{ \Carbon\Carbon::parse($setoran->created_at)->format('d F Y') }}</td>
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
            </div>
        </div>
    </div>

@endsection
