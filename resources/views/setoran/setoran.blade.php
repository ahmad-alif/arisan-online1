@extends('dashboard.index')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Setoran')
@section('content')

    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-1">
                <span class="text-muted fw-light">
                    Pengguna /
                </span> Setoran Arisan
            </h4>

            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">

                        <div class="mt-3">
                            <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
                                <div class="flex-shrink-0 mt-n0 mx-sm-0 mx-auto">
                                    @if ($arisan->img_arisan)
                                        <img src="{{ Storage::url($arisan->img_arisan) }}" alt="{{ $arisan->nama_arisan }}"
                                            class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img" width="100px" />
                                    @else
                                        <img src="{{ asset('img/default_arisan.jpg') }}" alt="Default Arisan Image"
                                            class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img" width="100px" />
                                    @endif
                                </div>
                                <div class="flex-grow-1 mt-3 mt-sm-3">
                                    <div
                                        class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
                                        <div class="user-profile-info">
                                            <h4>{{ $arisan->nama_arisan }}</h4>
                                            <ul
                                                class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                                                <li class="list-inline-item d-flex gap-1">
                                                    <p class="fw-bold">Tanggal Mulai:</p>
                                                    {{ $arisan->start_date ? \Carbon\Carbon::parse($arisan->start_date)->isoFormat('D MMMM Y') : '-' }}
                                                </li>
                                                <li class="list-inline-item d-flex gap-1">
                                                    <p class="fw-bold">Tanggal Berakhir:</p>
                                                    {{ $arisan->end_date ? \Carbon\Carbon::parse($arisan->end_date)->isoFormat('D MMMM Y') : 'Arisan Belum Dimulai' }}
                                                </li>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tombol untuk membuat invoice -->
            {{-- <form action="{{ route('buat.invoice', $arisan->uuid) }}" method="post">
                @csrf
                <button type="submit" class="btn btn-primary">Buat Invoice</button>
            </form> --}}
            {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#invoiceModal">
                Buat Invoice
            </button> --}}
            <form action="{{ route('buat.invoice', $arisan->uuid) }}" method="post" id="buat-invoice-form">
                @csrf
                <button type="button" class="btn btn-primary" onclick="showInvoiceModal()">Buat Invoice</button>
            </form>

            <!-- Tampilkan data invoice (jika ada) -->
            {{-- @if ($arisan->invoices->count() > 0)
                <h2>Data Invoice</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nomor Invoice</th>
                            <th>Nama Bank</th>
                            <!-- Tambahkan kolom lain sesuai kebutuhan -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($arisan->invoices as $invoice)
                            <tr>
                                <td>{{ $invoice->invoice_number }}</td>
                                <td>{{ $invoice->nama_bank }}</td>
                                <!-- Tambahkan data lain sesuai kebutuhan -->
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>Belum ada data invoice</p>
            @endif --}}

            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title">Data Invoice</h5>
                </div>
                <div class="card-body">
                    @if ($invoice)
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nomor Invoice</th>
                                    <th>Nama Bank</th>
                                    <!-- Add more columns as needed -->
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $invoice->invoice_number }}</td>
                                    <td>{{ $invoice->nama_bank }}</td>
                                    <!-- Add more data columns as needed -->
                                </tr>
                            </tbody>
                        </table>
                    @else
                        <p>Belum ada data invoice</p>
                    @endif
                </div>
                <div class="card-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>



            <!-- Tampilkan data setoran (jika ada) -->
            @if ($arisan->setorans->count() > 0)
                <h2>Data Setoran</h2>
                <table class="table">
                    <!-- ... -->
                    <tbody>
                        @foreach ($arisan->setorans as $setoran)
                            <tr>
                                <td>{{ $setoran->bukti_setoran }}</td>
                                <td>{{ $setoran->status }}</td>
                                <!-- Add more columns as needed -->
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>Belum ada data setoran</p>
            @endif
        </div>
    </div>
    <div class="modal fade" id="invoiceModal" tabindex="-1" role="dialog" aria-labelledby="invoiceModalLabel"
        aria-hidden="true">
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="invoiceModalLabel">Data Invoice</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Tampilkan data invoice di sini -->
                    @if ($arisan->invoices->count() > 0)
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nomor Invoice</th>
                                    <th>Nama Bank</th>
                                    <!-- Tambahkan kolom lain sesuai kebutuhan -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($arisan->invoices as $invoice)
                                    <tr>
                                        <td>{{ $invoice->invoice_number }}</td>
                                        <td>{{ $invoice->nama_bank }}</td>
                                        <!-- Tambahkan data lain sesuai kebutuhan -->
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>Belum ada data invoice</p>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>


    <script>
        function showInvoiceModal() {
            // Mengambil data dari server
            $.ajax({
                url: "{{ route('buat.invoice', $arisan->uuid) }}",
                type: "post",
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    // Menampilkan data di dalam modal
                    $('#invoiceModal .modal-body').html(response.html);
                    $('#invoiceModal').modal('show');
                },
                error: function(error) {
                    console.error(error);
                }
            });
        }
    </script>
@endsection