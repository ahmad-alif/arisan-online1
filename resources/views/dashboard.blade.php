@extends('dashboard.index')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Dashboard')
@section('content')


    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"> Selamat datang, {{ auth()->user()->name }}👋 </h4>
    </div>

@endsection
