<!-- resources/views/auth/register.blade.php -->

<!-- Formulir registrasi -->
@extends('layouts.auth-main')
@section('container')
    {{-- <form method="POST" action="{{ route('register.selectRole') }}">
        @csrf
        <button type="submit" name="role" value="owner">Daftar Sebagai Pemilik Arisan</button>
        <button type="submit" name="role" value="user">Daftar Sebagai Member</button>

    </form> --}}
    <main>
        <div class="container">

            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                            <div class="d-flex justify-content-center py-4">
                                <a href="index.html" class="logo d-flex align-items-center w-auto">
                                    <img src="/img/logo.png" alt="">
                                </a>
                            </div>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Pilih Role Anda</h5>
                                        <hr class="bg-primary">
                                    </div>

                                    <form class="row g-3 needs-validation" method="POST"
                                        action="{{ route('register.selectRole') }}">
                                        @csrf
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary w-100" name="role"
                                                value="owner">Daftar Sebagai Pemilik
                                                Arisan</button>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-success w-100" name="role"
                                                value="user">Daftar Sebagai
                                                Member</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </section>

        </div>
    </main>
@endsection
