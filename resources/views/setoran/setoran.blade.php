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

            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

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
            {{-- <form action="{{ route('buat.invoice', $arisan->uuid) }}" method="post" id="buat-invoice-form">
                @csrf
                <button type="submit" class="btn btn-primary">Buat Invoice</button>
            </form> --}}

            <div class="row">
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title">Data Invoice</h5>
                            <form action="{{ route('buat.invoice', $arisan->uuid) }}" method="post" id="buat-invoice-form">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-success mt-n4">Buat Invoice</button>
                            </form>
                        </div>
                        <div class="card-body">
                            @if ($invoice)
                                <div class="row">
                                    <div class="col-md-4"><strong>Nomor Invoice</strong></div>
                                    <div class="col-md-8">{{ $invoice->invoice_number }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4"><strong>Nama Bank</strong></div>
                                    <div class="col-md-8">{{ $invoice->nama_bank }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4"><strong>No Rekening</strong></div>
                                    <div class="col-md-8">{{ $invoice->no_rekening }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 mt-3">
                                        <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#modalDetail{{ $invoice->id }}">
                                            Detail
                                        </button>
                                    </div>
                                </div>
                            @else
                                <p>Belum ada data invoice</p>
                            @endif
                        </div>
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="card-title">Unggah Bukti Setoran</h5>
                        </div>

                    </div>
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

    @if ($arisan->invoices->count() > 0)
        <div class="modal fade" id="modalDetail{{ $invoice->id }}" tabindex="-1" role="dialog"
            aria-labelledby="modalDetailLabel{{ $invoice->id }}" aria-hidden="true">

            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h5 class="modal-title mx-auto" id="invoiceModalLabel">Invoice Berhasil Dibuat</h5>
                    </div>

                    <div class="modal-body">
                        <!-- Tampilkan data invoice di sini -->
                        @if ($arisan->invoices->count() > 0)
                            @php
                                $latestInvoice = $arisan->invoices->sortByDesc('created_at')->first();
                            @endphp

                            <div class="row mb-2">
                                <div class="col-4"><strong>Nomor Invoice</strong></div>
                                <div class="col-8">{{ $latestInvoice->invoice_number }}</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-4"><strong>Nama Bank</strong></div>
                                <div class="col-8">{{ $latestInvoice->nama_bank }}</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-4"><strong>No Rekening Tujuan</strong></div>
                                <div class="col-8">
                                    <span id="noRekening">{{ $latestInvoice->no_rekening }}</span>
                                    <button class="btn btn-sm btn-primary float-end" style="padding: 0.2rem 0.4rem;"
                                        onclick="copyNoRekening()"><i class="ti ti-copy"></i></button>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-4"><strong>Nama Pemilik</strong></div>
                                <div class="col-8">{{ strtoupper($latestInvoice->nama_pemilik_rekening) }}</div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-4"><strong>Total:</strong></div>
                                <div class="col-8"><strong>Rp.
                                        {{ number_format($latestInvoice->total, 0, ',', '.') }}</strong></div>
                            </div>

                            <div id="copySuccessMessage" class="badge bg-label-success" style="display:none;">
                                <i data-feather="check" class="me-2"></i>
                                Nomor Rekening berhasil disalin
                            </div>
                        @else
                            <p>Invoice sedang dibuat...</p>
                        @endif

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- <script>
        function copyNoRekening() {
            // Memilih teks yang akan disalin
            var CopyNoRekening = document.getElementById("noRekening").innerText;

            // Menyalin teks ke clipboard menggunakan API Clipboard
            navigator.clipboard.writeText(CopyNoRekening).then(function() {
                console.log('Nomor Rekening berhasil disalin ke clipboard');
            }).catch(function(err) {
                console.error('Gagal menyalin teks ke clipboard', err);
            });
        }
    </script> --}}
    <script>
        function copyNoRekening() {
            // Memilih teks yang akan disalin
            var CopyNoRekening = document.getElementById("noRekening").innerText;

            // Menyalin teks ke clipboard menggunakan API Clipboard
            navigator.clipboard.writeText(CopyNoRekening).then(function() {
                console.log('Nomor Rekening berhasil disalin ke clipboard');

                // Menampilkan pesan sukses
                var copySuccessMessage = document.getElementById("copySuccessMessage");
                copySuccessMessage.style.display = "block";

                // Menghilangkan pesan setelah 3 detik
                setTimeout(function() {
                    copySuccessMessage.style.display = "none";
                }, 3000);
            }).catch(function(err) {
                console.error('Gagal menyalin teks ke clipboard', err);
            });
        }
    </script>

    {{-- <script>
        function showModalWithData() {
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

                    // Reload the page after 2 seconds (adjust the delay as needed)
                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                },
                error: function(error) {
                    console.error(error);
                }
            });
        }
    </script> --}}

    {{-- <script>
        // Function to handle the Ajax request for showing the modal after reloading the page
        function showModalWithData() {
            // Reload the page
            location.reload();

            // Note: The code below won't be executed after the reload
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

        // After the page reloads, check if there is an invoice and show the modal
        $(document).ready(function() {
            var hasInvoice = @json($invoice != null);

            if (hasInvoice) {
                var invoiceData = @json($invoice);

                var modalContent = '<small>Pastikan nilai transfer sesuai dengan yg ada di invoice</small>';
                modalContent += '<ul>';
                modalContent += '<li>Nomor Invoice: ' + invoiceData.invoice_number + '</li>';
                modalContent += '<li>Nama Bank: ' + invoiceData.nama_bank + '</li>';
                modalContent += '<li>No Rekening: ' + invoiceData.no_rekening + '</li>';
                modalContent += '<li>Nama Pemilik Rekening: ' + invoiceData.nama_pemilik_rekening + '</li>';
                modalContent += '<li>Total: ' + invoiceData.total + '</li>';
                modalContent += '</ul>';

                $('#invoiceModal .modal-body').html(modalContent);
                $('#invoiceModal').modal('show');
            }
        });
    </script> --}}





    {{-- <script>
        function showInvoiceModal() {
            // Reload the page
            location.reload();
        }

        // After the page reloads, check if there is an invoice and show the modal
        $(document).ready(function() {
            var hasInvoice = @json($invoice != null);

            if (hasInvoice) {
                var invoiceData = @json($invoice);

                var modalContent = '<p>Data Invoice sudah dibuat</p>';
                modalContent += '<ul>';
                modalContent += '<li>Nomor Invoice: ' + invoiceData.invoice_number + '</li>';
                modalContent += '<li>Nama Bank: ' + invoiceData.nama_bank + '</li>';
                modalContent += '<li>No Rekening: ' + invoiceData.no_rekening + '</li>';
                modalContent += '<li>Nama Pemilik Rekening: ' + invoiceData.nama_pemilik_rekening + '</li>';
                modalContent += '</ul>';

                $('#invoiceModal .modal-body').html(modalContent);
                $('#invoiceModal').modal('show');
            }
        });
    </script> --}}

    {{-- <script>
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
    </script> --}}
@endsection
