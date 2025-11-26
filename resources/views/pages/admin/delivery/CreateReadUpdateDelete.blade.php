@extends('layouts.admin')

@section('title', 'Pengantaran | Miesabi')

@section('content')
    <div class="container">
        <section class="pt-3 row px-3">
            <form class="col-12 col-lg-6 row bg-yellow-400 rounded p-3 mb-4 mx-auto" method="POST" action="{{ isset($delivery) ? route('a.deliveries.update', $delivery->id) : route('a.deliveries.store')  }}">
                @csrf
                @if(isset($delivery))
                    @method('PUT')
                @endif

                <div class="col-6 p-3">
                    <div>
                        <label for="name" class="form-label">Nama Variasi</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ $delivery->name ?? '' }}">
                    </div>
                </div>
                <div class="col-6 p-3">
                    <div>
                        <label for="price" class="form-label">Harga Tambahan</label>
                        <input type="text" class="form-control" name="price" id="price" value="{{ $delivery->price ?? '' }}">
                    </div>
                </div>

                <div class="d-flex align-items-center gap-3 justify-content-end">
                    @if(isset($delivery))
                        <a href="{{ route('a.deliveries.index') }}" class="link-dark fw-bold">Kembali</a>
                    @endif
                    <button type="submit" class="d-block border-0 bg-yellow-500 py-2 px-4 rounded text-white">{{ isset($delivery) ? "Simpan" : "Tambah" }}</button>
                </div>
            </form>
        </section>

        <section class="">
            <div class="d-block d-md-flex align-items-center gap-5 py-2 justify-content-lg-between">
                    <h3 class="text-center text-lg-left">Produk Setting</h3>
                    <div class="d-flex align-items-center justify-content-between gap-lg-5">
                        <a href="{{ route('a.products.index') }}" class="nav-link">Products</a>
                        <a href="{{ route('a.categories.index') }}" class="nav-link">Categories</a>
                        <a href="{{ route('a.variants.index') }}" class="nav-link">Variants</a>
                        <a href="{{ route('a.deliveries.index') }}" class="nav-link">Deliveries</a>
                    </div>
                </div>
            <div class="table-responsive">
                <table id="datas" class="table table-striped">
                    <thead>
                        <tr class="header">
                            <th >Jenis Pengantaran</th>
                            <th >Harga Tambahan</th>
                            <th >Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas as $data)
                            <tr class="data-{{ $data->id }}">
                                <td class="align-middle">{{ $data->name }}</td>
                                <td class="align-middle">Rp {{ number_format($data->price, 0, ',', '.') }}</td>
                                <td class="align-middle text-nowrap">
                                    <a href="{{ route('a.deliveries.edit', $data->id) }}" class="btn btn-outline-primary">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                    <form method="POST" action="{{ route("a.deliveries.destroy", $data->id) }}" class="d-inline ms-2">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger">
                                            <i class="bi bi-eraser-fill"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </div>
@endsection
