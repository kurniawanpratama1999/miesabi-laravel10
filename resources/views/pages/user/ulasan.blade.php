@extends('layout')

@section('title', 'Ulasan | Mie Sabi')

@section('content')
    <div class="container">
        @if (isset($order))
            <section class="pt-3 row px-3">
                <x-form-modal method="PUT" title="Beri Penilaian" action="{{ route('u.reviews.update', $order->id) }}">
                    <div class="col-12">
                        <x-form-select idprop="stars" labelprop="Bintang" :model="$order ?? null" :options="[
                            ['id' => 5, 'name' => 5],
                            ['id' => 4, 'name' => 4],
                            ['id' => 3, 'name' => 3],
                            ['id' => 2, 'name' => 2],
                            ['id' => 1, 'name' => 1]]"/>
                    </div>

                    <div class="col-12">
                        <x-form-textarea idprop="comment" labelprop="Komentar" :model="$order ?? null" />
                    </div>

                    <div class="d-flex align-items-center gap-3 justify-content-end">
                        @if(isset($order))
                            <a href="{{ route('u.reviews.index') }}" class="link-dark fw-bold">Kembali</a>
                        @endif
                        <button type="submit" class="d-block border-0 bg-yellow-500 py-2 px-4 rounded text-white">Simpan</button>
                    </div>
                </x-form-modal>
            </section>
        @endif

        <section class="pt-3">
            @foreach ($orders as $item)
                @php
                    switch($item->payment_with) {
                        case 1: $payment_with = 'Tunai'; break;
                        case 2: $payment_with = 'QRIS'; break;
                        case 3: $payment_with = 'Transfer'; break; }
                @endphp

                <div class="bg-white border rounded-lg shadow-md p-4 mb-4">
                    <div class="mb-3 pb-2 border-b">
                        <h4 class="fw-bold text-dark mb-1">Kode Pesanan: {{ $item->code }}</h4>
                        <small class="text-muted">Tanggal: {{ $item->created_at }}</small>
                    </div>

                    <div class="mb-3">
                        <p class="mb-1"><strong>Pembayaran:</strong> {{ $payment_with }}</p>
                        <p class="mb-1"><strong>Harga Pembelian:</strong> Rp{{ number_format($item->subtotal, 0, ',', '.') }}</p>
                        <p class="mb-1"><strong>Jasa Pengantaran:</strong> Rp{{ number_format($item->delivery_price, 0, ',', '.') }}</p>
                        <p class="mb-1"><strong>Total Harga:</strong>
                            <span class="fw-bold text-success">
                                Rp{{ number_format($item->total_price, 0, ',', '.') }}
                            </span>
                        </p>
                    </div>

                    <div class="mb-3">
                        <p class="mb-1"><strong>Bintang:</strong> {{ $item->stars ?? '-' }}</p>
                        <p class="mb-1"><strong>Ulasan:</strong> {{ $item->comment ?? '-' }}</p>
                    </div>

                    @if ($item->stars < 3 || $item->comment == null)
                    <a href="{{ route('u.reviews.show', $item->id) }}"
                    class="btn btn-warning fw-bold px-3 py-2 rounded">
                        Beri Ulasan
                    </a>
                    @endif
                </div>
            @endforeach
        </section>
    </div>
@endsection

@if(isset($order))
    @push('scripts')
    <script>
        window.addEventListener('load', () => {
            new bootstrap.Modal('#formModal', {
            }).show();

            const myModalEl = document.getElementById('formModal')
            myModalEl.addEventListener('hidden.bs.modal', event => {
                location.href = "{{ route('u.reviews.index') }}"
            })
        })
    </script>
    @endpush
@endif
