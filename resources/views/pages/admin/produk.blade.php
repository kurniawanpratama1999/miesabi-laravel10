@extends('layouts.admin')

@section('title', 'Produk | Mie Sabi')

@section('section')
    <main style="min-height: calc(100dvh - 3.5rem);" class="overflow-hidden container-fluid mx-auto bg-young-brown">
        <div class="container mx-auto py-4">
            <h4>Kelola Produk</h4>
            <section class="d-flex gap-5 mb-3 justify-content-end">
                <a href="#" class="link-dark">Tambah Produk</a>
            </section>
            <table class="table table-responsive">
                <thead class="table-dark">
                    <tr>
                        <th style="padding: 10px auto" class="align-middle">image</th>
                        <th style="padding: 10px auto" class="align-middle">name</th>
                        <th style="padding: 10px auto" class="align-middle">variant</th>
                        <th style="padding: 10px auto" class="align-middle">price</th>
                        <th class="text-nowrap px-2 align-middle">stock</th>
                        <th style="padding: 10px auto" class="align-middle text-center">action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="padding: 10px auto" class="align-middle"></td>
                        <td style="padding: 10px auto" class="align-middle">Mie Ayam Pangsit</td>
                        <td style="padding: 10px auto" class="align-middle">Original</td>
                        <td style="padding: 10px auto" class="align-middle text-nowrap">Rp 20.000</td>
                        <td style="padding: 10px auto" class="align-middle">30 Porsi</td>
                        <td style="padding: 10px auto" class="align-middle">
                            <button class="bg-danger rounded-pill px-4 text-nowrap d-block text-white mx-auto">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
            
        </div>
    </main>
@endsection
