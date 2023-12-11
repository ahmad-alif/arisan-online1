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

            <section id="landingReviews">
                <div class="container">
                    <div class="row align-items-center">
                        @foreach ($arisans as $arisan)
                            <div class="col-xl-3 col-md-4 col-6 mb-4">
                                <a href="{{ route('arisan.detail.member', $arisan->uuid) }}"
                                    class="text-decoration-none text-black">
                                    <div class="card h-100">
                                        <div
                                            class="card-body pb-0 text-body d-flex flex-column justify-content-between h-100">
                                            <div class="rounded-2 text-center mb-3 width=">
                                                @if ($arisan->img_arisan)
                                                    <div style="position: relative; width: 100%; padding-bottom: 100%;">
                                                        <img style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;"
                                                            class="border rounded img-fluid"
                                                            src="{{ Storage::url($arisan->img_arisan) }}"
                                                            alt="{{ $arisan->nama_arisan }}" />
                                                    </div>
                                                @else
                                                    <img src="{{ asset('img/default_arisan.jpg') }}"
                                                        class="object-fit-sm-contain border rounded img-fluid"
                                                        alt="client logo">
                                                @endif
                                            </div>
                                            {{-- <h5 class="card-title mb-0" style="font-size: 14px;">
                                                {{ Str::limit($arisan->nama_arisan, 14, '...') }}
                                            </h5> --}}

                                            <span class="d-none d-sm-block">
                                                {{ $arisan->deposit_status ?? 'Belum Setor' }}
                                            </span>

                                            <h5 class="card-title mb-0 text-truncate" style="font-size: 16px;">
                                                {{ $arisan->nama_arisan }}
                                            </h5>

                                            <small class="text-muted text-truncate">
                                                @if ($arisan->user)
                                                    {{ $arisan->user->name }}
                                                @else
                                                    Tidak Diketahui
                                                @endif
                                            </small>

                                            <p class="mt-2 mb-2 text-truncate">
                                                {{ $arisan->deskripsi ? $arisan->deskripsi : 'Tidak ada deskripsi' }}
                                            </p>
                                        </div>

                                        <div class="card-body pt-0">
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
                                            <div class="d-flex flex-column flex-md-row gap-2 text-nowrap mt-2">
                                                <a class="app-academy-md-50 btn btn-warning me-md-2 d-flex align-items-center"
                                                    href="{{ route('setoran', $arisan->uuid) }}">
                                                    <span class="d-none d-sm-block">Setoran</span>
                                                    <i class="ti ti-info-square d-block d-sm-none"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <div class="pagination mb-5 d-flex justify-content-center">
                        {{ $arisans->links() }}
                    </div>
                </div>
            </section>
        </div>
    </div>

@endsection
