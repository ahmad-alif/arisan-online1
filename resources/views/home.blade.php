@extends('layouts.home_navbar')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Selamat datang di Arisanku🤗')
@section('content')

    <div data-bs-spy="scroll" class="scrollspy-example">
        <!-- Hero: Start -->
        <section id="hero-animation">
            <div id="landingCTA" class="section-py landing-hero position-relative">
                <div class="container">
                    <div class="row align-items-center gy-5 gy-lg-0">
                        <div class="col-lg-6 text-center text-lg-start">
                            <h6 class="h2 text-primary fw-bold mb-1">Siap untuk Arisan Online?</h6>
                            <p class="fw-medium mb-4">anda bisa membuat dan gabung arisan kapan saja</p>
                            @auth
                            <a href="/dashboard" class="btn btn-lg btn-primary">Mulai</a>
@else
    <a href="/register/choose-role" class="btn btn-lg btn-primary">Mulai</a>
@endauth
                        </div>
                        <div class="col-lg-6 pt-lg-5 text-center text-lg-end">
                            <img src="/assets/img/front-pages/landing-page/cta-dashboard.png" alt="cta dashboard"
                                class="img-fluid" width="600"/>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Hero: End -->

        <!-- Real customers reviews: Start -->
        <section id="landingReviews">
            <div class="container">
                <div class="text-center mb-3 pb-1 mt-4">
                    <span class="badge bg-label-primary">Rekomendasi Arisan</span>
                </div>
                <h3 class="text-center mb-1"><span class="section-title">Arisan populer</span> untuk anda</h3>
                <!-- What people say slider: Start -->
                <div class="row align-items-center">
                    <!-- Sales last year -->
                    @foreach ($arisans as $arisan)
                        <div class="col-xl-2 col-md-4 col-6 mb-4">
                            <a href="#" data-bs-toggle="modal" data-bs-target="#arisanModal{{ $arisan->id_arisan }}">
                                <div class="card h-100">
                                    <div class="card-body pb-0 text-body d-flex flex-column justify-content-between h-100">
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
                                                    class="object-fit-sm-contain border rounded img-fluid" alt="Arisan">
                                            @endif
                                        </div>
                                        <h5 class="card-title mb-0" style="font-size: 14px;">
                                            {{ Str::limit($arisan->nama_arisan, 14, '...') }}
                                        </h5>

                                        <small class="text-muted">
                                            @if ($arisan->user)
                                                {{ Str::limit($arisan->user->name, 18, '...') }}
                                            @else
                                                Tidak Diketahui
                                            @endif
                                        </small>
                                    </div>
                                    <div id="salesLastYear"></div>
                                    <div class="card-body pt-0">
                                        <div class="d-flex justify-content-between align-items-center mt-3 gap-3">
                                            <div class="row">
                                                <div class="col-sm">
                                                    <small>Mulai</small>
                                                    <small>{{ \Carbon\Carbon::parse($arisan->start_date)->format('d M Y') }}</small>
                                                </div>
                                                <div class="col-sm">
                                                    <small>Selesai</small>
                                                    <small>{{ \Carbon\Carbon::parse($arisan->end_date)->format('d M Y') }}</small>
                                                </div>
                                            </div>
                                        </div>
                                        @auth
                                            @if (auth()->user()->role == 0)
                                                @if (auth()->user()->active == 1)
                                                    <a href="/list-arisan" class="btn btn-primary w-100 mt-2">Gabung</a>
                                                @endif
                                            @else
                                                {{-- <button class="btn btn-primary w-100 mt-2 disabled hidden">Gabung</button> --}}
                                            @endif
                                        @else
                                            <a href="/login" class="btn btn-primary w-100 mt-2">Gabung</a>
                                        @endauth
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="modal fade" id="arisanModal{{ $arisan->id_arisan }}" tabindex="-1"
                            aria-labelledby="arisanModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="arisanModalLabel">{{ $arisan->nama_arisan }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        @if ($arisan->img_arisan)
                                        <div class="text-center d-flex align-items-center justify-content-center">
                                                <img src="{{ Storage::url($arisan->img_arisan) }}"
                                                    class="img-fluid rounded mb-3" alt="{{ $arisan->nama_arisan }}" width="250"/>
                                                </div>
                                            @else
                                            <div class="text-center d-flex align-items-center justify-content-center">
                                                <img src="{{ asset('img/default_arisan.jpg') }}"
                                                    class="img-fluid rounded mb-3" alt="{{ $arisan->nama_arisan }}" width="250"/>
                                            </div>
                                            @endif

                                            <p>{{ $arisan->deskripsi }}</p>
                                    <div class="row">
                                        <div class="col-sm m-5 mt-0 mb-0 mr-0">
                                            <strong><i class="ti ti-calendar"></i> Mulai </strong> <br>
                                            <strong><i class="ti ti-calendar-off"></i> Selesai </strong> <br>
                                            <strong><i class="ti ti-atom"></i> Status </strong> <br>
                                            <strong><i class="ti ti-user-exclamation"></i> Max Anggota</strong> <br>
                                            <strong><i class="ti ti-hourglass-high"></i> Jangka Deposit</strong> <br>
                                            <strong><i class="ti ti-wallet"></i> Jumlah Pembayaran</strong>
                                        </div>
                                        <div class="col-sm m-5 mt-0 mb-0 ms-0">

                                            <ul>
                                                <li>
                                                    {{ \Carbon\Carbon::parse($arisan->start_date)->format('d M Y') }}</li>
                                                <li>
                                                    {{ \Carbon\Carbon::parse($arisan->end_date)->format('d M Y') }}</li>
                                                <li>
                                                    {{ $arisan->status == 1 ? 'Aktif' : 'Nonaktif' }}</li>
                                                <li> {{ $arisan->max_member }}</li>
                                                <li> {{ $arisan->deposit_frequency }}
                                                </li>
                                                <li> Rp.{{ $arisan->payment_amount }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-label-secondary"
                                            data-bs-dismiss="modal">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- What people say slider: End -->
            </div>
        </section>
        <!-- Real customers reviews: End -->

        <section id="landingReviews2">
            <div class="container">
                <h3 class="text-center mb-1"><span class="section-title">Arisan Terbaru</span></h3>
                <!-- What people say slider: Start -->
                <div class="row align-items-center">
                    <!-- Sales last year -->
                    @foreach ($arisans as $arisan)
                        <div class="col-xl-2 col-md-4 col-6 mb-4">
                            <div class="card h-100">
                                <div class="card-body pb-0 text-body d-flex flex-column justify-content-between h-100">
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
                                                class="object-fit-sm-contain border rounded img-fluid" alt="client logo">
                                        @endif
                                    </div>
                                    <h5 class="card-title mb-0" style="font-size: 14px;">
                                        {{ Str::limit($arisan->nama_arisan, 14, '...') }}
                                    </h5>

                                    <small class="text-muted">
                                        @if ($arisan->user)
                                            {{ Str::limit($arisan->user->name, 18, '...') }}
                                        @else
                                            Tidak Diketahui
                                        @endif
                                    </small>
                                </div>
                                <div id="salesLastYear"></div>
                                <div class="card-body pt-0">
                                    <div class="d-flex justify-content-between align-items-center mt-3 gap-3">
                                        <div class="row">
                                            <div class="col-sm">
                                                <small>Mulai</small>
                                                <small>{{ \Carbon\Carbon::parse($arisan->start_date)->format('d M Y') }}</small>
                                            </div>
                                            <div class="col-sm">
                                                <small>Selesai</small>
                                                <small>{{ \Carbon\Carbon::parse($arisan->end_date)->format('d M Y') }}</small>
                                            </div>
                                        </div>
                                    </div>
                                    @auth
                                        @if (auth()->user()->role == 0)
                                            @if (auth()->user()->active == 1)
                                                <a href="/list-arisan" class="btn btn-primary w-100 mt-2">Gabung</a>
                                            @endif
                                        @else
                                            {{-- <button class="btn btn-primary w-100 mt-2 disabled hidden">Gabung</button> --}}
                                        @endif
                                    @else
                                        <a href="/login" class="btn btn-primary w-100 mt-2">Gabung</a>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- What people say slider: End -->
            </div>
        </section>

    </div>

@endsection
