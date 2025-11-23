@extends('layouts.user')

@section('title', 'Riwayat pesanan | Mie Sabi')

@section('section')
    <main style="min-height: calc(100dvh - 3.5rem);" class="overflow-hidden container-fluid mx-auto bg-young-brown">
        <div class="container mx-auto py-4 overflow-auto">
            <h4>Status Pesanan</h4>
            <section class="d-flex gap-5 mb-3 justify-content-end">
                <a href="#" class="link-dark">Sedang diproses</a>
                <a href="#" class="link-dark">Pesanan Selesai</a>
                <a href="#" class="link-dark">Riwayat Pesanan</a>
            </section>
            <table class="table table-responsive">
                <thead class="table-dark">
                    <tr>
                        <th style="padding: 10px auto" class="align-middle">code</th>
                        <th style="padding: 10px auto" class="align-middle">delivery</th>
                        <th style="padding: 10px auto" class="align-middle">payment</th>
                        <th style="padding: 10px auto" class="align-middle">payment status</th>
                        <th class="text-nowrap px-2 align-middle">Total</th>
                        <th style="padding: 10px auto" class="align-middle text-center">address</th>
                        <th style="padding: 10px auto" class="align-middle text-center">order status</th>
                        <th style="padding: 10px auto" class="align-middle text-center">date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                    <tr>
                        <td style="padding: 10px auto" class="align-middle">{{ $order->code }}</td>
                        <td style="padding: 10px auto" class="align-middle">{{ $order->delivery_name }}</td>
                        <td style="padding: 10px auto" class="align-middle">{{ $order->payment_with == 0 ? "Tunai" : "QRIS" }}</td>
                        <td style="padding: 10px auto" class="align-middle">{{ $order->payment_status == 0 ? 'Belum lunas' : 'Lunas' }}</td>
                        <td style="padding: 10px auto" class="align-middle text-center">{{ $order->total_price }}</td>
                        <td style="padding: 10px auto" class="align-middle text-center">{{ $order->address }}</td>
                        <td style="padding: 10px auto" class="align-middle">
                            @if($order->payment_with == 0 && strtolower($order->delivery_name) == 'sendiri')
                                @switch($order->order_status)
                                    @case(0)
                                        sedang di check
                                        @break
                                    @case(1)
                                        makanan dibuat
                                        @break
                                    @case(2)
                                        makanan sudah jadi
                                        @break
                                    @case(3)
                                        silakan ambil dan bayar ke kasir 
                                        @break
                                    @case(4)
                                        <button class="bg-primary rounded-pill px-4 d-block text-white mx-auto">Diterima</button>
                                        @break                                    
                                @endswitch

                            @elseif($order->payment_with == 0 && strtolower($order->delivery_name) == 'diantar')
                                @switch($order->order_status)
                                    @case(0)
                                        sedang di check
                                        @break
                                    @case(1)
                                        makanan dibuat
                                        @break
                                    @case(2)
                                        makanan dikirim
                                        @break
                                    @case(3)
                                        silakan membayar ke kasir 
                                        @break
                                    @case(4)
                                        <button class="bg-primary rounded-pill px-4 d-block text-white mx-auto">Diterima</button>
                                        @break                                    
                                @endswitch
                            @elseif($order->payment_with == 1 && strtolower($order->delivery_name) == 'sendiri')
                            
                                @switch($order->order_status)
                                    @case(0)
                                        @if($order->payment_status === 0)
                                            <a href="{{ route('scanqr.edit', $order->id) }}" class="bg-warning rounded-pill px-4 d-block text-white mx-auto">Bayar</a>
                                        @elseif($order->payment_status === 1)
                                            sedang di check
                                        @endif
                                        @break
                                    @case(1)
                                        makanan dibuat
                                        @break
                                    @case(2)
                                        makanan sudah jadi
                                        @break
                                    @case(3)
                                        <button class="bg-primary rounded-pill px-4 d-block text-white mx-auto" >Diterima</button>
                                        @break
                                @endswitch
                            @elseif($order->payment_with == 1 && strtolower($order->delivery_name) == 'diantar')
                                @switch($order->order_status)
                                    @case(0)
                                        @if($order->payment_status === 0)
                                            <a href="{{ route('scanqr.edit', $order->id) }}" class="bg-warning rounded-pill px-4 d-block text-white mx-auto">Bayar</a>
                                        @elseif($order->payment_status === 1)
                                            sedang di check
                                        @endif
                                        @break
                                    @case(1)
                                        makanan dibuat
                                        @break
                                    @case(2)
                                        makanan dikirm
                                        @break
                                    @case(3)
                                        <button class="bg-primary rounded-pill px-4 d-block text-white mx-auto">Diterima</button>
                                        @break
                                @endswitch
                            @endif
                        </td>
                        <td style="padding: 10px auto" class="align-middle text-center">{{ $order->created_at }}</td>
                    </tr>
                        
                    @endforeach
                </tbody>
            </table>
        </div>
    </main>
@endsection

@pushOnce('scripts')
    <script>

    </script>
@endPushOnce