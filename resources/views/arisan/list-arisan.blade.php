@extends('dashboard.index')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Daftar Arisan | Arisanku')
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card mb-4">
                <div class="card-header d-flex flex-wrap justify-content-between gap-3">
                    <div class="card-title mb-0 me-1">
                        <h5 class="mb-1">Silahkan gabung arisan pada berikut ini.</h5>
                        <p class="text-muted mb-0">
                            @php
                                $jumlahArisan = count($arisans);
                            @endphp
                            Total {{ $jumlahArisan }} arisan dalam halaman ini
                        </p>
                    </div>
                    <div class="d-flex align-items-center justify-content-between app-academy-md-80">
                        <form action="{{ route('list-arisan.search') }}" method="GET" class="d-flex align-items-center">
                            <input type="search" class="form-control me-1" name="search" value="{{ request('search') }}"
                                placeholder="Cari Arisan...">
                            <button type="submit" class="btn btn-primary btn-icon"><i class="ti ti-search"></i></button>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row gy-4 mb-4">

                        @if ($arisans->count() > 0)
                            @foreach ($arisans as $arisan)
                                {{-- <div class="col-sm-6 col-lg-4"> --}}
                                <div class="col-md-3 col-6 mb-4">
                                    <div class="card p-2 h-100 shadow-none border">
                                        <div class="rounded-2 text-center mb-3 mt-3">
                                            <div class="d-flex align-items-center justify-content-center mb-3 mt-3 rounded"
                                                style="height: 200px; overflow: hidden;">
                                                @if ($arisan->img_arisan)
                                                    <img class="img-fluid rounded"
                                                        style="width: 100%; height: 100%; object-fit: cover;"
                                                        src="{{ Storage::url($arisan->img_arisan) }}"
                                                        alt="{{ $arisan->nama_arisan }}" />
                                                @else
                                                    <img src="{{ asset('img/default_arisan.jpg') }}"
                                                        class="img-fluid rounded" alt="Default Image" />
                                                @endif
                                            </div>

                                        </div>
                                        <div class="card-body p-3 pt-2">
                                            <a href="app-academy-course-details.html"
                                                class="h5">{{ $arisan->nama_arisan }}</a><br>
                                            <small class="mt-2 text-truncate">
                                                {{ $arisan->user ? $arisan->user->name : 'Kesalahan menampilkan' }}
                                            </small><br>
                                            <p class="mt-2 mb-2 text-truncate">
                                                {{ $arisan->deskripsi ? $arisan->deskripsi : 'Tidak ada deskripsi' }}
                                            </p>


                                            <div class="d-flex justify-content-between align-items-center mt-3 gap-3">
                                                <div class="row">
                                                    <div class="col-sm">
                                                        <small><i class="ti ti-calendar ti-sm"></i>Mulai</small><br>
                                                        <small
                                                            class="text-truncate">{{ \Carbon\Carbon::parse($arisan->start_date)->format('d M Y') }}</small>
                                                    </div>
                                                    <div class="col-sm">
                                                        <small><i class="ti ti-calendar-off ti-sm"></i>Selesai</small><br>
                                                        <small
                                                            class="text-truncate">{{ \Carbon\Carbon::parse($arisan->end_date)->format('d M Y') }}</small>
                                                    </div>
                                                </div>
                                            </div>


                                            {{-- <button type="submit" class="btn btn-primary w-100">Gabung</button> --}}
                                            <div class="d-flex flex-column flex-md-row gap-2 text-nowrap mt-2">
                                                @if ($arisan->isUserJoined(auth()->user()))
                                                    @if (auth()->user()->role == 1)
                                                        <a class="app-academy-md-50 btn btn-label me-md-2 d-flex align-items-center w-60"
                                                            href="{{ route('arisan.detail', $arisan) }}">
                                                            <span class="d-none d-sm-block">Detail</span>
                                                            <i
                                                                class="ti ti-info-small align-middle scaleX-n1-rtl me-2 mt-n1 ti-sm"></i>
                                                        </a>
                                                    @elseif (auth()->user()->role == 0)
                                                        <a class="app-academy-md-50 btn btn-warning me-md-2 d-flex align-items-center"
                                                            href="{{ route('arisan.detail.member', $arisan) }}">
                                                            <span class="d-none d-sm-block">Detail</span>
                                                            <i class="ti ti-info-square d-block d-sm-none"></i>
                                                        </a>
                                                    @endif
                                                @else
                                                    <form action="{{ route('arisan.join', $arisan) }}" method="POST"
                                                        id="joinForm{{ $arisan->id_arisan }}">
                                                        @csrf
                                                        <button type="button" class="btn btn-primary"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#confirmationModal{{ $arisan->id_arisan }}">
                                                            <span class="d-none d-sm-block">Gabung</span><i
                                                                class="ti ti-heart-handshake align-middle scaleX-n1-rtl me-2 mt-n1 ti-sm d-block d-sm-none"></i>
                                                        </button>
                                                    </form>
                                                    <div class="modal fade" id="confirmationModal{{ $arisan->id_arisan }}"
                                                        tabindex="-1" role="dialog"
                                                        aria-labelledby="confirmationModalLabel{{ $arisan->id_arisan }}"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"
                                                                        id="confirmationModalLabel{{ $arisan->id_arisan }}">
                                                                        Konfirmasi Gabung Arisan</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Apakah Anda yakin ingin gabung ke Arisan
                                                                        "<strong>{{ $arisan->nama_arisan }}</strong>" ?</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Batal</button>
                                                                    <button type="submit"
                                                                        form="joinForm{{ $arisan->id_arisan }}"
                                                                        class="btn btn-primary">Gabung</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="col-md-12">
                                {{-- <p>Tidak ada hasil ditemukan. </p> --}}
                            </div>
                        @endif

                    </div>
                </div>
                <div class="pagination mb-5 d-flex justify-content-center">
                    {{ $arisans->links() }}
                </div>
            </div>

        </div>
    </div>
@endsection
