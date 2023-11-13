@extends('layouts.app')

@section('container')
    @include('layouts.navbar')
    @include('layouts.sidebar')

    <main id="main" class="main">
        <div class="pagetitle border-bottom">
            <h1>Detail Arisan: {{ $arisan->nama_arisan }}</h1>
        </div><!-- End Page Title -->

        <!-- Display Arisan details here -->
        <div class="card">
            <!-- Add details you want to display -->
            <div class="card-body">
                <div class="text-center">
                    @if ($arisan->img_arisan)
                        <img src="{{ Storage::url($arisan->img_arisan) }}" class="card-img-top mt-2"
                            alt="{{ $arisan->nama_arisan }}" style="max-width: 30%; height: auto;">
                    @else
                        <img src="{{ asset('img/default_arisan.jpg') }}" class="card-img-top" alt="Default Image"
                            style="max-width: 30%; height: auto;">
                    @endif
                </div>
                <h5 class="card-title">{{ $arisan->nama_arisan }}</h5>
                <p class="card-text">Deskripsi: {{ $arisan->deskripsi }}</p>
                <p class="card-text">Start Date: {{ $arisan->start_date }}</p>
                <p class="card-text">End Date: {{ $arisan->end_date }}</p>
                <p class="card-text">Max Member: {{ $arisan->max_member }}</p>
                <p class="card-text">Deposit Frequency: {{ $arisan->deposit_frequency }}</p>
                <p class="card-text">Payment Amount: {{ $arisan->payment_amount }}</p>
                <p class="card-text">Status: {{ $arisan->status }}</p>
            </div>
        </div>
    </main>
    @include('layouts.footer')

    </html>
