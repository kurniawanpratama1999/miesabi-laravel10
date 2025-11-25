@extends('layouts.user')

@section('title', 'Details | Mie Sabi')

@section('section')
<main class="container py-4">
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
                    <td class="text-nowrap">{{ $orderDetail->product->name }}</td>
                    <td class="text-nowrap">{{ $orderDetail->product->name }}</td>
                    <td class="text-nowrap">{{ $orderDetail->variant->name ?? "-" }}</td>
                    <td class="text-nowrap">Rp {{ number_format($orderDetail->product->price, 0, ',', '.') }}</td>
                    <td class="text-nowrap">{{ $orderDetail->quantity }}</td>
                    <td class="text-nowrap">Rp {{ number_format($orderDetail->quantity * $orderDetail->product->price, 0, ',', '.') }}</td>
                </tr>
            @endforeach
            </tbody>

        </table>
    </div>
</main>
@endsection
