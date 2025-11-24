@extends('layouts.user')

@section('title', 'Details | Mie Sabi')

@section('section')
<main class="container py-4">
    <h4 class="mb-4">Detail Produk </h4>

    <div class="table-responsive">
        <table class="table table-striped align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>Gambar Produk</th>
                    <th>Nama Produk</th>
                    <th>Variant</th>
                    
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($orderDetails as $orderDetail)
            <script>
            </script>
                <tr>
                    <td>{{ $orderDetail->product->name }}</td>
                    <td>{{ $orderDetail->product->name }}</td>
                    <td>{{ $orderDetail->variant->name ?? "-" }}</td>
                    <td>{{ $orderDetail->product->price }}</td>
                    <td>{{ $orderDetail->quantity }}</td>
                    <td>{{ $orderDetail->quantity * $orderDetail->product->price }}</td>
                </tr>
            @endforeach
            </tbody>
            
        </table>
    </div>
</main>
@endsection
