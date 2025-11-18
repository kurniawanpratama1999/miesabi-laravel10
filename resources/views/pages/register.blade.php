@extends('layouts.guest')

@section('title', 'Selamat Datang di Mie Sabi')

@section('section')
<main class="bg-body-secondary">
    <div style="min-height: calc(100dvh - 3.5rem);" class="container d-flex align-items-center justify-content-center p-4">
        <form style="max-width: 300px;" class="row g-3 bg-white p-3 rounded shadow">
            <div class="col-md-12">
                <label for="input-name" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="input-name">
            </div>
            <div class="col-md-12">
                <label for="input-email" class="form-label">Email</label>
                <input type="email" class="form-control" id="input-email">
            </div>
            <div class="col-md-12">
                <label for="input-password" class="form-label">Password</label>
                <input type="password" class="form-control" id="input-password">
            </div>
            <div class="col-md-12">
                <label for="input-confirm-password" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="input-confirm-password">
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-success w-100">Register</button>
            </div>
        </form>
    </div>
</main>
@endsection