<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        {{-- <meta name="csrf_token" content="{{ csrf_token() }}"> --}}
        <title>@yield('title', 'MIESABI')</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <x-navbar-admin/>
        <main style="min-height: 100dvh; padding-top: 3.5rem" class="bg-yellow-100">
            @yield('content')
        </main>
        @stack('scripts')
    </body>
</html>
