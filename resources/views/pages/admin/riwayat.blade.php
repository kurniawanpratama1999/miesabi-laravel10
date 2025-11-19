@extends('layouts.admin')

@section('title', 'Riwayat pesanan | Mie Sabi')

@section('section')
    <main style="min-height: calc(100dvh - 3.5rem);" class="overflow-hidden container-fluid mx-auto bg-young-brown">
        <div class="container mx-auto py-4">
            <h4>Riwayat Pesanan</h4>
            <section class="d-flex gap-5 mb-3 justify-content-end">
                <label for="tanggal-dari">
                    <span>Tanggal Dari</span>
                    <input type="text" name="tanggal-dari" id="tanggal-dari">
                </label>
                <label for="tanggal-sampai">
                    <span>Tanggal Sampai</span>
                    <input type="text" name="tanggal-sampai" id="tanggal-sampai">
                </label>
                <button type="button">Cari</button>
            </section>
            <section class="d-flex gap-5 mb-3 justify-content-end">
                <a href="#" class="link-dark">Unduh Laporan</a>
            </section>
            <table class="table table-responsive">
                <thead class="table-dark">
                    <tr>
                        <th style="padding: 10px auto" class="align-middle">no</th>
                        <th style="padding: 10px auto" class="align-middle">tanggal</th>
                        <th style="padding: 10px auto" class="align-middle">ID Pesanan</th>
                        <th style="padding: 10px auto" class="align-middle">produk</th>
                        <th style="padding: 10px auto" class="align-middle">quantity</th>
                        <th class="text-nowrap px-2 align-middle">price total</th>
                        <th class="text-nowrap px-2 align-middle">metode pengambilan</th>
                        <th class="text-nowrap px-2 align-middle">status pembayaran</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="padding: 10px auto" class="align-middle">1</td>
                        <td style="padding: 10px auto" class="align-middle">21-09-2025</td>
                        <td style="padding: 10px auto" class="align-middle">1</td>
                        <td style="padding: 10px auto" class="align-middle text-nowrap">Mie ayam komplit</td>
                        <td style="padding: 10px auto" class="align-middle">1</td>
                        <td style="padding: 10px auto" class="align-middle">Rp 18.000</td>
                        <td style="padding: 10px auto" class="align-middle">Diantar ke Lokasi</td>
                        <td style="padding: 10px auto" class="align-middle">
                            <span class="text-success fw-bold">Selesai</span>
                        </td>
                    </tr>
                </tbody>
            </table>
            
        </div>
    </main>
@endsection
