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
                {{-- <div class="row mb-3 g-3">
                    <div class="col-6">
                      <div class="d-flex">
                        <div class="avatar flex-shrink-0 me-2">
                          <span class="avatar-initial rounded bg-label-primary"
                            ><i class="ti ti-calendar ti-md"></i
                          ></span>
                        </div>
                        <div>
                          <h6 class="mb-0 text-nowrap" >{{ $arisan->start_date }}</h6>
                          <small>Mulai</small>
                        </div>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="d-flex">
                        <div class="avatar flex-shrink-0 me-2">
                          <span class="avatar-initial rounded bg-label-primary"
                            ><i class="ti ti-calendar-off ti-md"></i
                          ></span>
                        </div>
                        <div>
                            <h6 class="mb-0 text-nowrap" >{{ $arisan->end_date }}</h6>
                          <small>Selesai</small>
                        </div>
                      </div>
                    </div>
                  </div>
                  <a href="{{ route('register.user', ['id_arisan' => $arisan->id_arisan]) }}" class="btn btn-primary w-100">Gabung</a>
                </div> --}}
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
                <a href="{{ route('register.user', ['id_arisan' => $arisan->id_arisan]) }}" class="btn btn-primary w-100 mt-2">Gabung</a>
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
                    {{-- <div class="row mb-3 g-3">
                        <div class="col-6">
                          <div class="d-flex">
                            <div class="avatar flex-shrink-0 me-2">
                              <span class="avatar-initial rounded bg-label-primary"
                                ><i class="ti ti-calendar ti-md"></i
                              ></span>
                            </div>
                            <div>
                              <h6 class="mb-0 text-nowrap" >{{ $arisan->start_date }}</h6>
                              <small>Mulai</small>
                            </div>
                          </div>
                        </div>
                        <div class="col-6">
                          <div class="d-flex">
                            <div class="avatar flex-shrink-0 me-2">
                              <span class="avatar-initial rounded bg-label-primary"
                                ><i class="ti ti-calendar-off ti-md"></i
                              ></span>
                            </div>
                            <div>
                                <h6 class="mb-0 text-nowrap" >{{ $arisan->end_date }}</h6>
                              <small>Selesai</small>
                            </div>
                          </div>
                        </div>
                      </div>
                      <a href="{{ route('register.user', ['id_arisan' => $arisan->id_arisan]) }}" class="btn btn-primary w-100">Gabung</a>
                    </div> --}}
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
                    <a href="{{ route('register.user', ['id_arisan' => $arisan->id_arisan]) }}" class="btn btn-primary w-100 mt-2">Gabung</a>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
          <!-- What people say slider: End -->
        </div>
        </section>
    <!-- Our great team: Start -->
    {{-- <section id="landingTeam" class="section-py landing-team">
      <div class="container">
        <div class="text-center mb-3 pb-1">
          <span class="badge bg-label-primary">Our Great Team</span>
        </div>
        <h3 class="text-center mb-1"><span class="section-title">Supported</span> by Real People</h3>
        <p class="text-center mb-md-5 pb-3">Who is behind these great-looking interfaces?</p>
        <div class="row gy-5 mt-2">
          <div class="col-lg-3 col-sm-6">
            <div class="card mt-3 mt-lg-0 shadow-none">
              <div class="bg-label-primary position-relative team-image-box">
                <img
                  src="/assets/img/front-pages/landing-page/team-member-1.png"
                  class="position-absolute card-img-position bottom-0 start-50 scaleX-n1-rtl"
                  alt="human image" />
              </div>
              <div class="card-body border border-top-0 border-label-primary text-center">
                <h5 class="card-title mb-0">Sophie Gilbert</h5>
                <p class="text-muted mb-0">Project Manager</p>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-sm-6">
            <div class="card mt-3 mt-lg-0 shadow-none">
              <div class="bg-label-info position-relative team-image-box">
                <img
                  src="/assets/img/front-pages/landing-page/team-member-2.png"
                  class="position-absolute card-img-position bottom-0 start-50 scaleX-n1-rtl"
                  alt="human image" />
              </div>
              <div class="card-body border border-top-0 border-label-info text-center">
                <h5 class="card-title mb-0">Paul Miles</h5>
                <p class="text-muted mb-0">UI Designer</p>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-sm-6">
            <div class="card mt-3 mt-lg-0 shadow-none">
              <div class="bg-label-danger position-relative team-image-box">
                <img
                  src="/assets/img/front-pages/landing-page/team-member-3.png"
                  class="position-absolute card-img-position bottom-0 start-50 scaleX-n1-rtl"
                  alt="human image" />
              </div>
              <div class="card-body border border-top-0 border-label-danger text-center">
                <h5 class="card-title mb-0">Nannie Ford</h5>
                <p class="text-muted mb-0">Development Lead</p>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-sm-6">
            <div class="card mt-3 mt-lg-0 shadow-none">
              <div class="bg-label-success position-relative team-image-box">
                <img
                  src="/assets/img/front-pages/landing-page/team-member-4.png"
                  class="position-absolute card-img-position bottom-0 start-50 scaleX-n1-rtl"
                  alt="human image" />
              </div>
              <div class="card-body border border-top-0 border-label-success text-center">
                <h5 class="card-title mb-0">Chris Watkins</h5>
                <p class="text-muted mb-0">Marketing Manager</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section> --}}
    <!-- Our great team: End -->

    <!-- Pricing plans: Start -->
    <section id="landingPricing" class="section-py bg-body landing-pricing">
      <div class="container">
        <div class="text-center mb-3 pb-1">
          <span class="badge bg-label-primary">Pricing Plans</span>
        </div>
        <h3 class="text-center mb-1"><span class="section-title">Tailored pricing plans</span> designed for you</h3>
        <p class="text-center mb-4 pb-3">
          All plans include 40+ advanced tools and features to boost your product.<br />Choose the best plan to fit
          your needs.
        </p>
        <div class="text-center mb-5">
          <div class="position-relative d-inline-block pt-3 pt-md-0">
            <label class="switch switch-primary me-0">
              <span class="switch-label">Pay Monthly</span>
              <input type="checkbox" class="switch-input price-duration-toggler" checked />
              <span class="switch-toggle-slider">
                <span class="switch-on"></span>
                <span class="switch-off"></span>
              </span>
              <span class="switch-label">Pay Annual</span>
            </label>
            <div class="pricing-plans-item position-absolute d-flex">
              <img
                src="/assets/img/front-pages/icons/pricing-plans-arrow.png"
                alt="pricing plans arrow"
                class="scaleX-n1-rtl" />
              <span class="fw-semibold mt-2 ms-1"> Save 25%</span>
            </div>
          </div>
        </div>
        <div class="row gy-4 pt-lg-3">

          <!-- Basic Plan: Start -->
          <div class="col-xl-4 col-lg-6">
            <div class="card">
              <div class="card-header">
                <div class="text-center">
                  <img
                    src="/assets/img/front-pages/icons/paper-airplane.png"
                    alt="paper airplane icon"
                    class="mb-4 pb-2" />
                  <h4 class="mb-1">Basic</h4>
                  <div class="d-flex align-items-center justify-content-center">
                    <span class="price-monthly h1 text-primary fw-bold mb-0">$19</span>
                    <span class="price-yearly h1 text-primary fw-bold mb-0 d-none">$14</span>
                    <sub class="h6 text-muted mb-0 ms-1">/mo</sub>
                  </div>
                  <div class="position-relative pt-2">
                    <div class="price-yearly text-muted price-yearly-toggle d-none">$ 168 / year</div>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <ul class="list-unstyled">
                  <li>
                    <h5>
                      <span class="badge badge-center rounded-pill bg-label-primary p-0 me-2"
                        ><i class="ti ti-check ti-xs"></i
                      ></span>
                      Timeline
                    </h5>
                  </li>
                  <li>
                    <h5>
                      <span class="badge badge-center rounded-pill bg-label-primary p-0 me-2"
                        ><i class="ti ti-check ti-xs"></i
                      ></span>
                      Basic search
                    </h5>
                  </li>
                  <li>
                    <h5>
                      <span class="badge badge-center rounded-pill bg-label-primary p-0 me-2"
                        ><i class="ti ti-check ti-xs"></i
                      ></span>
                      Live chat widget
                    </h5>
                  </li>
                  <li>
                    <h5>
                      <span class="badge badge-center rounded-pill bg-label-primary p-0 me-2"
                        ><i class="ti ti-check ti-xs"></i
                      ></span>
                      Email marketing
                    </h5>
                  </li>
                  <li>
                    <h5>
                      <span class="badge badge-center rounded-pill bg-label-primary p-0 me-2"
                        ><i class="ti ti-check ti-xs"></i
                      ></span>
                      Custom Forms
                    </h5>
                  </li>
                  <li>
                    <h5>
                      <span class="badge badge-center rounded-pill bg-label-primary p-0 me-2"
                        ><i class="ti ti-check ti-xs"></i
                      ></span>
                      Traffic analytics
                    </h5>
                  </li>
                  <li>
                    <h5>
                      <span class="badge badge-center rounded-pill bg-label-primary p-0 me-2"
                        ><i class="ti ti-check ti-xs"></i
                      ></span>
                      Basic Support
                    </h5>
                  </li>
                </ul>
                <div class="d-grid mt-4 pt-3">
                  <a href="payment-page.html" class="btn btn-label-primary">Get Started</a>
                </div>
              </div>
            </div>
          </div>
          <!-- Basic Plan: End -->

          <!-- Favourite Plan: Start -->
          <div class="col-xl-4 col-lg-6">
            <div class="card border border-primary shadow-lg">
              <div class="card-header">
                <div class="text-center">
                  <img src="/assets/img/front-pages/icons/plane.png" alt="plane icon" class="mb-4 pb-2" />
                  <h4 class="mb-1">Team</h4>
                  <div class="d-flex align-items-center justify-content-center">
                    <span class="price-monthly h1 text-primary fw-bold mb-0">$29</span>
                    <span class="price-yearly h1 text-primary fw-bold mb-0 d-none">$22</span>
                    <sub class="h6 text-muted mb-0 ms-1">/mo</sub>
                  </div>
                  <div class="position-relative pt-2">
                    <div class="price-yearly text-muted price-yearly-toggle d-none">$ 264 / year</div>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <ul class="list-unstyled">
                  <li>
                    <h5>
                      <span class="badge badge-center rounded-pill bg-primary p-0 me-2"
                        ><i class="ti ti-check ti-xs"></i
                      ></span>
                      Everything in basic
                    </h5>
                  </li>
                  <li>
                    <h5>
                      <span class="badge badge-center rounded-pill bg-primary p-0 me-2"
                        ><i class="ti ti-check ti-xs"></i
                      ></span>
                      Timeline with database
                    </h5>
                  </li>
                  <li>
                    <h5>
                      <span class="badge badge-center rounded-pill bg-primary p-0 me-2"
                        ><i class="ti ti-check ti-xs"></i
                      ></span>
                      Advanced search
                    </h5>
                  </li>
                  <li>
                    <h5>
                      <span class="badge badge-center rounded-pill bg-primary p-0 me-2"
                        ><i class="ti ti-check ti-xs"></i
                      ></span>
                      Marketing automation
                    </h5>
                  </li>
                  <li>
                    <h5>
                      <span class="badge badge-center rounded-pill bg-primary p-0 me-2"
                        ><i class="ti ti-check ti-xs"></i
                      ></span>
                      Advanced chatbot
                    </h5>
                  </li>
                  <li>
                    <h5>
                      <span class="badge badge-center rounded-pill bg-primary p-0 me-2"
                        ><i class="ti ti-check ti-xs"></i
                      ></span>
                      Campaign management
                    </h5>
                  </li>
                  <li>
                    <h5>
                      <span class="badge badge-center rounded-pill bg-primary p-0 me-2"
                        ><i class="ti ti-check ti-xs"></i
                      ></span>
                      Collaboration tools
                    </h5>
                  </li>
                </ul>
                <div class="d-grid mt-4 pt-3">
                  <a href="payment-page.html" class="btn btn-primary">Get Started</a>
                </div>
              </div>
            </div>
          </div>
          <!-- Favourite Plan: End -->

          <!-- Standard Plan: Start -->
          <div class="col-xl-4 col-lg-6">
            <div class="card">
              <div class="card-header">
                <div class="text-center">
                  <img
                    src="/assets/img/front-pages/icons/shuttle-rocket.png"
                    alt="shuttle rocket icon"
                    class="mb-4 pb-2" />
                  <h4 class="mb-1">Enterprise</h4>
                  <div class="d-flex align-items-center justify-content-center">
                    <span class="price-monthly h1 text-primary fw-bold mb-0">$49</span>
                    <span class="price-yearly h1 text-primary fw-bold mb-0 d-none">$37</span>
                    <sub class="h6 text-muted mb-0 ms-1">/mo</sub>
                  </div>
                  <div class="position-relative pt-2">
                    <div class="price-yearly text-muted price-yearly-toggle d-none">$ 444 / year</div>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <ul class="list-unstyled">
                  <li>
                    <h5>
                      <span class="badge badge-center rounded-pill bg-label-primary p-0 me-2"
                        ><i class="ti ti-check ti-xs"></i
                      ></span>
                      Everything in premium
                    </h5>
                  </li>
                  <li>
                    <h5>
                      <span class="badge badge-center rounded-pill bg-label-primary p-0 me-2"
                        ><i class="ti ti-check ti-xs"></i
                      ></span>
                      Timeline with database
                    </h5>
                  </li>
                  <li>
                    <h5>
                      <span class="badge badge-center rounded-pill bg-label-primary p-0 me-2"
                        ><i class="ti ti-check ti-xs"></i
                      ></span>
                      Fuzzy search
                    </h5>
                  </li>
                  <li>
                    <h5>
                      <span class="badge badge-center rounded-pill bg-label-primary p-0 me-2"
                        ><i class="ti ti-check ti-xs"></i
                      ></span>
                      A/B testing sanbox
                    </h5>
                  </li>
                  <li>
                    <h5>
                      <span class="badge badge-center rounded-pill bg-label-primary p-0 me-2"
                        ><i class="ti ti-check ti-xs"></i
                      ></span>
                      Custom permissions
                    </h5>
                  </li>
                  <li>
                    <h5>
                      <span class="badge badge-center rounded-pill bg-label-primary p-0 me-2"
                        ><i class="ti ti-check ti-xs"></i
                      ></span>
                      Social media automation
                    </h5>
                  </li>
                  <li>
                    <h5>
                      <span class="badge badge-center rounded-pill bg-label-primary p-0 me-2"
                        ><i class="ti ti-check ti-xs"></i
                      ></span>
                      Sales automation tools
                    </h5>
                  </li>
                </ul>
                <div class="d-grid mt-4 pt-3">
                  <a href="payment-page.html" class="btn btn-label-primary">Get Started</a>
                </div>
              </div>
            </div>
          </div>
          <!-- Standard Plan: End -->
        </div>
      </div>
    </section>
    <!-- Pricing plans: End -->

    <!-- Fun facts: Start -->
    <section id="landingFunFacts" class="section-py landing-fun-facts">
      <div class="container">
        <div class="row gy-3">
          <div class="col-sm-6 col-lg-3">
            <div class="card border border-label-primary shadow-none">
              <div class="card-body text-center">
                <img src="/assets/img/front-pages/icons/laptop.png" alt="laptop" class="mb-2" />
                <h5 class="h2 mb-1">7.1k+</h5>
                <p class="fw-medium mb-0">
                  Support Tickets<br />
                  Resolved
                </p>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-3">
            <div class="card border border-label-success shadow-none">
              <div class="card-body text-center">
                <img src="/assets/img/front-pages/icons/user-success.png" alt="laptop" class="mb-2" />
                <h5 class="h2 mb-1">50k+</h5>
                <p class="fw-medium mb-0">
                  Join creatives<br />
                  community
                </p>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-3">
            <div class="card border border-label-info shadow-none">
              <div class="card-body text-center">
                <img src="/assets/img/front-pages/icons/diamond-info.png" alt="laptop" class="mb-2" />
                <h5 class="h2 mb-1">4.8/5</h5>
                <p class="fw-medium mb-0">
                  Highly Rated<br />
                  Products
                </p>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-3">
            <div class="card border border-label-warning shadow-none">
              <div class="card-body text-center">
                <img src="/assets/img/front-pages/icons/check-warning.png" alt="laptop" class="mb-2" />
                <h5 class="h2 mb-1">100%</h5>
                <p class="fw-medium mb-0">
                  Money Back<br />
                  Guarantee
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Fun facts: End -->

    <!-- FAQ: Start -->
    <section id="landingFAQ" class="section-py bg-body landing-faq">
      <div class="container">
        <div class="text-center mb-3 pb-1">
          <span class="badge bg-label-primary">FAQ</span>
        </div>
        <h3 class="text-center mb-1">Frequently asked <span class="section-title">questions</span></h3>
        <p class="text-center mb-5 pb-3">Browse through these FAQs to find answers to commonly asked questions.</p>
        <div class="row gy-5">
          <div class="col-lg-5">
            <div class="text-center">
              <img
                src="/assets/img/front-pages/landing-page/faq-boy-with-logos.png"
                alt="faq boy with logos"
                class="faq-image" />
            </div>
          </div>
          <div class="col-lg-7">
            <div class="accordion" id="accordionExample">
              <div class="card accordion-item active">
                <h2 class="accordion-header" id="headingOne">
                  <button
                    type="button"
                    class="accordion-button"
                    data-bs-toggle="collapse"
                    data-bs-target="#accordionOne"
                    aria-expanded="true"
                    aria-controls="accordionOne">
                    Do you charge for each upgrade?
                  </button>
                </h2>

                <div id="accordionOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                    Lemon drops chocolate cake gummies carrot cake chupa chups muffin topping. Sesame snaps icing
                    marzipan gummi bears macaroon dragée danish caramels powder. Bear claw dragée pastry topping
                    soufflé. Wafer gummi bears marshmallow pastry pie.
                  </div>
                </div>
              </div>
              <div class="card accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                  <button
                    type="button"
                    class="accordion-button collapsed"
                    data-bs-toggle="collapse"
                    data-bs-target="#accordionTwo"
                    aria-expanded="false"
                    aria-controls="accordionTwo">
                    Do I need to purchase a license for each website?
                  </button>
                </h2>
                <div
                  id="accordionTwo"
                  class="accordion-collapse collapse"
                  aria-labelledby="headingTwo"
                  data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                    Dessert ice cream donut oat cake jelly-o pie sugar plum cheesecake. Bear claw dragée oat cake
                    dragée ice cream halvah tootsie roll. Danish cake oat cake pie macaroon tart donut gummies. Jelly
                    beans candy canes carrot cake. Fruitcake chocolate chupa chups.
                  </div>
                </div>
              </div>
              <div class="card accordion-item">
                <h2 class="accordion-header" id="headingThree">
                  <button
                    type="button"
                    class="accordion-button collapsed"
                    data-bs-toggle="collapse"
                    data-bs-target="#accordionThree"
                    aria-expanded="false"
                    aria-controls="accordionThree">
                    What is regular license?
                  </button>
                </h2>
                <div
                  id="accordionThree"
                  class="accordion-collapse collapse"
                  aria-labelledby="headingThree"
                  data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                    Regular license can be used for end products that do not charge users for access or service(access
                    is free and there will be no monthly subscription fee). Single regular license can be used for
                    single end product and end product can be used by you or your client. If you want to sell end
                    product to multiple clients then you will need to purchase separate license for each client. The
                    same rule applies if you want to use the same end product on multiple domains(unique setup). For
                    more info on regular license you can check official description.
                  </div>
                </div>
              </div>
              <div class="card accordion-item">
                <h2 class="accordion-header" id="headingFour">
                  <button
                    type="button"
                    class="accordion-button collapsed"
                    data-bs-toggle="collapse"
                    data-bs-target="#accordionFour"
                    aria-expanded="false"
                    aria-controls="accordionFour">
                    What is extended license?
                  </button>
                </h2>
                <div
                  id="accordionFour"
                  class="accordion-collapse collapse"
                  aria-labelledby="headingFour"
                  data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis et aliquid quaerat possimus maxime!
                    Mollitia reprehenderit neque repellat deleniti delectus architecto dolorum maxime, blanditiis
                    earum ea, incidunt quam possimus cumque.
                  </div>
                </div>
              </div>
              <div class="card accordion-item">
                <h2 class="accordion-header" id="headingFive">
                  <button
                    type="button"
                    class="accordion-button collapsed"
                    data-bs-toggle="collapse"
                    data-bs-target="#accordionFive"
                    aria-expanded="false"
                    aria-controls="accordionFive">
                    Which license is applicable for SASS application?
                  </button>
                </h2>
                <div
                  id="accordionFive"
                  class="accordion-collapse collapse"
                  aria-labelledby="headingFive"
                  data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Sequi molestias exercitationem ab cum
                    nemo facere voluptates veritatis quia, eveniet veniam at et repudiandae mollitia ipsam quasi
                    labore enim architecto non!
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- FAQ: End -->



    <!-- Contact Us: Start -->
    <section id="landingContact" class="section-py bg-body landing-contact">
      <div class="container">
        <div class="text-center mb-3 pb-1">
          <span class="badge bg-label-primary">Contact US</span>
        </div>
        <h3 class="text-center mb-1"><span class="section-title">Let's work</span> together</h3>
        <p class="text-center mb-4 mb-lg-5 pb-md-3">Any question or remark? just write us a message</p>
        <div class="row gy-4">
          <div class="col-lg-5">
            <div class="contact-img-box position-relative border p-2 h-100">
              <img
                src="/assets/img/front-pages/landing-page/contact-customer-service.png"
                alt="contact customer service"
                class="contact-img w-100 scaleX-n1-rtl" />
              <div class="pt-3 px-4 pb-1">
                <div class="row gy-3 gx-md-4">
                  <div class="col-md-6 col-lg-12 col-xl-6">
                    <div class="d-flex align-items-center">
                      <div class="badge bg-label-primary rounded p-2 me-2"><i class="ti ti-mail ti-sm"></i></div>
                      <div>
                        <p class="mb-0">Email</p>
                        <h5 class="mb-0">
                          <a href="mailto:example@gmail.com" class="text-heading">example@gmail.com</a>
                        </h5>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 col-lg-12 col-xl-6">
                    <div class="d-flex align-items-center">
                      <div class="badge bg-label-success rounded p-2 me-2">
                        <i class="ti ti-phone-call ti-sm"></i>
                      </div>
                      <div>
                        <p class="mb-0">Phone</p>
                        <h5 class="mb-0"><a href="tel:+1234-568-963" class="text-heading">+1234 568 963</a></h5>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-7">
            <div class="card">
              <div class="card-body">
                <h4 class="mb-1">Send a message</h4>
                <p class="mb-4">
                  If you would like to discuss anything related to payment, account, licensing,<br
                    class="d-none d-lg-block" />
                  partnerships, or have pre-sales questions, you’re at the right place.
                </p>
                <form>
                  <div class="row g-3">
                    <div class="col-md-6">
                      <label class="form-label" for="contact-form-fullname">Full Name</label>
                      <input type="text" class="form-control" id="contact-form-fullname" placeholder="john" />
                    </div>
                    <div class="col-md-6">
                      <label class="form-label" for="contact-form-email">Email</label>
                      <input
                        type="text"
                        id="contact-form-email"
                        class="form-control"
                        placeholder="johndoe@gmail.com" />
                    </div>
                    <div class="col-12">
                      <label class="form-label" for="contact-form-message">Message</label>
                      <textarea
                        id="contact-form-message"
                        class="form-control"
                        rows="8"
                        placeholder="Write a message"></textarea>
                    </div>
                    <div class="col-12">
                      <button type="submit" class="btn btn-primary">Send inquiry</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Contact Us: End -->
  </div>


  @endsection
