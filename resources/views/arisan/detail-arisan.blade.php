@extends('dashboard.index')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Detail Arisan')
@section('content')

    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-1">
                <span class="text-muted fw-light">
                    @if (Auth::user()->role == 2)
                        Admin /
                    @elseif (Auth::user()->role == 1)
                        Owner /
                    @elseif (Auth::user()->role == 0)
                        Pengguna /
                    @endif
                </span> Detail Arisan
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
                                            <div class="row">
                                                <div class="col-md-9 mb-n4">
                                                    <div class="d-flex align-items-center mb-3">
                                                        <input type="text" class="form-control"
                                                            value="{{ route('detail-arisan', $arisan->uuid) }}"
                                                            id="joinLink" readonly>
                                                        <button class="btn btn-primary btn-sm ms-2" onclick="copyLink()"><i
                                                                class="ti ti-link text-white"></i></button>
                                                    </div>
                                                    <div id="copyMessage" class="badge bg-label-success mt-n4 mb-2"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- About Arisan -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <small class="card-text text-uppercase">Info Arisan</small>
                            </div>
                            <div class="mt-3">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="d-flex align-items-center mb-3">
                                            <i class="ti ti-text-caption text-heading"></i>
                                            <span class="fw-medium mx-2 text-heading">Deskripsi</span>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="d-flex align-items-center mb-3">
                                            <div style="max-height: 200px; overflow-y: auto;">
                                                {{ $arisan->deskripsi }}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="d-flex align-items-center mb-3">
                                            <i class="ti ti-square-check text-heading"></i>
                                            <span class="fw-medium mx-2 text-heading">Status</span>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="d-flex align-items-center mb-3">
                                            <span>
                                                @if ($arisan->status == 0)
                                                    <span class="btn btn-sm btn-light disabled">Belum Terverifikasi</span>
                                                @elseif ($arisan->status == 1)
                                                    <span class="btn btn-sm btn-primary disabled">Sudah Terverifikasi</span>
                                                @elseif ($arisan->status == 2)
                                                    <span class="btn btn-sm btn-success disabled">Berjalan</span>
                                                @elseif ($arisan->status == 3)
                                                    <span class="btn btn-sm btn-danger disabled">Berakhir</span>
                                                @else
                                                    Status Tidak Diketahui
                                                @endif
                                            </span>

                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="d-flex align-items-center mb-3">
                                            <i class="ti ti-user text-heading"></i>
                                            <span class="fw-medium mx-2 text-heading">Maksimal Anggota</span>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="d-flex align-items-center mb-3">
                                            <span>{{ $arisan->max_member }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="d-flex align-items-center mb-3">
                                            <i class="ti ti-calendar text-heading"></i>
                                            <span class="fw-medium mx-2 text-heading">Frekuensi Setoran</span>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="d-flex align-items-center mb-3">
                                            @php
                                                $frequencyText = '';
                                                switch ($arisan->deposit_frequency) {
                                                    case 1:
                                                        $frequencyText = '1 Minggu sekali';
                                                        break;
                                                    case 2:
                                                        $frequencyText = '2 Minggu sekali';
                                                        break;
                                                    case 4:
                                                        $frequencyText = '1 Bulan sekali';
                                                        break;
                                                    // Add more cases as needed
                                                    default:
                                                        $frequencyText = 'Tidak diketahui';
                                                }
                                            @endphp
                                            <span>{{ $frequencyText }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="d-flex align-items-center mb-3">
                                            <i class="ti ti-moneybag text-heading"></i>
                                            <span class="fw-medium mx-2 text-heading">Jumlah Setoran</span>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="d-flex align-items-center mb-3">
                                            <span id="payment_amount">
                                                Rp. {{ number_format($arisan->payment_amount, 0, ',', '.') }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="d-flex align-items-center mb-3">
                                            <i class="ti ti-building-bank text-heading"></i>
                                            <span class="fw-medium mx-2 text-heading">Nama Bank</span>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="d-flex align-items-center mb-3">
                                            <span>{{ $arisan->nama_bank }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="d-flex align-items-center mb-3">
                                            <i class="ti ti-credit-card text-heading"></i>
                                            <span class="fw-medium mx-2 text-heading">Nomor Rekening</span>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="d-flex align-items-center mb-3">
                                            <span>{{ $arisan->no_rekening }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="d-flex align-items-center mb-3">
                                            <i class="ti ti-user text-heading"></i>
                                            <span class="fw-medium mx-2 text-heading">Nama Pemilik Rekening</span>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="d-flex align-items-center mb-3">
                                            <span>{{ $arisan->nama_pemilik_rekening }}</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <small class="card-text text-uppercase">Member Arisan</small>
                            </div>
                            <div class="mt-3">
                                <div class="table-responsive text-nowrap">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Foto Profil</th>
                                                <th scope="col">Username</th>
                                                <th scope="col">Name</th>
                                                @if (auth()->user()->role != 0)
                                                    <th scope="col">Email</th>
                                                    <th scope="col">No HP</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($arisan->members as $member)
                                                <tr>
                                                    <th scope="row">{{ $loop->iteration }}</th>
                                                    <td>
                                                        @if ($member->foto_profil)
                                                            <img src="{{ Storage::url($member->foto_profil) }}"
                                                                alt="Profile" class="rounded-circle" width="35"
                                                                height="35">
                                                        @else
                                                            <i class="ti ti-user-circle ti-lg text-info"></i>
                                                        @endif
                                                    </td>
                                                    <td>{{ $member->username }}</td>
                                                    <td>{{ $member->name }}</td>
                                                    @if (auth()->user()->role != 0)
                                                        <td>{{ $member->email }}</td>
                                                        <td>{{ $member->nohp }}</td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <small class="card-text text-uppercase">Setoran</small>
                            </div>
                            <div class="mt-3">
                                <div class="table-responsive text-nowrap">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Foto Profil</th>
                                                <th scope="col">Username</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($arisan->members as $member)
                                                <tr>
                                                    <th scope="row">{{ $loop->iteration }}</th>
                                                    <td>
                                                        @if ($member->foto_profil)
                                                            <img src="{{ Storage::url($member->foto_profil) }}"
                                                                alt="Profile" class="rounded-circle" width="35"
                                                                height="35">
                                                        @else
                                                            <i class="ti ti-user-circle ti-lg text-info"></i>
                                                        @endif
                                                    </td>
                                                    <td>{{ $member->username }}</td>

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        // Fungsi untuk mengonversi angka menjadi format mata uang Rupiah
        function formatRupiah(angka) {
            return 'Rp. ' + angka.toLocaleString('id-ID');
        }

        // Fungsi untuk memformat input setiap kali ada perubahan
        function updateRupiah() {
            var input = document.getElementById('payment_amount');
            var value = input.value.replace(/\D/g, ''); // Menghapus karakter non-digit
            input.value = formatRupiah(value);
        }

        // Menambahkan event listener untuk memanggil fungsi setiap kali ada perubahan pada input
        document.getElementById('payment_amount').addEventListener('input', updateRupiah);
    </script>

    <script>
        // Fungsi untuk menyalin teks ke clipboard
        function copyLink() {
            var linkInput = document.getElementById('joinLink');
            linkInput.select();
            document.execCommand('copy');

            var copyMessage = document.getElementById('copyMessage');
            copyMessage.innerHTML = 'Link bergabung berhasil disalin!';

            setTimeout(function() {
                copyMessage.innerHTML = '';
            }, 3000);
        }
    </script>

@endsection
