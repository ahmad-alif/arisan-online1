@extends('dashboard.index')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Kelola Notifikasi')
@section('content')

    <!-- Striped Rows -->
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-1"><span class="text-muted fw-light">Admin /</span> Kelola Notifikasi</h4>

            <div class="card">
                <div class="card-body">
                    <form id="addNotifikasiForm" enctype="multipart/form-data" method="post"
                        action="{{ route('processNotifikasi') }}">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="judul" class="form-label">Judul</label>
                                <input
                                    class="form-control @error('judul')
                                is-invalid
                                @enderror"
                                    type="text" id="judul" name="judul" placeholder="Masukan judul"
                                    value="{{ old('judul') }}" autofocus required />
                                @error('judul')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            {{-- <div class="mb-3 col-md-6">
                                <label for="slug" class="form-label">Slug</label>
                                <input
                                    class="form-control @error('slug')
                                is-invalid
                                @enderror"
                                    type="text" id="slug" name="slug" value="{{ old('slug') }}" disabled
                                    readonly required />
                                @error('slug')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div> --}}
                            <div class="mb-3 col-md-6">
                                <label for="slug" class="form-label">Slug</label>
                                <input class="form-control" type="text" id="slug" name="slug"
                                    value="{{ old('slug') }}" readonly required />
                                @error('slug')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="form-label" for="isi">Pesan</label>
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-message2" class="input-group-text"><i
                                            class="ti ti-message-dots"></i></span>
                                    <textarea id="isi" class="form-control" placeholder="Tuliskan pesan disini..."
                                        aria-label="Tuliskan pesan disini..." name="isi" rows="3" aria-describedby="basic-icon-default-message2"></textarea>
                                </div>
                            </div>

                            {{-- <div class="col-md-6 mb-4">
                                <label for="owner" class="form-label">Pilih Owner</label>
                                <input id="owner" class="form-control typeahead" name="owner" type="text"
                                    autocomplete="off" placeholder="Pilih owner disini..." />
                            </div> --}}
                            <div class="col-md-6 mb-4">
                                <label for="owner" class="form-label">Pilih Owner</label>
                                <select class="form-select" id="owner" aria-label="Default select example"
                                    name="owner">
                                    <option selected disabled>Pilih owner disini...</option>
                                    @foreach ($usernames as $username)
                                        <option value="{{ $username }}">{{ $username }}</option>
                                    @endforeach
                                </select>
                            </div>



                        </div>
                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary me-2">Simpan</button>
                            <button type="reset" class="btn btn-label-secondary">Batal</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <!--/ Responsive Table -->
    </div>
    <!-- / Content -->

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
