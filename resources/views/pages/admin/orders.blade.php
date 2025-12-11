@extends('layout')

@section('title', 'Pesanan | Miesabi')

@section('content')
<section class="pb-5">
    <div class="container my-4">
        <div class="card shadow-sm border-0 rounded-4 ">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-semibold pt-2 pb-4 px-3 ">Daftar Pesanan</h5>
                    <input  id="myInput" type="text" placeholder="Search...">
                </div>
            </div>
            <div class="table-responsive" style="max-height: 420px;">
                <table class="table align-middle table-hover mb-0 modern-table">
                    <thead class="sticky-top bg-white shadow-sm">
                        <tr>
                            <th>Kode</th>
                            <th>User</th>
                            <th>Pengiriman</th>
                            <th>Bukti</th>
                            <th>Status Bayar</th>
                            <th>Total Harga</th>
                            <th>Status Pesanan</th>
                            <th>Tanggal</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
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
                                    $payment_status = 'Menunggu Pembayaran';
                                    break;
                                case 2:
                                    $payment_status = 'Sudah Bayar';
                                    break;
                                case 3:
                                    $payment_status = 'Lunas';
                                    break;
                                default:
                                    $payment_status = 'Menunggu Pembayaran';
                                    break;
                            }
                        @endphp
                            <tr>
                                <td>{{ $order->code }}</td>

                                <td>{{ $order->user_name }}</td>

                                <td>
                                    <div class="d-flex flex-column gap-2">
                                        <span class="badge bg-success">{{ $order->delivery_name }}</span>
                                        <span class="badge bg-warning">{{ $payment_with }}</span>
                                    </div>
                                </td>

                                <td>
                                    <div data-bs-toggle="modal" data-bs-target="#modalReceipt-{{ $order->id }}" style="width: 70px; aspect-ratio: 1/1;cursor:pointer;" class="rounded-circle overflow-hidden mx-auto bg-danger-subtle position-relative">
                                        @if($order->orders_receipt)
                                            <img src="{{ asset('storage/' . $order->orders_receipt) }}" class="w-100">
                                        @else
                                            <i class="bi bi-slash-circle position-absolute start-50 top-50 translate-middle fs-1"></i>
                                        @endif
                                    </div>
                                    @if($order->orders_receipt)
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
                                    <div class="d-flex flex-column gap-2 text-left">
                                        <!-- <form action="{{ route('a.orders.payment.prev', $order->id) }}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-sm btn-danger text-nowrap">Prev</button>
                                        </form> -->

                                        <span>{{ $payment_status }}</span>

                                        @if ($order->payment_status !== 3 )
                                        <form action="{{ route('a.orders.payment.next', $order->id) }}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-sm btn-primary text-nowrap">Konfirmasi Pembayaran</button>
                                        </form>
                                        @endif
                                    </div>
                                </td>

                                <td>
                                    <a href="{{ route('a.details.show', $order->id) }}" class="d-flex flex-column nav-link">
                                        <span class="text-end text-nowrap fw-bold">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                                    </a>
                                </td>

                                <td>
    <div class="d-flex flex-column gap-2">

        {{-- Bisa batal jika status masih awal --}}
        @if ($order->order_status <= 1)
            <form action="{{ route('a.orders.destroy', $order->id) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-warning">Batalkan Pesanan</button>
            </form>
        @endif

        {{-- Jika pesanan belum selesai --}}
        @if ($order->order_status != 7)

            {{-- Jika pembayaran sudah lunas, tombol next status muncul --}}
            @if ($order->payment_status == 3)
                <form action="{{ route('a.orders.status.next', $order->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-sm btn-primary text-nowrap">
                        {{ $order_status }}
                    </button>
                </form>

            {{-- Jika belum lunas, next status tidak muncul --}}
            @else
                <span class="text-nowrap">{{ $order_status }}</span>
                <span class="badge bg-danger text-nowrap">Bayar Belum Lunas</span>
            @endif

        @else
            {{-- Pesanan selesai --}}
            <span class="text-nowrap">{{ $order_status }}</span>
        @endif

    </div>
</td>
                                <td>
                                    <span class="text-nowrap">{{ $order->created_at }}</span>
                                </td>
                                <td>
                                    <a href="{{ route('a.details.show', $order->id) }}" class="btn btn-sm btn-info text-white">Lihat Detail</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded',function(){
        const myInput = document.getElementById('myInput');
        const modernTable = document.querySelector('.modern-table');

        if(!myInput || !modernTable) return;

        const tbody = modernTable.querySelector('tbody');
        if(!tbody)return;

        const tr = tbody.getElementsByTagName('tr');

        myInput.addEventListener('keyup',function(){
            const filter = myInput.value.toUpperCase();

        for(let i = 0; i < tr.length; i++){
            const td = tr[i].getElementsByTagName('td')[0];

            if(td){
                const textValue = td.textContent || td.innerText;

                if(textValue.toUpperCase().indexOf(filter)> -1){
                    tr[i].style.display = "";
                }else{
                    tr[i].style.display = "none";
                }
            }
        }
        })
        
    })
</script>
@endpush
