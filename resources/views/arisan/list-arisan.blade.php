@extends('dashboard.index')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Daftar Arisan | Arisanku')
@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="card mb-4">
                <div class="card-header d-flex flex-wrap justify-content-between gap-3">
                    <div class="card-title mb-0 me-1">
                        <h6 class="mb-1">Silahkan gabung arisan pada berikut ini.</h6>
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
                    <div class="row align-items-center">

                        @if ($arisans->count() > 0)
                            @foreach ($arisans as $arisan)
                                {{-- <div class="col-sm-6 col-lg-4"> --}}
                                <div class="col-xl-2 col-md-4 col-6 mb-0">
                                    <div class="card h-100 mt-2">
                                        <div class="rounded-2 text-center mb-2 mt-2 width=">
                                            <div
                                                class="card-body pb-0 text-body d-flex flex-column justify-content-between h-100">
                                                @if ($arisan->img_arisan)
                                                    <div style="position: relative; width: 100%; padding-bottom: 100%;">
                                                        <img style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;"
                                                            class="border rounded img-fluid"
                                                            src="{{ Storage::url($arisan->img_arisan) }}"
                                                            alt="{{ $arisan->nama_arisan }}" />
                                                    </div>
                                                @else
                                                    <div style="position: relative; width: 100%; padding-bottom: 100%;">
                                                        <img src="{{ asset('img/default_arisan.jpg') }}"
                                                            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;"
                                                            class="border rounded img-fluid" alt="Default Image" />
                                                    </div>
                                                @endif
                                            </div>

                                        </div>
                                        <div class="card-body pt-0">
                                            <a href="" class="h5 text-truncate">{{ $arisan->nama_arisan }}</a><br>
                                            <small class="mt-2 text-truncate">
                                                {{ $arisan->user ? $arisan->user->name : '(Eror)' }}
                                            </small>
                                            <p class="mt-2 text-truncate">
                                                {{ $arisan->deskripsi ? $arisan->deskripsi : 'Tidak ada deskripsi' }}
                                            </p>


                                            <div class="d-flex justify-content-between align-items-center mt-2 gap-2 mb-0">
                                                <div class="row">
                                                    <div class="col-sm">
                                                        <small><i class="ti ti-calendar ti-sm ti-xs fs-5"></i>
                                                            Mulai</small><br>
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
                                            <div class="card-body pt-0 mt-3 mb-0">
                                                @if ($arisan->isUserJoined(auth()->user()))
                                                    @if (auth()->user()->role == 0)
                                                        <a class="btn btn-label-warning d-flex align-items-center"
                                                            href="{{ route('arisan.detail.member', $arisan->uuid) }}">
                                                            <i class="ti ti-info-square d-block d-sm-none"></i>
                                                            <span class="d-none d-sm-block"><i
                                                                    class="ti ti-info-square scaleX-n1-rtl"></i>
                                                                Detail</span>

                                                        </a>
                                                    @endif
                                                @else
                                                    @if (auth()->user()->role == 0)
                                                        <form action="{{ route('arisan.join', $arisan) }}" method="POST"
                                                            id="joinForm{{ $arisan->id_arisan }}">
                                                            @csrf
                                                            <button type="button"
                                                                class="btn btn-primary w-100 d-flex align-items-center"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#confirmationModal{{ $arisan->id_arisan }}">
                                                                <i class="ti ti-cube-plus d-block d-sm-none"></i>
                                                                <span class="d-none d-sm-block">Gabung</span>
                                                            </button>
                                                        </form>
                                                        <div class="modal fade"
                                                            id="confirmationModal{{ $arisan->id_arisan }}" tabindex="-1"
                                                            role="dialog"
                                                            aria-labelledby="confirmationModalLabel{{ $arisan->id_arisan }}"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title"
                                                                            id="confirmationModalLabel{{ $arisan->id_arisan }}">
                                                                            Konfirmasi Gabung Arisan</h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p>Apakah Anda yakin ingin gabung ke Arisan
                                                                            "<strong>{{ $arisan->nama_arisan }}</strong>" ?
                                                                        </p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button"
                                                                            class="btn btn-label-secondary"
                                                                            data-bs-dismiss="modal">Batal</button>
                                                                        <button type="submit"
                                                                            form="joinForm{{ $arisan->id_arisan }}"
                                                                            class="btn btn-success">Gabung</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="col-md-12">
                                <p>Tidak ada hasil ditemukan dari "{{ request('search') }}" </p>
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
