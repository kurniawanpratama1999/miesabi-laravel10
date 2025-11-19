@extends('layouts.user')

@section('title', 'Menu | Mie Sabi')

@pushOnce('styles')
    
@endPushOnce

@section('section')
<main class="bg-young-brown">
    <section class="p-4 row gap-4 justify-content-evenly container-fluid">
        <span class="fw-bold fs-3 text-old-brown">Daftar Menu</span>
        <div class="row gap-3 justify-content-evenly">
            @foreach ([1,2,3,4,5,6,7,8,9,10] as $produk)
                <div style="" class="col-2 bg-white p-2">
                    <div style="aspect-ratio: 1/1;" class="border"></div>
                    <div class="p-3">
                        <div class="d-flex flex-column">
                            <span class="text-center fw-bold">Mie Ayam Special</span>
                            <span class="text-center">Rp 20.000</span>
                        </div>
    
                        <div class="d-flex gap-2 justify-content-center mt-3">
                            <button style="min-width: 30px; min-height: 30px; max-width: 30px; max-height: 30px" class="rounded-circle border-0">-</button>
                            <input type="number" style="width: 70px; border: 0; outline-0" class="bg-transparent text-center" value="0">
                            <button style="min-width: 30px; min-height: 30px; max-width: 30px; max-height: 30px" class="rounded-circle border-0">+</button>
                        </div>

                        @if($produk % 2 == 0)
                        <span class="text-center fw-bold px-3 py-1 border d-block mx-auto mt-4">Terlaris</span>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</main>
@endsection