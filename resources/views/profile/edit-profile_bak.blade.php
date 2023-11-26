@extends('dashboard.index')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Ubah Kata Sandi')
@section('content')

    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">


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

            <div class="row">
                <div class="col-xl-12 col-lg-5 col-md-5">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="card-body">
                                <form id="formAccountSettings" enctype="multipart/form-data" method="POST"
                                    action="{{ route('update-profile') }}">
                                    @csrf
                                    <h4 class="card-text">Ubah Profil</h4>
                                    <div class="row">
                                        <div class="mb-3 col-md-12">
                                            <label for="name" class="form-label">Nama Lengkap</label>
                                            <input class="form-control" type="text" id="name" name="name"
                                                autofocus value="{{ auth()->user()->name }}" />
                                        </div>

                                        <div class="mb-3 col-md-12">
                                            <label for="username" class="form-label">Nama Lengkap</label>
                                            <input class="form-control" type="text" id="username" name="username"
                                                autofocus value="{{ auth()->user()->username }}" disabled />
                                        </div>

                                        <div class="mb-3 col-md-12">
                                            <label for="email" class="form-label">Nama Lengkap</label>
                                            <input class="form-control" type="text" id="email" name="email"
                                                autofocus value="{{ auth()->user()->email }}" disabled />
                                        </div>

                                    </div>
                                    <div class="mt-2">
                                        <button type="submit" class="btn btn-primary me-2">Save changes</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>


                </div>


            </div>

        </div>
    </div>
@endsection
