@extends('layout')

@section('title', 'Selamat Datang di Mie Sabi')

@section('content')
    <div style="min-height: calc(100dvh - 3.5rem);" class="container d-flex align-items-center justify-content-center p-4">
        <form method="post" action="{{ route('register.process') }}" style="max-width: 600px;" class="row bg-yellow-200 g-3 p-3 rounded shadow">
            @csrf
            <div class="col-md-6">
                <x-form-input idprop="name" labelprop="name" typeprop="text"/>
            </div>
            <div class="col-md-6">
                <x-form-input idprop="username" labelprop="username" typeprop="text"/>
            </div>
            <div class="col-md-6">
                <x-form-input idprop="email" labelprop="email" typeprop="email"/>
            </div>
            <div class="col-md-6">
                <x-form-input idprop="phone" labelprop="phone" typeprop="text"/>
            </div>
            <div class="col-md-6">
                <x-form-input idprop="password" labelprop="password" typeprop="password"/>
            </div>
            <div class="col-md-6">
                <x-form-input idprop="password_confirmation" labelprop="password confirmation" typeprop="password"/>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-warning w-100">Register</button>
            </div>
        </form>
    </div>
@endsection
