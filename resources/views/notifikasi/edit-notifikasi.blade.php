@extends('dashboard.index')

@section('pageTitle', 'Edit Notifikasi')

@section('content')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-1"><span class="text-muted fw-light">Admin /</span> Edit Notifikasi</h4>

            @if (session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('processEditNotifikasi', ['slug' => $notification->slug]) }}">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="judul" class="form-label">Judul</label>
                                <input type="text" class="form-control @error('judul') is-invalid @enderror"
                                    id="judul" name="judul" value="{{ $notification->judul }}" autofocus required>
                                @error('judul')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="slug" class="form-label">Slug</label>
                                <input class="form-control" type="text" id="slug" name="slug"
                                    value="{{ $notification->slug }}" readonly required disabled />
                                @error('slug')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="form-label" for="isi">Pesan</label>
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-message2" class="input-group-text"><i
                                            class="ti ti-message-dots"></i></span>
                                    <textarea id="isi" class="form-control" name="isi" rows="3" required>{{ $notification->isi }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label for="owner" class="form-label">Pilih Owner</label>
                                <select class="form-select" id="owner" name="owner" required>
                                    @foreach ($usernames as $username)
                                        <option value="{{ $username }}"
                                            @if ($notification->user->username === $username) selected @endif>
                                            {{ $username }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary me-2">Simpan</button>
                            <a href="{{ route('notifikasi') }}" class="btn btn-label-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const judulInput = document.getElementById('judul');
            const slugInput = document.getElementById('slug');

            judulInput.addEventListener('input', function() {
                const judulValue = judulInput.value.trim().toLowerCase().replace(/\s+/g, '-');
                slugInput.value = judulValue;
            });
        });
    </script>
@endsection
