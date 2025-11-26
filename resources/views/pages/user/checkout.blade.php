@extends('layouts.user')

@section('title', 'Pesanan | Mie Sabi')

@section('section')
        <section style="max-width: 450px;background-color: rgb(255, 255, 255,0.7);" class="mx-auto py-4">
            <h4 class="text-center mb-4">Rincian Harga</h4>
            <div>
                <div class="d-flex flex-column gap-2">

                    @foreach($orderDetails as $product)
                    <div class="row justify-content-between">
                        <div class="d-flex flex-column gap-1 col-6">
                            <span>{{ $product->name }} {{ $product->variant_name ?? "" }}</span>
                        </div>
                        <div class="col-6 row">
                            <span class="col-6">x{{ $product->quantity }}</span>
                            <span class="col-6 text-end">Rp {{ number_format($product->total, 0, ',', '.') }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-6">
                    <div class="text-center rounded p-1 mb-3 bg-yellow-300">
                        @switch($delivery->id)
                            @case(1) <i class="bi bi-shop fs-3"></i> @break
                            @case(2) <i class="bi bi-truck-front fs-3"></i> @break
                        @endswitch
                        <span class="d-block text-center">{{ $delivery->name }}</span>
                    </div>
                </div>

                <div class="col-6">
                    <div  class="text-center rounded p-1 mb-3 bg-yellow-300">
                        @switch($payment_with)
                            @case(1) <i class="bi bi-cash-coin fs-3"></i> @break
                            @case(2) <i class="bi bi-qr-code-scan fs-3"></i> @break
                        @endswitch
                        <span class="d-block text-center">
                            @switch($payment_with)
                                @case(1) Tunai @break
                                @case(2) QRIS @break
                            @endswitch
                        </span>
                    </div>
                </div>
            </div>

            @php
                $biayaPengiriman = $delivery->price;
                $totalPesanan = collect($orderDetails)->sum('total');
                $totalPembayaran = $biayaPengiriman + $totalPesanan;
            @endphp
            <div class="mt-2">
                <div class="row">
                    <span class="col-6">Biaya Pengiriman</span>
                    <span class="col-6 d-block text-end">Rp {{ number_format($biayaPengiriman, 0, ',', '.') }}</span>
                </div>
                <div class="row">
                    <span class="col-6">Total Pesanan</span>
                    <span class="col-6 d-block text-end">Rp {{ number_format($totalPesanan, 0, ',', '.') }}</span>
                </div>
                <div class="row">
                    <span class="col-6">Total Pembayaran</span>
                    <span class="col-6 d-block text-end">Rp {{ number_format($totalPembayaran, 0, ',', '.') }}</span>
                </div>
            </div>

            <button onclick="makeOrder()" type="button" class="border-0 bg-yellow-500 px-3 py-2 mt-5 mx-auto d-block text-white rounded">Buat Pesanan</button>
        </section>
@endsection

@pushOnce('scripts')
<script>
    async function makeOrder() {
        const api = await fetch("{{ route('u.checkout.store') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').getAttribute('content')
            }
        })
        const res = await api.json();
        if (res.success) {
            location.href = res.redirect
        }
    }
</script>
@endPushOnce
