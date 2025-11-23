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
                <span class="fw-bold fs-4">{{ $total }}</span>
            </div>

            <button type="button" onclick="sudahBayar({{ $order_id }})">Sudah Bayar</button>
        </section>
    </main>
@endsection

@pushOnce('scripts')
    <script>
        async function sudahBayar(order_id) {
            const HIT_API = await fetch(`/scanqr/${order_id}`,{
                method: 'PUT',
                headers: {
                    "Content-Type":"application/json",
                    "X-CSRF-TOKEN":document.querySelector('meta[name=csrf-token]').getAttribute('content')
                }
            })

            const res = await HIT_API.json();

            if (res.success) {
                location.href = res.redirect
            }
        }
    </script>
@endPushOnce