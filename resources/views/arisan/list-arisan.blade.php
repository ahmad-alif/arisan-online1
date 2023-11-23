@extends('dashboard.index')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Join Arisan | Arisanku')
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
                            Total {{ $jumlahArisan }} arisan
                        </p>
                    </div>
                    <div class="d-flex align-items-center justify-content-between app-academy-md-80">
                        <input type="search" class="form-control me-1" name="search" value="{{ request('search') }}"
                            placeholder="Cari member...">
                        <button type="submit" class="btn btn-primary btn-icon"><i class="ti ti-search"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row gy-4 mb-4">

                        @if ($arisans->count() > 0)
                            @foreach ($arisans as $arisan)
                                {{-- <div class="col-md-4">
                                    <div class="card">
                                        @if ($arisan->img_arisan)
                                            <img src="{{ Storage::url($arisan->img_arisan) }}" class="card-img-top"
                                                alt="{{ $arisan->nama_arisan }}">
                                        @else
                                            <img src="{{ asset('img/default_arisan.jpg') }}" class="card-img-top"
                                                alt="Default Image">
                                        @endif
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $arisan->nama_arisan }}</h5>
                                            <p class="card-text">Start Date: {{ $arisan->start_date }}</p>
                                            <p class="card-text">End Date: {{ $arisan->end_date }}</p>
                                            <form action="{{ route('arisan.join', $arisan) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-primary">Join</button>
                                            </form>
                                        </div>
                                    </div>
                                </div> --}}
                                {{-- <div class="card h-100 m-1">
                                    <div class="card-body">
                                      <div class="bg-label-primary rounded-3 text-center mb-3 pt-4">
                                        <img
                                          class="img-fluid"
                                          src="../../assets/img/illustrations/girl-with-laptop.png"
                                          alt="Card girl image"
                                          width="140" />
                                      </div>
                                      <h4 class="mb-2 pb-1">Upcoming Webinar</h4>
                                      <p class="small">
                                        Next Generation Frontend Architecture Using Layout Engine And React Native Web.
                                      </p>
                                      <div class="row mb-3 g-3">
                                        <div class="col-6">
                                          <div class="d-flex">
                                            <div class="avatar flex-shrink-0 me-2">
                                              <span class="avatar-initial rounded bg-label-primary"
                                                ><i class="ti ti-calendar-event ti-md"></i
                                              ></span>
                                            </div>
                                            <div>
                                              <h6 class="mb-0 text-nowrap">17 Nov 23</h6>
                                              <small>Date</small>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-6">
                                          <div class="d-flex">
                                            <div class="avatar flex-shrink-0 me-2">
                                              <span class="avatar-initial rounded bg-label-primary"
                                                ><i class="ti ti-clock ti-md"></i
                                              ></span>
                                            </div>
                                            <div>
                                              <h6 class="mb-0 text-nowrap">32 minutes</h6>
                                              <small>Duration</small>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <a href="javascript:void(0);" class="btn btn-primary w-100">Join the event</a>
                                    </div>
                                </div> --}}
                                <div class="col-sm-6 col-lg-4">
                                    <div class="card p-2 h-100 shadow-none border">
                                        <div class="rounded-2 text-center mb-3 mt-3">
                                            @if ($arisan->img_arisan)
                                                <img class="img-fluid" src="{{ Storage::url($arisan->img_arisan) }}"
                                                    alt="{{ $arisan->nama_arisan }}" width="200" height="200" />
                                            @else
                                                <img src="{{ asset('img/default_arisan.jpg') }}" class="img-fluid"
                                                    alt="Default Image" width="200" height="200">
                                            @endif

                                        </div>
                                        <div class="card-body p-3 pt-2">
                                            {{-- <div class="d-flex justify-content-between align-items-center mb-3">
                                        <span class="badge bg-label-primary">Web</span>
                                        <h6 class="d-flex align-items-center justify-content-center gap-1 mb-0">
                                          4.4 <span class="text-warning"><i class="ti ti-star-filled me-1 mt-n1"></i></span
                                          ><span class="text-muted">(1.23k)</span>
                                        </h6>
                                      </div> --}}
                                            <a href="app-academy-course-details.html"
                                                class="h5">{{ $arisan->nama_arisan }}</a>
                                            <p class="mt-2">{{ $arisan->deskripsi }}</p>
                                            <div class="row mb-2 g-2">
                                                <div class="col-6">
                                                    {{-- <p class="d-flex align-items-center"><i class="ti ti-calendar me-2 mt-n1"></i>{{ $arisan->start_date }}</p> --}}
                                                    <div class="d-flex">
                                                        <div class="avatar flex-shrink-0 me-2">
                                                            <span class="avatar-initial rounded bg-label-primary"><i
                                                                    class="ti ti-calendar ti-md"></i></span>
                                                        </div>
                                                        <div>
                                                            <small>Mulai</small>
                                                            <h6 class="mb-0 text-nowrap">{{ $arisan->start_date }}</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    {{-- <p class="d-flex align-items-center"><i class="ti ti-calendar-off me-2 mt-n1"></i>{{ $arisan->end_date }}</p> --}}
                                                    <div class="d-flex">
                                                        <div class="avatar flex-shrink-0 me-2">
                                                            <span class="avatar-initial rounded bg-label-primary"><i
                                                                    class="ti ti-calendar-off ti-md"></i></span>
                                                        </div>
                                                        <div>
                                                            <small>Selesai</small>
                                                            <h6 class="mb-0 text-nowrap">{{ $arisan->end_date }}</h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <form action="{{ route('arisan.join', $arisan) }}" method="POST">
                                                @csrf
                                                {{-- <button type="submit" class="btn btn-primary w-100">Gabung</button> --}}
                                                <div class="d-flex flex-column flex-md-row gap-2 text-nowrap">
                                                    @if ($arisan->isUserJoined(auth()->user()))
                                                        <button type="submit"
                                                            class="btn btn-primary w-50 disabled">Gabung<i
                                                                class="ti ti-chevron-right align-middle scaleX-n1-rtl me-2 mt-n1 ti-sm"></i></button>
                                                        @if (auth()->user()->role == 1)
                                                            <a class="app-academy-md-50 btn btn-label me-md-2 d-flex align-items-center w-50"
                                                                href="{{ route('arisan.detail', $arisan) }}">
                                                                <span class="me-2">Detail</span>
                                                                <i
                                                                    class="ti ti-info-small align-middle scaleX-n1-rtl me-2 mt-n1 ti-sm"></i>
                                                            </a>
                                                        @elseif (auth()->user()->role == 0)
                                                            <a class="app-academy-md-50 btn btn-label me-md-2 d-flex align-items-center w-50"
                                                                href="{{ route('arisan.detail.member', $arisan) }}">
                                                                <span class="me-2">Detail</span>
                                                                <i
                                                                    class="ti ti-info-small align-middle scaleX-n1-rtl me-2 mt-n1 ti-sm"></i>
                                                            </a>
                                                        @endif
                                                    @else
                                                        @csrf
                                                        <button type="submit" class="btn btn-primary w-50">Gabung<i
                                                                class="ti ti-chevron-right align-middle scaleX-n1-rtl me-2 mt-n1 ti-sm"></i></button>
                                                        {{-- <a
                                                      class="app-academy-md-50 btn btn-label-primary d-flex w-50 align-items-center"
                                                      type="submit">
                                                      <span class="me-2">Gabung</span
                                                      ><i class="ti ti-chevron-right scaleX-n1-rtl ti-sm"></i>
                                                    </a> --}}
                                                    @endif
                                                </div>
                                            </form>

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
