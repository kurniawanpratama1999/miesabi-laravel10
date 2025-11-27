@extends('layout')

@section('title', 'Ulasan | Mie Sabi')

@section('content')
    <div class="container">
        @if (isset($order))
            <section class="pt-3 row px-3">
                <form class="col-12 col-lg-6 row bg-yellow-400 rounded p-3 mb-4 mx-auto" method="POST" action="{{ route('u.orders.update', $order->id) }}">
                    <h5 class="text-center">Kode Pesanan : {{ $order->code }}</h5>
                    @csrf
                    @method('PUT')

                    <div class="col-12 p-3">
                        <div>
                            <label for="stars" class="form-label">Pilih Bintang</label>
                            <select name="stars" id="star" class="form-select" aria-label="stars">
                                @foreach ([5,4,3,2,1] as $star)
                                    <option value="{{ $star }}">{{ $star }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12 p-3">
                        <div>
                            <label for="comment" class="form-label">Beri Komentar</label>
                            <textarea type="text" class="form-control" name="comment" id="comment" value="" @disabled($order->comment)></textarea>
                        </div>
                    </div>

                    <div class="d-flex align-items-center gap-3 justify-content-end">
                        <a href="{{ route('u.reviews.index') }}" class="nav-link">Tutup</a>
                        <button type="submit" class="d-block border-0 bg-yellow-500 py-2 px-4 rounded text-white">Simpan</button>
                    </div>
                </form>
            </section>
        @endif

        <section>
            <h4>Produk Selesai</h4>
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

                    <a href="{{ route('u.reviews.show', $order->id) }}"
                    class="btn btn-warning fw-bold px-3 py-2 rounded">
                        Beri Ulasan
                    </a>
                </div>
            @endforeach
        </section>
    </div>
@endsection
