@extends('layouts.app')

@section('container')
    @include('layouts.navbar')
    @include('layouts.sidebar')

    <main id="main" class="main">

        <div class="pagetitle border-bottom">
            <h1>List Arisan</h1>
        </div><!-- End Page Title -->

        <form action="{{ route('list-arisan.search') }}" method="GET">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Cari arisan..." name="search"
                    value="{{ $search }}">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">Cari</button>
                </div>
            </div>
        </form>

        <section class="section dashboard">
            <div class="row">
                <div class="row">
                    @if ($arisans->count() > 0)
                        @foreach ($arisans as $arisan)
                            <div class="col-md-4">
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
                            </div>
                        @endforeach
                    @else
                        <div class="col-md-12">
                            <p>Tidak ada hasil ditemukan.</p>
                        </div>
                    @endif
                </div>
            </div>
        </section>
        <div class="pagination mb-5 d-flex justify-content-center">
            {{ $arisans->links() }}
        </div>
    </main>
    @include('layouts.footer')

    </html>
