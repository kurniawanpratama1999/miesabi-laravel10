@extends('layout')

@section('title', 'Detail pesanan | Miesabi')

@section('content')
<section class="pb-5">
    <div class="container my-4">
        <div class="card shadow-sm border-0 rounded-4 ">
            <div class="card-header">
                <div class="d-flex flex-column justify-content-between px-3">
                    <h5 class="mb-0 fw-semibold">Detail Pesanan</h5>
                    <p class="p-0 m-0 mt-2">{{ $order->phone }}</p>
                    <p class="p-0 m-0">{{ $order->phone }}</p>
                </div>
            </div>
            <div class="table-responsive" style="max-height: 420px;">
                <table class="table align-middle table-hover mb-0 modern-table">
                    <thead class="sticky-top bg-white shadow-sm">
                        <tr>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>Total</th>
                        </tr>   
                    </thead>
                    <tbody>
                        @foreach ($orderDetails as $orderDetail)
                            <tr>
                                <td>
                                    <div class="d-flex flex-row align-items-center gap-2">
                                        <div style="width: 50px; aspect-ratio: 1/1;" class="img-thumbnail overflow-hidden rounded-circle position-relative">
                                            @if ($orderDetail->product->photo)
                                                <img src="{{ asset('storage/' . $orderDetail->product->photo) }}" style="object-position: center" class="object-fit-cover" width="100%" height="100%">
                                            @else
                                                <i class="bi bi-fork-knife fs-2 position-absolute top-50 start-50 translate-middle"></i>
                                            @endif
                                        </div>
                                        <div>
                                            {{ $orderDetail->product->name }} {{ $orderDetail->variant->name ?? ""}}</td>
                                        </div>
                                    </div>

                                <td>Rp {{ number_format($orderDetail->product->price + ($orderDetail->variant->price ?? 0), 0, ',', '.') }}</td>

                                <td>{{ $orderDetail->quantity }}</td>

                                <td>Rp {{ number_format(($orderDetail->product->price + ($orderDetail->variant->price ?? 0)) * $orderDetail->quantity, 0, ',', '.') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection