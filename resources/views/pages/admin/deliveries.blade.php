@extends('layout')

@section('title', 'Pengantaran | Miesabi')

@section('content')
    <div class="container">
        <section class="pt-3 row px-3">
            <x-form-modal method="{{ isset($variant) ? 'PUT' : 'POST' }}" title="{{ isset($delivery) ? 'Sunting Pengantaran' : 'Tambah Pengantaran' }}" action="{{ isset($delivery) ? route('a.deliveries.update', $delivery->id) : route('a.deliveries.store') }}">
                <div class="col-12">
                    <x-form-input idprop="name" labelprop="Nama Produk" typeprop="text" :model="$delivery ?? null" />
                </div>

                <div class="col-6">
                    <x-form-input idprop="price" labelprop="Harga Produk" typeprop="number" :model="$delivery ?? null" />
                </div>

                <div class="d-flex align-items-center gap-3 justify-content-end">
                    @if(isset($delivery))
                        <a href="{{ route('a.deliveries.index') }}" class="link-dark fw-bold">Kembali</a>
                    @endif
                    <button type="submit" class="d-block border-0 bg-yellow-500 py-2 px-4 rounded text-white">{{ isset($delivery) ? "Simpan" : "Tambah" }}</button>
                </div>
            </x-form-modal>
        </section>

        <section class="pb-5">
            <div class="container my-4">
                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-header bg-white py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0 fw-semibold">Type Of Delivery</h5>

                            @if(!isset($delivery))
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
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $data)
                                    <tr>
                                        <td><div claxss="fw-semibold">{{ $data->name }}</div></td>
                                        <td>Rp {{ number_format($data->price, 0, ',', '.') }}</td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('a.deliveries.edit', $data->id) }}" class="btn btn-sm btn-light border"><i class="bi bi-pencil"></i></a>
                                                <form method="POST" action="{{ route("a.deliveries.destroy", $data->id) }}" class="d-inline ms-2">
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

@if(isset($delivery))
    @push('scripts')
    <script>
        window.addEventListener('load', () => {
            new bootstrap.Modal('#formModal', {
            }).show();

            const myModalEl = document.getElementById('formModal')
            myModalEl.addEventListener('hidden.bs.modal', event => {
                location.href = "{{ route('a.deliveries.index') }}"
            })
        })
    </script>
    @endpush
@endif