@extends('layouts.user')

@section('title', 'ScanQr | Mie Sabi')

@section('section')
    <main style="height: calc(100dvh - 3.5rem);" class="row overflow-hidden container-fluid mx-auto bg-young-brown">
        <section style="max-width: 450px;background-color: rgb(255, 255, 255,0.2);" class="mx-auto py-4">
            <h3 class="text-center mb-3">QR SCAN</h3>
            <div style="max-width: 300px; min-width: 300px; max-height: 300px; min-height: 300px;" class="border mx-auto">

            </div>

            <div class="mt-4 d-flex flex-column align-items-center">
                <span class="fw-bold fs-4">Total Pembayaran</span>
                <span class="fw-bold fs-4">Rp 100.000</span>
            </div>
        </section>
    </main>
@endsection