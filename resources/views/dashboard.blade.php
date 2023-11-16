@extends('dashboard.index')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Dashboard')
@section('content')


    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-1"> Selamat datang, {{ auth()->user()->name }}👋 </h4>
        <div class="mb-3 col-12 mb-0 d-flex">
            @if (auth()->user()->active == 1)
                @if (Auth::user()->role == 2)

                @else
                    <div class="alert bg-label-success">
                    <p class="mb-0">Akun anda telah aktif😁</p>
                    </div>
                @endif
            @else
                <div class="alert bg-label-success">
                    <h6 class="alert-heading mb-1">Verifikasi akun🤔</h6>
                    <p class="mb-0">Silahkan verifikasi akun Anda dengan melengkapi data diri.</p>
                </div>
            @endif
        </div>
    </div>

@endsection
