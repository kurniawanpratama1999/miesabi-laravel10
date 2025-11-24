@extends('layouts.admin')

@section('title', 'Pesanan | Miesabi')

@section('content')
    <main class="container-fluid py-4 bg-light">
    <h4 class="mb-4">Status Pesanan</h4>

    <!-- Filter Order -->
    <section class="d-flex gap-4 mb-3 justify-content-end">
        <a href="?filter=processing" class="text-dark">Sedang Diproses</a>
        <a href="?filter=done" class="text-dark">Pesanan Selesai</a>
        <a href="?filter=history" class="text-dark">Riwayat</a>
    </section>

    <!-- Table Order -->
    <div class="table-responsive">
        <table class="table table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>Kode</th>
                    <th>Nama User</th>
                    <th>Pengiriman</th>
                    <th>Pembayaran</th>
                    <th>Status Bayar</th>
                    <th>Total</th>
                    <th>Alamat</th>
                    <th>Status Pesanan</th>
                    <th>Tanggal</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach($orders as $order)
                @php
                    switch ($order->payment_with) {
                        case 1:
                            $payment_with = 'Tunai';
                            break;
                        case 2:
                            $payment_with = 'QRIS';
                            break;
                        default:
                            $payment_with = 'Tunai';
                            break;
                    }

                    switch ($order->order_status) {
                        case 1:
                            $order_status = 'Konfirmasi Pesanan';
                            break;
                        case 2:
                            $order_status = 'Pesanan diproses';
                            break;
                        case 3:
                            $order_status = 'Pesanan siap';
                            break;
                        case 4:
                            if ($order->delivery_name === 'sendiri') {
                                $order_status = 'Siap diambil';
                            } else {
                                $order_status = 'Sedang dikirim';
                            }
                            break;
                        case 5:
                            $order_status = 'Sudah Sampai';
                            break;
                        case 6:
                            $order_status = 'Menunggu di terima';
                            break;
                        case 7:
                            $order_status = 'Selesai';
                            break;
                    }

                    switch ($order->payment_status) {
                        case 1:
                            $payment_status = 'Belum Lunas';
                            break;
                        case 2:
                            $payment_status = 'Lunas';
                            break;
                        default:
                            $payment_status = 'Belum Lunas';
                            break;
                    }
                @endphp
                <tr>
                    <td>{{ $order->code }}</td>
                    <td>{{ $order->user_name }}</td>
                    <td>{{ $order->delivery_name }}</td>
                    <td>{{ $payment_with }}</td>
                    <td>
                        <div class="d-flex flex-column gap-2 text-center">
                            <span>{{ $payment_status }}</span>

                            @if ($order->payment_status == 1 && $order->payment_with == 1)
                            <form action="{{ route('u.orders.payment', $order->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-sm btn-primary">{{ $order_status }}</button>
                            </form>
                            @endif
                        </div>
                    </td>
                    <td>25.000</td>
                    <td>-</td>

                    <td>
                        <form action="{{ route('u.orders.status.next', $order->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-sm btn-primary">{{ $order_status }}</button>
                        </form>
                    </td>
                    <td>2025-11-23</td>
                    <td><a href="/a/details/{{ $order->id }}">Detail Pesanan</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</main>

@endsection