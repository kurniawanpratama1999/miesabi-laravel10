@extends('layout')

@section('title', 'Pesanan diproses | Mie Sabi')

@section('content')
    <main style="min-height: calc(100dvh - 3.5rem);" class="overflow-hidden container-fluid mx-auto bg-young-brown">
        <div class="container mx-auto py-4">
            <h4>Status Pesanan</h4>
            <section class="d-flex gap-5 mb-3 justify-content-end">
                <a href="#" class="link-dark">Sedang diproses</a>
                <a href="#" class="link-dark">Pesanan Selesai</a>
                <a href="#" class="link-dark">Riwayat Pesanan</a>
            </section>
            <table class="table table-responsive">
                <thead class="table-dark">
                    <tr>
                        <th style="padding: 10px auto" class="align-middle">img</th>
                        <th style="padding: 10px auto" class="align-middle">name</th>
                        <th style="padding: 10px auto" class="align-middle">qty</th>
                        <th style="padding: 10px auto" class="align-middle">price</th>
                        <th class="text-nowrap px-2 align-middle">metode pengambilan</th>
                        <th style="padding: 10px auto" class="align-middle text-center">status</th>
                        <th style="padding: 10px auto" class="align-middle text-center">action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="padding: 10px auto" class="align-middle">img</td>
                        <td style="padding: 10px auto" class="align-middle">Mie ayam komplit</td>
                        <td style="padding: 10px auto" class="align-middle">2</td>
                        <td style="padding: 10px auto" class="align-middle text-nowrap">Rp 50.000</td>
                        <td style="padding: 10px auto" class="align-middle">Diantar ke lokasi</td>
                        <td style="padding: 10px auto" class="align-middle">
                            <span class="text-success d-block text-center">diproses</span>
                        </td>
                        <td style="padding: 10px auto" class="align-middle">
                            <button class="bg-success rounded-pill px-4 d-block text-white mx-auto">diterima</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
@endsection