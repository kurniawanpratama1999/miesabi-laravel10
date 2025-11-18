@extends('layouts.user')

@section('title', 'Informasi Pembayaran | Mie Sabi')

@section('section')
    <main style="height: calc(100dvh - 3.5rem);" class="row overflow-hidden container-fluid mx-auto bg-young-brown">
        <section style="max-width: 450px;background-color: rgb(255, 255, 255,0.2);" class="mx-auto py-4">
            <h3 class="text-center mb-3">Pembayaran Berhasil</h3>
            <div style="max-width: 300px; min-width: 300px; max-height: 300px; min-height: 300px;" class="border mx-auto">

            </div>

            <div style="max-width: 300px" class="mt-4 d-flex flex-column gap-3 mx-auto">
                <div class="row justify-content-between">
                    <span class="col-6">Time</span>
                    <span class="col-6 text-end">04.50 AM</span>
                </div>
                <div class="row justify-content-between">
                    <span class="col-6">Data</span>
                    <span class="col-6 text-end">03 Oktober 2025</span>
                </div>
                <div class="row justify-content-between">
                    <span class="col-6">Transaction ID</span>
                    <span class="col-6 text-end">1120248291</span>
                </div>
                <div class="row justify-content-between">
                    <span class="col-6">Total</span>
                    <span class="col-6 text-end">Rp 100.000</span>
                </div>
            </div>
        </section>
    </main>
@endsection