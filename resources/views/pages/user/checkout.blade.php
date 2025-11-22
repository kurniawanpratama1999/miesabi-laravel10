@extends('layouts.user')

@section('title', 'Pesanan | Mie Sabi')

@section('section')
    <main style="min-height: calc(100dvh - 3.5rem);" class="row overflow-hidden container-fluid mx-auto bg-young-brown">
        <section style="max-width: 450px;background-color: rgb(255, 255, 255,0.7);" class="mx-auto py-4">
            <h4>Rincian Harga</h4>
            <div>
                <h5>Total Pesanan</h5>
                <div class="d-flex flex-column gap-4">

                    @foreach($orderDetails as $product)
                    <div class="row justify-content-between">
                        <div class="d-flex flex-column gap-1 col-6">
                            <span>{{ $product->name }} {{ $product->variant_name ?? "" }}</span>
                        </div>
                        <div class="col-6 row">
                            <span class="col-6">x{{ $product->quantity }}</span>
                            <span class="col-6">{{ $product->total }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="mt-5">
                <h5>Opsi Pengiriman</h5>
                <div style="width: fit-content;">
                    <div style="width: 150px; height: 150px;" class="border mb-2">

                    </div>
                    <span class="d-block text-center">{{ $delivery->name }}</span>
                </div>
            </div>

            @php
                $biayaPengiriman = $delivery->price;
                $totalPesanan = collect($orderDetails)->sum('total');
                $totalPembayaran = $biayaPengiriman + $totalPesanan;
            @endphp
            <div class="mt-5">
                <div class="row">
                    <span class="col-6">Biaya Pengiriman</span>
                    <span class="col-6 d-block text-end">{{ $biayaPengiriman }}</span>
                </div>
                <div class="row">
                    <span class="col-6">Total Pesanan</span>
                    <span class="col-6 d-block text-end">{{ $totalPesanan }}</span>
                </div>
                <div class="row">
                    <span class="col-6">Metode Pembayaran</span>
                    <span class="col-6 d-block text-end">{{ $orders['payment_with'] }}</span>
                </div>
                <div class="row">
                    <span class="col-6">Total Pembayaran</span>
                    <span class="col-6 d-block text-end">{{ $totalPembayaran }}</span>
                </div>
            </div>

            <button onclick="makeOrder()" type="button" class="border-0 bg-success px-3 py-1 mt-5 mx-auto d-block text-white">Buat Pesanan</button>
        </section>
    </main>
@endsection

@pushOnce('scripts')
<script>
    async function makeOrder() {
        const api = await fetch('/checkout', {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').getAttribute('content')
            }
        })
        const res = await api.json();
        console.log(res)

        if (res.success) {
            location.href = res.redirect
        }
    }
</script>
@endPushOnce
