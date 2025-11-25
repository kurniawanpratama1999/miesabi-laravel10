@extends('layouts.admin')

@section('title', 'Pesanan | Miesabi')

@section('content')
    <div class="container py-4">
    <h4 class="mb-4">Status Pesanan</h4>

    <!-- Table Order -->
    <div class="table-responsive">
        <table class="table table-striped align-middle">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama User</th>
                    <th>Pengiriman</th>
                    <th>Pembayaran</th>
                    <th>Photo</th>
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
                        @if($order->orders_receipt)
                            <div data-bs-toggle="modal" data-bs-target="#modalReceipt-{{ $order->id }}" style="width: 70px; aspect-ratio: 1/1;cursor:pointer;" class="rounded-circle overflow-hidden mx-auto">
                                <img src="{{ asset('storage/' . $order->orders_receipt) }}" class="w-100">
                            </div>
                            <div class="modal fade" id="modalReceipt-{{ $order->id }}" tabindex="-1" aria-labelledby="modalReceipt-{{ $order->id }}Label" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-body">
                                        <img src="{{ asset('storage/' . $order->orders_receipt) }}" class="w-100">
                                    </div>
                                </div>
                            </div>
                        @endif
                    </td>
                    <td>
                        <div class="d-flex flex-column gap-2 text-center">
                            <span>{{ $payment_status }}</span>

                            @if ($order->payment_status == 1)
                            <form action="{{ route('a.orders.payment', $order->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="btn btn-sm btn-primary">Konfirmasi Pembayaran</button>
                            </form>
                            @endif
                        </div>
                    </td>
                    <td class="text-nowrap">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                    <td>{{ $order->address }}</td>

                    <td>
                        <form action="{{ route('a.orders.status.next', $order->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-sm btn-primary">{{ $order_status }}</button>
                        </form>
                    </td>
                    <td>{{ $order->created_at }}</td>
                    <td><a href="/a/details/{{ $order->id }}">Detail Pesanan</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@pushOnce('scripts')
<script>
    function zoomOut () {

    }
</script>
@endPushOnce
