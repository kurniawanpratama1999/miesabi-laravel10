@extends('layouts.user')

@section('title', 'Keranjang | Mie Sabi')

@section('section')
    <main style="height: calc(100dvh - 3.5rem);" class="row overflow-hidden container-fluid mx-auto bg-young-brown">
        <section style="height: calc(100dvh - 3.5rem);" class="col-7 overflow-y-auto row gap-4 p-4 justify-content-evenly">
            @foreach ([1,2,3,4,5] as $produk)
            <div style="" class="col-4 bg-white p-2 ">
                <div style="aspect-ratio: 1/1;" class="border"></div>
                <div class="p-3">
                    <span class="text-center fw-bold d-block">Mie Ayam Special</span>

                    <div class="d-flex flex-column mt-3 gap-3">
                        <span class="text-center">Pilih Varian</span>
                        <div class="d-flex align-items-center justify-content-between">
                            <span class="px-3 py-1 rounded-5 bg-old-brown text-white">Original</span>
                            <div class="d-flex gap-2 justify-content-center">
                                <button style="min-width: 30px; min-height: 30px; max-width: 30px; max-height: 30px" class="rounded-circle border-0">-</button>
                                <input type="number" style="width: 20px; border: 0; outline-0" class="bg-transparent text-center" value="0">
                                <button style="min-width: 30px; min-height: 30px; max-width: 30px; max-height: 30px" class="rounded-circle border-0">+</button>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <span class="px-3 py-1 rounded-5 bg-old-brown text-white">Yamin</span>
                            <div class="d-flex gap-2 justify-content-center">
                                <button style="min-width: 30px; min-height: 30px; max-width: 30px; max-height: 30px" class="rounded-circle border-0">-</button>
                                <input type="number" style="width: 20px; border: 0; outline-0" class="bg-transparent text-center" value="0">
                                <button style="min-width: 30px; min-height: 30px; max-width: 30px; max-height: 30px" class="rounded-circle border-0">+</button>
                            </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <span class="px-3 py-1 rounded-5 bg-old-brown text-white">Chili Oil</span>
                            <div class="d-flex gap-2 justify-content-center">
                                <button style="min-width: 30px; min-height: 30px; max-width: 30px; max-height: 30px" class="rounded-circle border-0">-</button>
                                <input type="number" style="width: 20px; border: 0; outline-0" class="bg-transparent text-center" value="0">
                                <button style="min-width: 30px; min-height: 30px; max-width: 30px; max-height: 30px" class="rounded-circle border-0">+</button>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-2 justify-content-center mt-3">
                        <button style="min-width: 30px; min-height: 30px; max-width: 30px; max-height: 30px" class="rounded-circle border-0">-</button>
                        <input type="number" style="width: 70px; border: 0; outline-0" class="bg-transparent text-center" value="0">
                        <button style="min-width: 30px; min-height: 30px; max-width: 30px; max-height: 30px" class="rounded-circle border-0">+</button>
                    </div>
                </div>
            </div>
            @endforeach
        </section>
        <section style="height: calc(100dvh - 3.5rem);" class="col-5 p-3 overflow-y-auto">
            <span class="d-block text-center fw-bold fs-4">Pilih Metode Pengambilan Pesanan</span>
            <span class="d-block text-center fs-6">Silakan pilih cara yang paling nyaman untuk menerima pesanan anda</span>

            <div class="d-flex justify-content-center gap-5 mt-3">
                <div>
                    <div style="width: 150px; height: 150px;" class="border mb-2">

                    </div>
                    <span class="d-block text-center">Ambil di Gerai</span>
                </div>
                <div>
                    <div style="width: 150px; height: 150px;" class="border mb-2">

                    </div>
                    <span class="d-block text-center">Antar ke Lokasi</span>
                </div>
            </div>

            <form class="mt-4 d-flex flex-column gap-4">
                <label for="" class="d-flex flex-column gap-1 ">
                    <span>Catatan Tambahan</span>
                    <textarea name="" id="" style="outline: 0; resize: none;" class="p-2 border-0"></textarea>
                </label>
                <label for="" class="d-flex flex-column gap-1 ">
                    <span>Alamat Lengkap</span>
                    <textarea name="" id="" style="outline: 0; resize: none;" class="p-2 border-0"></textarea>
                </label>
                <label for="" class="d-flex flex-column gap-1 ">
                    <span>No. Telp / Whatsapp</span>
                    <input type="text" name="" id="" style="outline: 0; resize: none;" class="p-2 border-0" maxlength="13">
                </label>

                <button type="submit" class="btn bg-old-brown text-white rounded-0">Chekout</button>
            </form>
        </section>
    </main>
@endsection