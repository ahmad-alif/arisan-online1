@extends('layouts.app')

@section('container')
    @include('layouts.navbar')
    @include('layouts.sidebar')

    <main id="main" class="main">

        <div class="pagetitle border-bottom">
            <h1>Dashboard</h1>
            <p class="mt-1">Welcome back, {{ auth()->user()->name }}</p>


        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">
                @if (auth()->user()->active == 1)
                    <p>Akun telah aktif.</p>
                @else
                    <div class="card">
                        <div class="card-header">Verifikasi Akun</div>

                        <div class="card-body">
                            <p>Silahkan verifikasi akun Anda dengan melengkapi data diri.</p>
                            <a href="/verification-account" class="btn btn-primary">Verifikasi Data</a>
                        </div>
                    </div>
                @endif
            </div>
        </section>

    </main>
    @include('layouts.footer')
@endsection
