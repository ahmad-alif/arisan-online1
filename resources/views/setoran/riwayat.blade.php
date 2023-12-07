@extends('dashboard.index')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Riwayat')
@section('content')

    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-1">
                <span class="text-muted fw-light">
                    Pengguna /
                </span> Riwayat
            </h4>

            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Invoice Number</th>
                                    <th>Nama Arisan</th>
                                    <th>Bukti Setoran</th>
                                    <th>Status</th>
                                    <th>Waktu</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($riwayatSetoran as $setoran)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $setoran->invoice->invoice_number }}</td>
                                        <td>
                                            @foreach ($arisanData as $arisan)
                                                @if ($arisan->uuid == $setoran->uuid)
                                                    {{ $arisan->nama_arisan }}
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            <img src="{{ asset('storage/bukti_setoran/' . $setoran->bukti_setoran) }}"
                                                alt="Bukti Setoran" class="thumbnail-img" width="80px">
                                        </td>

                                        <td>
                                            @if ($setoran->status == 0)
                                                Belum di Approve
                                            @elseif ($setoran->status == 1)
                                                Sudah Valid
                                            @endif
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($setoran->created_at)->format('d M Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
