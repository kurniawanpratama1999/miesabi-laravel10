@extends('layouts.admin')

@section('title', 'Produk | Miesabi')

@section('content')
    <main>
        <section>
            <h2>Daftar Produk</h2>
            <form method="POST" action="{{ isset($product) ? route('product.update', $product->id) : route('product.store')  }}">
                @csrf
                @if(isset($product))
                    @method('PUT')
                @endif
                <label for="category_id">
                    <select name="category_id" id="category_id">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </label>
                <label for="name">
                    <input type="text" name="name" id="name" value="{{ $product->name ?? '' }}">
                </label>
                <label for="price">
                    <input type="text" name="price" id="price" value="{{ $product->price ?? '' }}">
                </label>
                <label for="stock">
                    <input type="text" name="stock" id="stock" value="{{ $product->stock ?? '' }}">
                </label>

                <div>
                    <button type="submit">{{ isset($product) ? "Simpan" : "Tambah" }}</button>
                    @if(isset($product))
                        <a href="{{ route('product.index') }}">Kembali</a>
                    @endif
                </div>
            </form>
        </section>

        <section>
            <table id="datas">
                <tr class="header">
                    <th>Nama</th>
                    <th>Kategori</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
                @foreach ($datas as $data)
                    <tr class="data-{{ $data->id }}">
                        <td>
                            <a href="{{ route('product.edit', $data->id) }}">{{ $data->name }}</a>
                        </td>
                        <td>
                            <a href="{{ route('product.edit', $data->id) }}">{{ $data->category_name }}</a>
                        </td>
                        <td>
                            <a href="{{ route('product.edit', $data->id) }}">{{ $data->price }}</a>
                        </td>
                        <td>
                            <a href="{{ route('product.edit', $data->id) }}">{{ $data->stock }}</a>
                        </td>
                        <td>
                            <form method="POST" action="{{ route("product.destroy", $data->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit">DELETE</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        </section>

    </main>
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
