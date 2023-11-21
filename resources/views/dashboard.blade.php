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
        <div class="mb-3 col-12 mb-0 d-flex">
            @if (auth()->user()->active == 1)
                @if (Auth::user()->role == 2)
                @else
                    <div class="alert bg-label-success">
                        <p class="mb-0">Akun anda telah aktif😁</p>
                    </div>
                @endif
            @endif
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
                        <a href="/verification-account-member" class="btn btn-sm btn-warning mt-2">Verifikasi Akun</a>
                    </div>
                @endif
            @endif

        </div>
    </div>

@endsection
