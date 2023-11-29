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

            <!-- Tambahkan formulir upload bukti setoran -->
            <div class="card">
                <div class="card-header">Upload Bukti Setoran</div>
                <div class="card-body">
                    @if ($invoice->bukti_transfer)
                        <img src="{{ asset('storage/bukti_transfer/' . $invoice->bukti_transfer) }}" alt="Bukti Transfer">
                    @endif

                    <form action="{{ route('setoran.upload.post', $invoice->invoice_number) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="bukti_transfer">Bukti Transfer</label>
                            <input type="file" class="form-control" id="bukti_transfer" name="bukti_transfer" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Upload Bukti Setoran</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
