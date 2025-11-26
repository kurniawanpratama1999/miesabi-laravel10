@extends('layouts.admin')

@section('title', 'Variant | Miesabi')

@section('content')
    <div class="container">
        <section class="pt-3 row px-3">
            <form class="col-12 col-lg-6 row bg-yellow-400 rounded p-3 mb-4 mx-auto" method="POST" action="{{ isset($variant) ? route('a.variants.update', $variant->id) : route('variants.store')  }}">
                @csrf
                @if(isset($variant))
                    @method('PUT')
                @endif
                <div class="col-12 p-3">
                    <div>
                        <label for="product_id" class="form-label">Nama Produk</label>
                        <select name="product_id" id="product_id" class="form-select" aria-label="product_id">
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-6 p-3">
                    <div>
                        <label for="name" class="form-label">Nama Variasi</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ $variant->name ?? '' }}">
                    </div>
                </div>
                <div class="col-6 p-3">
                    <div>
                        <label for="price" class="form-label">Harga Tambahan</label>
                        <input type="text" class="form-control" name="price" id="price" value="{{ $variant->price ?? '' }}">
                    </div>
                </div>

                <div class="d-flex align-items-center gap-3 justify-content-end">
                    @if(isset($variant))
                        <a href="{{ route('a.variants.index') }}" class="link-dark fw-bold">Kembali</a>
                    @endif
                    <button type="submit" class="d-block border-0 bg-yellow-500 py-2 px-4 rounded text-white">{{ isset($variant) ? "Simpan" : "Tambah" }}</button>
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
                            <th >Nama Produk</th>
                            <th >Variasi Produk</th>
                            <th >Harga Tambahan</th>
                            <th >Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($datas as $data)
                            <tr class="data-{{ $data->id }}">
                                <td class="align-middle">{{ $data->product_name }}</td>
                                <td class="align-middle">{{ $data->name }}</td>
                                <td class="align-middle">Rp {{ number_format($data->price, 0, ',', '.') }}</td>
                                <td class="align-middle text-nowrap">
                                    <a href="{{ route('a.variants.edit', $data->id) }}" class="btn btn-outline-primary">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                    <form method="POST" action="{{ route("a.variants.destroy", $data->id) }}" class="d-inline ms-2">
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
