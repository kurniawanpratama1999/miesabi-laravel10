@extends('layout')

@section('title', 'Details | Mie Sabi')

@section('content')
<div class="container py-4">
    <h4 class="mb-4">Detail Produk </h4>

    <div class="table-responsive">
        <table class="table table-striped align-middle text-center">
            <thead>
                <tr>
                    <th class="text-nowrap">Gambar Produk</th>
                    <th class="text-nowrap">Nama Produk</th>
                    <th class="text-nowrap">Variant</th>
                    <th class="text-nowrap">Harga</th>
                    <th class="text-nowrap">Jumlah</th>
                    <th class="text-nowrap">Total</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($orderDetails as $orderDetail)
                <tr>
                    <td class="align-middle">
                        <div style="width: 70px; aspect-ratio: 1/1;" class="img-thumbnail overflow-hidden rounded-circle position-relative mx-auto">
                            @if ($orderDetail->product->photo)
                                <img src="{{ asset('storage/' . $orderDetail->product->photo) }}" style="object-position: center" class="object-fit-cover" width="100%" height="100%">
                            @else
                                <i class="bi bi-fork-knife fs-2 position-absolute top-50 start-50 translate-middle"></i>
                            @endif
                        </div>
                    </td>
                    <td class="text-nowrap">{{ $orderDetail->product->name }}</td>
                    <td class="text-nowrap">{{ $orderDetail->variant->name ?? "-" }}</td>
                    <td class="text-nowrap">Rp {{ number_format($orderDetail->product->price + ($orderDetail->variant->price ?? 0), 0, ',', '.') }}</td>
                    <td class="text-nowrap">{{ $orderDetail->quantity }}</td>
                    <td class="text-nowrap">Rp {{ number_format($orderDetail->quantity * $orderDetail->product->price, 0, ',', '.') }}</td>
                </tr>
            @endforeach
            </tbody>
            
        </table>
    </div>
</div>
@endsection
