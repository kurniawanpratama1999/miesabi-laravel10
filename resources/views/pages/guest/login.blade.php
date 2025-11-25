@extends('layouts.guest')

@section('title', 'Selamat Datang di Mie Sabi')

@section('section')
    <div style="min-height: calc(100dvh - 3.5rem);" class="container d-flex align-items-center justify-content-center p-4">
        <form style="max-width: 300px;" method="POST" action="{{ route('login.process') }}" class="row g-3 bg-yellow-400 p-3 rounded shadow">
            @csrf
            <div class="col-md-12">
                <label for="email" class="form-label text-yellow-900">Email</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="col-md-12">
                <label for="password" class="form-label text-yellow-900">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="col-12">
                <button type="submit" class="bg-yellow-600 border-0 rounded py-2 text-white w-100">Sign in</button>
            </div>
        </form>
    </div>
@endsection
