@extends('dashboard.index')

@section('container')
    @include('layouts.navbar')
    @include('layouts.sidebar')
    @include('layouts.footer')
@endsection

@section('content')
<main id="main" class="main">

    <!-- Content wrapper -->
    <div class="content-wrapper">
      <!-- Content -->

      <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">
            @if (Auth::user()->role == 2)
            Admin /
            @elseif (Auth::user()->role == 1)
            Owner /
            @elseif (Auth::user()->role == 0)
            Pengguna /
            @endif
        </span> Pengaturan Akun</h4>

        <div class="row">
          <div class="col-md-12">
            {{-- <ul class="nav nav-pills flex-column flex-md-row mb-4">
              <li class="nav-item">
                <a class="nav-link active" href="javascript:void(0);"
                  ><i class="ti-xs ti ti-users me-1"></i> Account</a
                >
              </li>
              <li class="nav-item">
                <a class="nav-link" href="pages-account-settings-security.html"
                  ><i class="ti-xs ti ti-lock me-1"></i> Security</a
                >
              </li>
              <li class="nav-item">
                <a class="nav-link" href="pages-account-settings-billing.html"
                  ><i class="ti-xs ti ti-file-description me-1"></i> Billing & Plans</a
                >
              </li>
              <li class="nav-item">
                <a class="nav-link" href="pages-account-settings-notifications.html"
                  ><i class="ti-xs ti ti-bell me-1"></i> Notifications</a
                >
              </li>
              <li class="nav-item">
                <a class="nav-link" href="pages-account-settings-connections.html"
                  ><i class="ti-xs ti ti-link me-1"></i> Connections</a
                >
              </li>
            </ul> --}}
            <div class="card mb-4">
              <h5 class="card-header">Detail Profil</h5>
              <!-- Account -->
              <div class="card-body">
                <div class="d-flex align-items-start align-items-sm-center gap-4">
                    @if (auth()->user()->foto_profil)
                    <img src="{{ Storage::url(auth()->user()->foto_profil) }}" alt="Profile"
                        class="d-block w-px-100 h-px-100 rounded" id="uploadedAvatar" />
                @else
                    <img src="{{ asset('img/default.png') }}" alt="DefualtProfile"
                        class="d-block w-px-100 h-px-100 rounded" id="uploadedAvatar" />
                @endif

                <form method="POST" action="{{ route('update-pict') }}" enctype="multipart/form-data">
                @csrf
                  <div class="button-wrapper">
                    <label for="upload" class="btn btn-primary me-2 mb-3" tabindex="0">
                      <span class="d-none d-sm-block">Unggah foto baru</span>
                      <i class="ti ti-upload d-block d-sm-none"></i>
                            <input
                              type="file"
                              id="upload"
                              name="foto_profil"
                              class="account-file-input"
                              hidden
                              accept="image/png, image/jpg, image/jpeg" />
                    </label>

                    <div class="text-muted">Format JPG, GIF atau PNG. Ukuran Max 800kb</div>
                  </div>
                </form>
                </div>
              </div>
              <hr class="my-0" />
              <div class="card-body">
                <form id="formAccountSettings" method="POST" enctype="multipart/form-data" action="{{ route('processAccountSetting') }}" novalidate>
                    @csrf
                  <div class="row">
                    <div class="mb-3 col-md-6">
                      <label for="inputText" class="form-label">Nama</label>
                      <input
                        class="form-control"
                        type="text"
                        id="name"
                        name="name"
                        value="{{ auth()->user()->name }}"
                        autofocus
                        required />
                    </div>
                    <div class="mb-3 col-md-6">
                      <label for="inputUsername" class="form-label">Username</label>
                      <input class="form-control" type="text" name="username" id="username" value="{{ auth()->user()->username }}" required disabled/>
                    </div>
                    <div class="mb-3 col-md-6">
                      <label for="inputEmail" class="form-label">E-mail</label>
                      <input
                        class="form-control"
                        type="text"
                        id="email"
                        name="email"
                        value="{{ auth()->user()->email }}" required disabled/>
                    </div>
                    <div class="mb-3 col-md-6">
                      <label for="organization" class="form-label">No. Telpon</label>
                      <input
                        type="number"
                        class="form-control"
                        id="nohp"
                        name="nohp"
                        value="{{ auth()->user()->nohp }}" required disabled/>
                    </div>
                  </div>
                  <div class="mt-2">
                    <button type="submit" class="btn btn-primary me-2">Simpan perubahan</button>
                    <button type="reset" class="btn btn-label-secondary">Batal</button>
                  </div>
                </form>
              </div>
              <!-- /Account -->
            </div>
             <div class="card">
              <h5 class="card-header">Hapus Akun</h5>
              <div class="card-body">
                <div class="mb-3 col-12 mb-0">
                  <div class="alert alert-warning">
                    <h5 class="alert-heading mb-1">apa kamu yakin mengajukan penghapusan akun?🤔</h5>
                    <p class="mb-0">*akun yang dihapus tidak dapat dikembalikan</p>
                  </div>
                </div>
                <form id="formAccountDeactivation" onsubmit="return false">
                  <div class="form-check mb-4">
                    <input
                      class="form-check-input"
                      type="checkbox"
                      name="accountActivation"
                      id="accountActivation" />
                    <label class="form-check-label" for="accountActivation"
                      >Saya menyetujui penghapusan akun</label
                    >
                  </div>
                  <button type="submit" class="btn btn-danger deactivate-account">Ajukan Penghapusan</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- / Content -->

      <div class="content-backdrop fade"></div>
    </div>
    <!-- Content wrapper -->

</main>
@endsection
