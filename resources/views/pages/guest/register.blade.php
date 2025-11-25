@extends('layouts.guest')

@section('title', 'Selamat Datang di Mie Sabi')

@section('section')
    <div style="min-height: calc(100dvh - 3.5rem);" class="container d-flex align-items-center justify-content-center p-4">
        <form method="post" action="{{ route('register.process') }}" style="max-width: 600px;" class="row bg-yellow-400 g-3 p-3 rounded shadow">
            @csrf
            <div class="col-md-6">
                <label for="name" class="form-label text-yellow-900">Full Name</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="col-md-6">
                <label for="username" class="form-label text-yellow-900">username</label>
                <input type="text" class="form-control" id="username" name="username">
            </div>
            <div class="col-md-6">
                <label for="email" class="form-label text-yellow-900">Email</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="col-md-6">
                <label for="phone" class="form-label text-yellow-900">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone">
            </div>
            <div class="col-md-6">
                <label for="password" class="form-label text-yellow-900">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="col-md-6">
                <label for="password_confirmation" class="form-label text-yellow-900">Confirm Password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
            </div>
            <div class="col-12">
                <button type="submit" class="bg-yellow-600 border-0 rounded py-2 text-white w-100">Register</button>
            </div>
        </form>
    </div>
@endsection
