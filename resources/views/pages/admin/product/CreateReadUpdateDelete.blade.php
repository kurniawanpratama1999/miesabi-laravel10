@extends('layouts.admin')

@section('title', 'Produk | Miesabi')

@section('content')

        <div class="container">
            <section class="pt-3">
                <form enctype="multipart/form-data" class="row bg-yellow-400 rounded p-3 mb-4 w-50 mx-auto" method="POST" action="{{ isset($product) ? route('products.update', $product->id) : route('products.store')  }}">
                    @csrf
                    @if(isset($product))
                        @method('PUT')
                    @endif
                    <div class="col-12 p-3">
                        <div>
                            <label for="photo" class="form-label">Photo Product</label>
                             <input type="file" class="form-control" name="photo" id="photo" value="{{ $product->photo ?? '' }}">
                        </div>
                    </div>
                    <div class="col-6 p-3">
                        <div>
                            <label for="category_id" class="form-label">Category Product</label>
                            <select name="category_id" id="category_id" class="form-select" aria-label="category_id">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-6 p-3">
                        <div>
                            <label for="name" class="form-label">Product Name</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ $product->name ?? '' }}">
                        </div>
                    </div>
                    <div class="col-6 p-3">
                        <div>
                            <label for="price" class="form-label">Product Price</label>
                            <input type="text" class="form-control" name="price" id="price" value="{{ $product->price ?? '' }}">
                        </div>
                    </div>
                    <div class="col-6 p-3">
                        <div>
                            <label for="stock" class="form-label">Product Stock</label>
                            <input type="text" class="form-control" name="stock" id="stock" value="{{ $product->stock ?? '' }}">
                        </div>
                    </div>

                    <div class="d-flex align-items-center gap-3 justify-content-end">
                        @if(isset($product))
                            <a href="{{ route('products.index') }}" class="link-dark fw-bold">Kembali</a>
                        @endif
                        <button type="submit" class="d-block border-0 bg-yellow-500 py-2 px-4 rounded text-white">{{ isset($product) ? "Simpan" : "Tambah" }}</button>
                    </div>
                </form>
            </section>

            <section class="">
                <h3>Daftar Produk</h3>
                <div class="table-responsive">
                    <table id="datas" class="table table-striped">
                        <thead>
                            <tr class="header">
                                <th>Nama</th>
                                <th>Image</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datas as $data)
                                <tr class="data-{{ $data->id }}">
                                    <td>{{ $data->name }}</td>
                                    <td>
                                        @if ($data->photo)
                                        <div style="width: 200px; aspect-ratio: 1/1;" class="img-thumbnail overflow-hidden">
                                            <img src="{{ asset('storage/' . $data->photo) }}" style="object-position: center" class="object-fit-cover" width="100%" height="100%">
                                        </div>
                                        @endif
                                    </td>
                                    <td><span>{{ $data->category_name }}</span></td>
                                    <td><span>Rp {{ number_format($data->price, 0, ',', '.') }}</span></td>
                                    <td><span >{{ number_format($data->stock, 0, ',', '.') }}</span></td>
                                    <td>
                                        <a href="{{ route('products.edit', $data->id) }}" class="btn btn-outline-primary">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>
                                        <form method="POST" action="{{ route("products.destroy", $data->id) }}" class="d-inline ms-2">
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

@pushOnce('scripts')
    <script>
        const NAME_TAG_INPUT = document.getElementById('name')

        NAME_TAG_INPUT.addEventListener('keyup', () => {
            if (NAME_TAG_INPUT.value === "") {
                location.href = '/product';
            }
        })
    </script>
@endPushOnce
