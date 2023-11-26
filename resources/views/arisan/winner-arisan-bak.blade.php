<!-- resources/views/dashboard/draw-winner.blade.php -->

@extends('dashboard.index')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Undian Arisan')
@section('content')

    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-1">
                <span class="text-muted fw-light">
                    @if (Auth::user()->role == 2)
                        Admin /
                    @elseif (Auth::user()->role == 1)
                        Owner /
                    @elseif (Auth::user()->role == 0)
                        Pengguna /
                    @endif
                </span> Undian Arisan - {{ $arisan->nama_arisan }}
            </h4>

            <div class="card-body">
                <form method="POST" action="{{ route('draw-winner', ['uuid' => $arisan->uuid]) }}">
                    @csrf
                    <div class="mb-3">
                        <label for="winner" class="form-label">Undian Arisan {{ $arisan->nama_arisan }}</label>
                        <input type="text" class="form-control" id="winner" name="winner"
                            value="{{ $selectedWinner->name }}" readonly>
                        <input type="hidden" name="winner_id" value="{{ $selectedWinner->id }}">
                        <input type="hidden" name="remaining_users" value="{{ $remainingUsers }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Undi Sekarang!</button>
                </form>
            </div>

        </div>
    </div>
@endsection
