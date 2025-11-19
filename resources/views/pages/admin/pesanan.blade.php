@extends('layouts.admin')

@section('title', 'Pesanan | Mie Sabi')

@section('section')
    <main style="min-height: calc(100dvh - 3.5rem);" class="overflow-hidden container-fluid mx-auto bg-young-brown">
        <div class="container mx-auto py-4">
            <h4>Kelola Produk</h4>
            
            <table class="table table-responsive">
                <thead class="table-dark">
                    <tr>
                        <th style="padding: 10px auto" class="align-middle">id</th>
                        <th style="padding: 10px auto" class="align-middle">pelanggan</th>
                        <th style="padding: 10px auto" class="align-middle">pesanan</th>
                        <th style="padding: 10px auto" class="align-middle">layanan</th>
                        <th class="text-nowrap px-2 align-middle">status</th>
                        <th style="padding: 10px auto" class="align-middle text-center">tanggal</th>
                        <th style="padding: 10px auto" class="align-middle text-center">jumlah</th>
                        <th style="padding: 10px auto" class="align-middle text-center">harga</th>
                        <th style="padding: 10px auto" class="align-middle text-center" colspan="2">action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="padding: 10px auto" class="align-middle">01</td>
                        <td style="padding: 10px auto" class="align-middle">Rizki</td>
                        <td style="padding: 10px auto" class="align-middle">Mie Ayam Komplit</td>
                        <td style="padding: 10px auto" class="align-middle text-nowrap">Antar ke Lokasi</td>
                        <td style="padding: 10px auto" class="align-middle">Pembayaran Berhasil</td>
                        <td style="padding: 10px auto" class="align-middle">21 Sep 2025 13:10</td>
                        <td style="padding: 10px auto" class="align-middle">1</td>
                        <td style="padding: 10px auto" class="align-middle">Rp 18.000</td>
                        <td style="padding: 10px auto" class="align-middle">
                            <button class="bg-danger rounded-pill px-4 text-nowrap d-block text-white mx-auto">Proses</button>
                        </td>
                        <td style="padding: 10px auto" class="align-middle">
                            <button class="bg-success rounded-pill px-4 text-nowrap d-block text-white mx-auto">Kirim</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
@endsection
