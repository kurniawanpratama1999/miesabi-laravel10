@extends('layouts.user')

@section('title', 'Riwayat Pesanan | Mie Sabi')

@section('section')
<main class="container py-4">
    <h4 class="mb-4">Riwayat Pesanan</h4>

    <div class="table-responsive">
        <table class="table table-striped align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>Kode</th>
                    <th>Pembayaran</th>
                    <th>Status Bayar</th>
                    <th>Pengiriman</th>
                    <th>Status Pesanan</th>
                    <th>Total</th>
                    <th>Tanggal</th>
                    <th>Detail</th>
                </tr>
            </thead>

            <tbody>
                {{-- Looping data pesanan --}}
                @foreach($orders as $order)
                <tr>
                    <td>{{ $order->code }}</td>

                    {{-- Payment Method --}}
                    <td>
                        @if($order->payment_with == 0)
                            <span class="badge bg-warning text-dark">Tunai</span>
                        @else
                            <span class="badge bg-primary">QRIS</span>
                        @endif
                    </td>

                    {{-- Payment Status --}}
                    <td>
                        @switch($order->payment_status)
                            @case(1) 
                                <div class="d-flex flex-column gap-2 text-center">
                                    <span class="badge bg-danger">Belum Lunas</span>
                                    <a href="{{ route('scanqr.show', $order->id) }}" class="badge bg-primary">Bayar</a>
                                </div>
                                @break

                            @case(2)
                                <span class="badge bg-success">Lunas</span>
                                @break
                        @endswitch
                    </td>

                    {{-- Delivery Method --}}
                    <td>
                        @switch($order->delivery_id)
                            @case(1) <span class="badge bg-secondary">Sendiri</span> @break
                            @case(2) <span class="badge bg-success">Diantar</span> @break
                        @endswitch
                    </td>

                    {{-- Order Status --}}
                    <td>
                        @switch($order->order_status)
                            @case(1) <span class="badge bg-secondary">Menunggu Konfirmasi</span> @break
                            @case(2) <span class="badge bg-warning text-dark">Sudah Dikonfirmasi</span> @break
                            @case(3) <span class="badge bg-info text-dark">Pesanan diproses</span> @break
                            @case(4) <span class="badge bg-primary">Pesanan Siap</span> @break
                            @case(5) 
                                <div class="d-flex flex-column gap-1">
                                    <span class="badge bg-secondary">Dalam Pengiriman / Siap Diambil</span>
                                    <form action="{{ route('orders.update', $order->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="badge bg-success">Diterima</button>
                                    </form>
                                </div>
                                @break
                            @case(6) 
                                <div class="d-flex flex-column gap-1">
                                    <span class="badge bg-secondary">Pesanan Sampai</span>
                                    <form action="{{ route('orders.update', $order->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="badge bg-success">Diterima</button>
                                    </form>
                                </div>
                                @break
                            @case(7) <span class="badge bg-success">Selesai</span> @break
                        @endswitch
                    </td>

                    <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>

                    <td>{{ $order->created_at }}</td>

                    <td>
                        <a href="/u/details/{{ $order->id }}" 
                           class="btn btn-sm btn-outline-primary">
                            Detail
                        </a>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</main>
@endsection
