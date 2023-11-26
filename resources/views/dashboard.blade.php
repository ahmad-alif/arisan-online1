@extends('dashboard.index')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Dashboard | Arisanku')
@section('content')


    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-1"> Selamat datang, {{ auth()->user()->name }}👋 </h4>
        @if (session('success'))
            <div class="alert alert-success d-flex align-items-center" role="alert">
                <span class="alert-icon text-success me-2">
                    <i class="ti ti-check ti-xs"></i>
                </span>
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger d-flex align-items-center" role="alert">
                <span class="alert-icon text-danger me-2">
                    <i class="ti ti-ban ti-xs"></i>
                </span>
                {{ session('error') }}
            </div>
        @endif
        <div class="row">
            <div class="col-md-8">
                    @if (auth()->user()->active == 0)
                        @if (auth()->user()->role == 1)
                            <div class="alert bg-label-success">
                                <h6 class="alert-heading mb-1">Verifikasi akun🤔</h6><br>
                                <p class="mb-0">Silahkan verifikasi akun Anda dengan melengkapi data diri.</p>
                                <a href="/verification-account" class="btn btn-sm btn-warning mt-2">Verifikasi Akun</a>
                            </div>
                        @endif
                        @if (auth()->user()->role == 0)
                            <div class="alert bg-label-success">
                                <h6 class="alert-heading mb-1">Verifikasi akun🤔</h6><br>
                                <p class="mb-0">Silahkan verifikasi akun Anda dengan melengkapi data diri.</p>
                                <a href="/verification-account-member" class="btn btn-sm btn-warning mt-2">Verifikasi
                                    Akun</a>
                            </div>
                        @endif
                    @endif
                    @if (auth()->user()->active == 1)
                        @if (auth()->user()->role == 2)
                        <div class="row">
                            <div class="col-sm-6 col-lg-3 mb-4">
                              <div class="card card-border-shadow-primary">
                                <div class="card-body">
                                  <div class="d-flex align-items-center mb-2 pb-1">
                                    <div class="avatar me-2">
                                      <span class="avatar-initial rounded bg-label-primary"><i class="ti ti-browser ti-md"></i></span>
                                    </div>
                                    <h4 class="ms-1 mb-0">{{$totalAllArisan}}</h4>
                                  </div>
                                  <p class="mb-1">Arisan</p>
                                </div>
                              </div>
                            </div>
                            <div class="col-sm-6 col-lg-3 mb-4">
                              <div class="card card-border-shadow-warning">
                                <div class="card-body">
                                  <div class="d-flex align-items-center mb-2 pb-1">
                                    <div class="avatar me-2">
                                      <span class="avatar-initial rounded bg-label-success"
                                        ><i class="ti ti-browser-check ti-md"></i
                                      ></span>
                                    </div>
                                    <h4 class="ms-1 mb-0">{{$totalCompletedArisan}}</h4>
                                  </div>
                                  <p class="mb-1">Selesai</p>
                                </div>
                              </div>
                            </div>
                            <div class="col-sm-6 col-lg-3 mb-4">
                              <div class="card card-border-shadow-danger">
                                <div class="card-body">
                                  <div class="d-flex align-items-center mb-2 pb-1">
                                    <div class="avatar me-2">
                                      <span class="avatar-initial rounded bg-label-danger"
                                        ><i class="ti ti-users ti-md"></i
                                      ></span>
                                    </div>
                                    <h4 class="ms-1 mb-0">{{$totalUsersWithRoleZero}}</h4>
                                  </div>
                                  <p class="mb-1">Pengguna</p>
                                </div>
                              </div>
                            </div>
                            <div class="col-sm-6 col-lg-3 mb-4">
                              <div class="card card-border-shadow-info">
                                <div class="card-body">
                                  <div class="d-flex align-items-center mb-2 pb-1">
                                    <div class="avatar me-2">
                                      <span class="avatar-initial rounded bg-label-info"><i class="ti ti-brand-redhat ti-md"></i></span>
                                    </div>
                                    <h4 class="ms-1 mb-0">{{$totalUsersWithRoleOne}}</h4>
                                  </div>
                                  <p class="mb-1">Pemilik</p>
                                </div>
                              </div>
                            </div>
                          </div>
                        @elseif (auth()->user()->role == 1)
                        <div class="mb-3 col-12 mb-0 d-flex">
                            <div class="col-xl-3 col-md-4 col-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="badge p-2 bg-label-primary mb-2 rounded">
                                            <i class="ti ti-currency-dollar ti-md"></i>
                                        </div>
                                        <h5 class="card-title mb-1 pt-2">Total Arisan</h5>
                                        <p class="mb-2 mt-1">{{ $totalArisan }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-4 col-6 mx-2">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="badge p-2 bg-label-danger mb-2 rounded">
                                            <i class="ti ti-currency-dollar ti-md"></i>
                                        </div>
                                        <h5 class="card-title mb-1 pt-2">Total Member</h5>
                                        <p class="mb-2 mt-1">{{ $totalMember }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
            @if (auth()->user()->active == 1 && auth()->user()->role == 1)
                <div class="col-md-4 mb-2">
                    <div class="col-12 col-xl-12 col-md-6">
                        <div class="card h-100">
                            <div class="card-header d-flex align-items-center justify-content-between">
                                <div class="card-title mb-0">
                                    <h5 class="m-0 me-2">Notifikasi</h5>
                                </div>
                            </div>
                            <div class="table-responsive" style="max-height: 150px; overflow-y: auto;">
                                <table class="table table-borderless border-top">
                                    <thead class="border-bottom">
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="pt-2">
                                                <div class="d-flex justify-content-start align-items-center mt-lg-4">
                                                    <div class="avatar me-3 avatar-sm">
                                                        <img src="../../assets/img/avatars/1.png" alt="Avatar"
                                                            class="rounded-circle" />
                                                    </div>
                                                    <div class="d-flex flex-column">
                                                        <h6 class="mb-0">Maven Analytics</h6>
                                                        <small class="text-truncate text-muted">Business
                                                            Intelligence</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-end pt-2">
                                                <div class="user-progress mt-lg-4">
                                                    <p class="mb-0 fw-medium">33</p>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="pt-2">
                                                <div class="d-flex justify-content-start align-items-center mt-lg-4">
                                                    <div class="avatar me-3 avatar-sm">
                                                        <img src="../../assets/img/avatars/1.png" alt="Avatar"
                                                            class="rounded-circle" />
                                                    </div>
                                                    <div class="d-flex flex-column">
                                                        <h6 class="mb-0">Maven Analytics</h6>
                                                        <small class="text-truncate text-muted">Business
                                                            Intelligence</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-end pt-2">
                                                <div class="user-progress mt-lg-4">
                                                    <p class="mb-0 fw-medium">33</p>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="pt-2">
                                                <div class="d-flex justify-content-start align-items-center mt-lg-4">
                                                    <div class="avatar me-3 avatar-sm">
                                                        <img src="../../assets/img/avatars/1.png" alt="Avatar"
                                                            class="rounded-circle" />
                                                    </div>
                                                    <div class="d-flex flex-column">
                                                        <h6 class="mb-0">Maven Analytics</h6>
                                                        <small class="text-truncate text-muted">Business
                                                            Intelligence</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-end pt-2">
                                                <div class="user-progress mt-lg-4">
                                                    <p class="mb-0 fw-medium">33</p>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="pt-2">
                                                <div class="d-flex justify-content-start align-items-center mt-lg-4">
                                                    <div class="avatar me-3 avatar-sm">
                                                        <img src="../../assets/img/avatars/1.png" alt="Avatar"
                                                            class="rounded-circle" />
                                                    </div>
                                                    <div class="d-flex flex-column">
                                                        <h6 class="mb-0">Maven Analytics</h6>
                                                        <small class="text-truncate text-muted">Business
                                                            Intelligence</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-end pt-2">
                                                <div class="user-progress mt-lg-4">
                                                    <p class="mb-0 fw-medium">33</p>
                                                </div>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        @if (auth()->user()->active == 1 && auth()->user()->role == 1)
            <div class="row p-2">
                <div class="card">
                    <div class="table-responsive text-nowrap">
                        <table class="table text-nowrap">
                            <div class="row p-3">
                                <h5>Arisan Berjalan</h5>
                            </div>
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Gambar Arisan</th>
                                    <th scope="col">Nama Arisan</th>
                                    <th scope="col">Mulai</th>
                                    <th scope="col">Berakhir</th>

                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                @foreach ($arisans as $arisan)
                                    <tr class="align-middles">
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>
                                            @if ($arisan->img_arisan)
                                                <img src="{{ Storage::url($arisan->img_arisan) }}" alt="Arisan"
                                                    class="rounded-circle" width="35" height="35">
                                            @else
                                                <img src="{{ asset('img/default_arisan.jpg') }}" alt="Default Profile"
                                                    class="rounded-circle" width="35" height="35">
                                            @endif
                                        </td>

                                        <td>{{ $arisan->nama_arisan }}</td>
                                        <td>{{ $arisan->start_date }}</td>
                                        <td>{{ $arisan->end_date }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif

        {{-- <div class="col-xl-2 col-md-4 col-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="badge p-2 bg-label-danger mb-2 rounded">
                        <i class="ti ti-currency-dollar ti-md"></i>
                    </div>
                    <h5 class="card-title mb-1 pt-2">Total Arisan</h5>
                    <p class="mb-2 mt-1">1.28k</p>
                </div>
            </div>
        </div> --}}
    </div>

@endsection
