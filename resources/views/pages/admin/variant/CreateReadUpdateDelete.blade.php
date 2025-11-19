@extends('layouts.admin')

@section('title', 'Variant | Miesabi')

@section('content')
    <main>
        <section>
            <h2>Variant Produk</h2>
            <form method="POST" action="{{ isset($variant) ? route('variant.update', $variant->id) : route('variant.store')  }}">
                @csrf
                @if(isset($variant))
                    @method('PUT')
                @endif
                <label for="product_id">
                    <select name="product_id" id="product_id">
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
                    </select>
                </label>
                <label for="name">
                    <input type="text" name="name" id="name" value="{{ $variant->name ?? '' }}">
                </label>
                <label for="price">
                    <input type="text" name="price" id="price" value="{{ $variant->price ?? '' }}">
                </label>
                
                <div>
                    <button type="submit">{{ isset($variant) ? "Simpan" : "Tambah" }}</button>
                    @if(isset($variant))
                        <a href="{{ route('variant.index') }}">Kembali</a>
                    @endif
                </div>
            </form>
        </section>
        
        <section>
            <table id="datas">
                <tr class="header">
                    <th>Untuk Produk</th>
                    <th>Nama Variant</th>
                    <th>Penambahan Harga</th>
                    <th>Aksi</th>
                </tr>
                @foreach ($datas as $data)
                    <tr class="data-{{ $data->id }}">
                        <td>
                            <a href="{{ route('variant.edit', $data->id) }}">{{ $data->product_name }}</a>
                        </td>
                        <td>
                            <a href="{{ route('variant.edit', $data->id) }}">{{ $data->name }}</a>
                        </td>
                        <td>
                            <a href="{{ route('variant.edit', $data->id) }}">{{ $data->price }}</a>
                        </td>
                        <td>
                            <form method="POST" action="{{ route("variant.destroy", $data->id) }}">
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
                location.href = '/variant';
            }
        })
    </script>
@endPushOnce