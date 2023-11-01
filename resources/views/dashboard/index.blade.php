@extends('layouts.app')

@section('container')
    @include('layouts.navbar')
    @include('layouts.sidebar')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (Auth::user()->role == 2)
                            <p>Welcome to the Admin Dashboard!</p>
                        @elseif (Auth::user()->role == 1)
                            <p>Welcome to the Owner Dashboard!</p>
                        @elseif (Auth::user()->role == 0)
                            <p>Welcome to the User Dashboard!</p>
                        @else
                            <p>Welcome to the Dashboard!</p>
                        @endif

                        <!-- Tambahkan konten dashboard sesuai kebutuhan -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footer')
@endsection
