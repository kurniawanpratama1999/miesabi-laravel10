@extends('layouts.user')

@section('title', 'Pesanan | Mie Sabi')

@section('section')
    <main style="min-height: calc(100dvh - 3.5rem);" class="row overflow-hidden container-fluid mx-auto bg-young-brown">
        <section style="max-width: 450px;background-color: rgb(255, 255, 255,0.7);" class="mx-auto py-4">
            <h4>Rincian Harga</h4>

            <div>
                <h5>Total Pesanan</h5>
                <div class="d-flex flex-column gap-4">
                    @foreach([1,2,3] as $produk)
                    <div class="row justify-content-between">
                        <div class="d-flex flex-column gap-1 col-6">
                            <span>Mie Ayam Komplit</span>
                            <span>Original 1</span>
                            <span>Yamin 1</span>
                        </div>
                        <div class="col-6 row">
                            <span class="col-6">x2</span>
                            <span class="col-6">Rp 40.000</span>
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
                    <span class="d-block text-center">Ambil di Gerai</span>
                </div>
            </div>

            <div class="mt-5">
                <div class="row">
                    <span class="col-6">Total Pesanan</span>
                    <span class="col-6 d-block text-end">Rp 62.000</span>
                </div>
                <div class="row">
                    <span class="col-6">Metode Pembayaran</span>
                    <span class="col-6 d-block text-end">QRIS</span>
                </div>
                <div class="row">
                    <span class="col-6">Total Pembayaran</span>
                    <span class="col-6 d-block text-end">Rp 100.000</span>
                </div>
            </div>

            <button class="border-0 bg-success px-3 py-1 mt-5 mx-auto d-block text-white">Buat Pesanan</button>
        </section>
    </main>
@endsection
