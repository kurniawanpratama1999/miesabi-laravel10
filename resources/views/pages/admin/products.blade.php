@extends('layout')

@section('title', 'Produk | Miesabi')

@section('content')
        <div class="container">
            <section class="pt-3 row px-3">
                <x-form-modal method="{{ isset($variant) ? 'PUT' : 'POST' }}" title="{{ isset($product) ? 'Sunting Produk' : 'Tambah Produk' }}" action="{{ isset($product) ? route('a.products.update', $product->id) : route('a.products.store') }}">
                    <div class="col-12">
                        <x-form-input idprop="photo" labelprop="Foto Produk" typeprop="file" />
                    </div>
                    
                    <div class="col-12">
                        <x-form-select idprop="category_id" labelprop="Kategori Produk" :model="$product ?? null" :options="$categories"/>
                    </div>

                    <div class="col-12">
                        <x-form-input idprop="name" labelprop="Nama Produk" typeprop="text" :model="$product ?? null" />
                    </div>

                    <div class="col-6">
                        <x-form-input idprop="price" labelprop="Harga Produk" typeprop="number" :model="$product ?? null" />
                    </div>

                    <div class="col-6">
                        <x-form-input idprop="stock" labelprop="Stok Produk" typeprop="number" :model="$product ?? null" />
                    </div>

                    <div class="d-flex align-items-center gap-3 justify-content-end">
                        @if(isset($product))
                            <a href="{{ route('a.products.index') }}" class="link-dark fw-bold">Kembali</a>
                        @endif
                        <button type="submit" class="d-block border-0 bg-yellow-500 py-2 px-4 rounded text-white">{{ isset($product) ? "Simpan" : "Tambah" }}</button>
                    </div>
                </x-form-modal>
            </section>

            <section class="pb-5">
                <div class="container my-4">
                    <div class="card shadow-sm border-0 rounded-4">
                        <div class="card-header bg-white py-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0 fw-semibold">Product Collection</h5>

                                @if(!isset($product))
                                <div class="d-flex align-items-center gap-3">
                                    <button id="btn-tambah-data" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#formModal">
                                        Tambah Data
                                    </button>
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="table-responsive" style="max-height: 420px;">
                            <table class="table align-middle table-hover mb-0 modern-table">
                                <thead class="sticky-top bg-white shadow-sm">
                                    <tr>
                                        <th>Nama</th>
                                        <th>Harga</th>
                                        <th>Stok</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datas as $data)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-circle position-relative">
                                                        @if (isset($data, $data->photo))
                                                            <img src="{{ asset('storage/' . $data->photo) }}" style="object-position: center" class="object-fit-cover" width="100%" height="100%">
                                                        @else
                                                            <i class="bi bi-fork-knife fs-3 position-absolute top-50 start-50 translate-middle text-black"></i>
                                                        @endif
                                                    </div>
                                                    <div class="ms-2">
                                                        <div class="fw-semibold">{{ $data->name }}</div>
                                                        <div class="text-muted small">{{ $data->category_name }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>Rp {{ number_format($data->price, 0, ',', '.') }}</td>
                                            <td><span class="badge bg-success-light text-success">{{ $data->stock }}</span></td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <a href="{{ route('a.products.edit', $data->id) }}" class="btn btn-sm btn-light border"><i class="bi bi-pencil"></i></a>
                                                    <form method="POST" action="{{ route("a.products.destroy", $data->id) }}" class="d-inline ms-2">
                                                        @csrf   
                                                        @method('DELETE')
                                                        <button class="btn btn-sm btn-light border"><i class="bi bi-trash"></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </div>
@endsection

@if(isset($product))
    @push('scripts')
    <script>
        window.addEventListener('load', () => {
            new bootstrap.Modal('#formModal', {
            }).show();

            const myModalEl = document.getElementById('formModal')
            myModalEl.addEventListener('hidden.bs.modal', event => {
                location.href = "{{ route('a.products.index') }}"
            })


        })
    </script>
    @endpush
@endif