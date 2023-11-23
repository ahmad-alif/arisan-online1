@extends('dashboard.index')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Profil')
@section('content')

    <!-- Striped Rows -->
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">


            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="user-profile-header-banner">
                            <img src="../../assets/img/pages/profile-banner.png" alt="Banner image"
                                class="rounded-top w-100" />
                        </div>
                        <div class="mt-3">
                            <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
                                <div class="flex-shrink-0 mt-n0 mx-sm-0 mx-auto">
                                    @if (auth()->user()->foto_profil)
                                        <img src="{{ Storage::url(auth()->user()->foto_profil) }}" alt="user image"
                                            class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img" width="100px" />
                                    @else
                                        <img src="{{ asset('img/default.png') }}" alt="default user image"
                                            class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img" width="100px" />
                                    @endif
                                </div>
                                <div class="flex-grow-1 mt-3 mt-sm-3">
                                    <div
                                        class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
                                        <div class="user-profile-info">
                                            <h4>{{ auth()->user()->name }}</h4>
                                            <ul
                                                class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                                                <li class="list-inline-item d-flex gap-1">
                                                    Bergabung semenjak
                                                    {{ auth()->user()->created_at->locale('id')->isoFormat('D MMMM Y') }}
                                                </li>
                                            </ul>
                                        </div>
                                        {{-- <a href="javascript:void(0)" class="btn btn-primary">
                                        <i class="ti ti-check me-1"></i>Connected
                                    </a> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 col-lg-5 col-md-5">
                    <!-- About User -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <small class="card-text text-uppercase">Profil Saya</small>
                                <a href="/profile/ubah-profile"><i class="ti ti-settings me-2 ti-sm"></i></a>
                            </div>
                            <div class="mt-3">

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="d-flex align-items-center mb-3">
                                            <i class="ti ti-user text-heading"></i>
                                            <span class="fw-medium mx-2 text-heading">Nama Lengkap</span>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="d-flex align-items-center mb-3">
                                            <span>{{ auth()->user()->name }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="d-flex align-items-center mb-3">
                                            <i class="ti ti-check text-heading"></i>
                                            <span class="fw-medium mx-2 text-heading">Username</span>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="d-flex align-items-center mb-3">
                                            <span>{{ auth()->user()->username }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="d-flex align-items-center mb-3">
                                            <i class="ti ti-mail"></i>
                                            <span class="fw-medium mx-2 text-heading">Email</span>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="d-flex align-items-center mb-3">
                                            <span>{{ auth()->user()->email }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="d-flex align-items-center mb-3">
                                            <i class="ti ti-phone-call"></i>
                                            <span class="fw-medium mx-2 text-heading">No HP</span>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="d-flex align-items-center mb-3">
                                            <span>{{ auth()->user()->nohp }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>

                    <!--/ About User -->
                </div>

            </div>

        </div>
    </div>

@endsection
