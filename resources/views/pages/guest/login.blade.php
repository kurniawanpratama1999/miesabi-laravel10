@extends('layout')

@section('title', 'Selamat Datang di Mie Sabi')

@section('content')
    <div style="min-height: calc(100dvh - 3.5rem);" class="container d-flex align-items-center justify-content-center">
        <div class="row mx-auto">
            <form method="POST" action="{{ route('login.process') }}" class="col-12 col-lg-7 mx-auto row g-3 bg-yellow-200 p-3 rounded shadow">
                @csrf
                <div class="col-md-12">
                    <x-form-input idprop="email" labelprop="Email" typeprop="email" :model="null" />
                </div>
                <div class="col-md-12">
                    <x-form-input idprop="password" labelprop="Password" typeprop="password" :model="null" />
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-warning w-100">Sign in</button>
                </div>
            </form>
        </div>
    </div>
@endsection
