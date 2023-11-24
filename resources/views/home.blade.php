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
                <h6 class="h2 text-primary fw-bold mb-1">Ready to Get Started?</h6>
                <p class="fw-medium mb-4">Start your project with a 14-day free trial</p>
                <a href="payment-page.html" class="btn btn-lg btn-primary">Get Started</a>
              </div>
              <div class="col-lg-6 pt-lg-5 text-center text-lg-end">
                <img
                  src="/assets/img/front-pages/landing-page/cta-dashboard.png"
                  alt="cta dashboard"
                  class="img-fluid" />
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
            <div class="card h-100">
              <div class="card-body pb-0 text-body d-flex flex-column justify-content-between h-100">
                <div class="rounded-2 text-center mb-3 width=">
                    {{-- <img
                      src="/assets/img/front-pages/branding/logo-1.png"
                      alt="client logo"
                      class="client-logo img-fluid" /> --}}
                      @if ($arisan->img_arisan)

                      {{-- <img src="{{ Storage::url($arisan->img_arisan) }}"
                          class="me-3 rounded-circle"
                          width="35"
                          height="35"
                          alt="{{ $arisan->nama_arisan }}"> --}}
                      <img
                      class="object-fit-sm-contain border rounded img-fluid"
                          src="{{ Storage::url($arisan->img_arisan) }}"
                          alt="{{ $arisan->nama_arisan }}"

                          />
                      @else
                      <img src="{{ asset('img/default_arisan.jpg') }}"
                      class="object-fit-sm-contain border rounded img-fluid"
                          alt="client logo" >
                      @endif
                  </div>
                <h5 class="card-title mb-0">{{ $arisan->nama_arisan }}</h5>
                <small class="text-muted">
                    @if ($arisan->user)
                            {{ $arisan->user->name }}
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
                        <small>{{ $arisan->start_date }}</small>
                    </div>
                    <div class="col-sm">
                        <small>Selesai</small>
                        <small>{{ $arisan->end_date }}</small>
                        </div>
                    </div>
                </div>
                @auth
    @if(auth()->user()->role == 0)
        <!-- Tampilkan tautan "Gabung" jika role pengguna adalah 0 -->
        @if (auth()->user()->active == 1)
        <!-- Tampilkan tautan "Gabung" jika role pengguna adalah 0 -->
        <a href="/list-arisan" class="btn btn-primary w-100 mt-2">Gabung</a>
        @else
        @endif
    @else
        <!-- Nonaktifkan tombol jika role pengguna bukan 0 -->
        {{-- <button class="btn btn-primary w-100 mt-2 hidden disabled" >Gabung</button> --}}
    @endif
@else
    <!-- Tampilkan tautan "Login" jika pengguna belum login -->
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
                        {{-- <img
                          src="/assets/img/front-pages/branding/logo-1.png"
                          alt="client logo"
                          class="client-logo img-fluid" /> --}}
                          @if ($arisan->img_arisan)

                          {{-- <img src="{{ Storage::url($arisan->img_arisan) }}"
                              class="me-3 rounded-circle"
                              width="35"
                              height="35"
                              alt="{{ $arisan->nama_arisan }}"> --}}
                          <img
                          class="object-fit-sm-contain border rounded img-fluid"
                              src="{{ Storage::url($arisan->img_arisan) }}"
                              alt="{{ $arisan->nama_arisan }}"

                              />
                          @else
                          <img src="{{ asset('img/default_arisan.jpg') }}"
                          class="object-fit-sm-contain border rounded img-fluid"
                              alt="client logo" >
                          @endif
                      </div>
                    <h5 class="card-title mb-0">{{ $arisan->nama_arisan }}</h5>
                    <small class="text-muted">
                        @if ($arisan->user)
                                {{ $arisan->user->name }}
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
                            <small>{{ $arisan->start_date }}</small>
                        </div>
                        <div class="col-sm">
                            <small>Selesai</small>
                            <small>{{ $arisan->end_date }}</small>
                            </div>
                        </div>
                    </div>
                    @auth
    @if(auth()->user()->role == 0)
        @if (auth()->user()->active == 1)
        <!-- Tampilkan tautan "Gabung" jika role pengguna adalah 0 -->
        <a href="/list-arisan" class="btn btn-primary w-100 mt-2">Gabung</a>
        @else
        @endif
    @else
        <!-- Nonaktifkan tombol jika role pengguna bukan 0 -->
        {{-- <button class="btn btn-primary w-100 mt-2 disabled hidden" >Gabung</button> --}}
    @endif
@else
    <!-- Tampilkan tautan "Login" jika pengguna belum login -->
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
