@extends('layout')

@section('title', 'Ulasan | Mie Sabi')

@section('content')
    <div class="container">
        <section>
            <h4 class="mb-3">Produk Selesai</h4>
            @foreach ($orders as $order)
                @php
                    switch($order->payment_with) {
                        case 1: $payment_with = 'Tunai'; break;
                        case 2: $payment_with = 'QRIS'; break;
                        case 3: $payment_with = 'Transfer'; break; }
                @endphp

                <div class="bg-white border rounded-lg shadow-md p-4 mb-4">
                    <div class="mb-3 pb-2 border-b">
                        <h4 class="fw-bold text-dark mb-1">Kode Pesanan: {{ $order->code }}</h4>
                        <small class="text-muted">Tanggal: {{ $order->created_at }}</small>
                    </div>

                    <div class="mb-3">
                        <p class="mb-1"><strong>Pembayaran:</strong> {{ $payment_with }}</p>
                        <p class="mb-1"><strong>Harga Pembelian:</strong> Rp{{ number_format($order->subtotal, 0, ',', '.') }}</p>
                        <p class="mb-1"><strong>Jasa Pengantaran:</strong> Rp{{ number_format($order->delivery_price, 0, ',', '.') }}</p>
                        <p class="mb-1"><strong>Total Harga:</strong>
                            <span class="fw-bold text-success">
                                Rp{{ number_format($order->total_price, 0, ',', '.') }}
                            </span>
                        </p>
                    </div>

                    <div class="mb-3">
                        <p class="mb-1"><strong>Bintang:</strong> {{ $order->stars ?? '-' }}</p>
                        <p class="mb-1"><strong>Ulasan:</strong> {{ $order->comment ?? '-' }}</p>
                    </div>
                </div>
            @endforeach
        </section>
    </div>
@endsection
