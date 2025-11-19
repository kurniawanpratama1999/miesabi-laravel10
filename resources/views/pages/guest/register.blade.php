@extends('layouts.guest')

@section('title', 'Selamat Datang di Mie Sabi')

@section('section')
<main class="bg-body-secondary">
    <div style="min-height: calc(100dvh - 3.5rem);" class="container d-flex align-items-center justify-content-center p-4">
        <form method="post" action="{{ route('register.process') }}" style="max-width: 600px;" class="row g-3 bg-white p-3 rounded shadow">
            @csrf
            <div class="col-md-6">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="col-md-6">
                <label for="username" class="form-label">username</label>
                <input type="text" class="form-control" id="username" name="username">
            </div>
            <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="col-md-6">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone">
            </div>
            <div class="col-md-6">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="col-md-6">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary w-100">Register</button>
            </div>
        </form>
    </div>
</main>
@endsection