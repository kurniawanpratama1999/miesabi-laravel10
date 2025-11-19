@extends('layouts.admin')

@section('title', 'Kategori Produk | Miesabi')

@section('content')
    <main>
        <section>
            <h2>Kategori Produk</h2>
            <form method="POST" action="{{ isset($category) ? route('category.update', $category->id) : route('category.store')  }}">
                @csrf
                @if(isset($category))
                    @method('PUT')
                @endif
                <label for="name">
                    <input type="text" name="name" id="name" value="{{ $category->name ?? '' }}">
                </label>
                
                <div>
                    <button type="submit">{{ isset($category) ? "Simpan" : "Tambah" }}</button>
                    @if(isset($category))
                        <a href="{{ route('category.index') }}">Kembali</a>
                    @endif
                </div>
            </form>
        </section>
        <section>
            <table id="datas">
                <tr class="header">
                    <th>Nama Kategori</th>
                    <th>Aksi</th>
                </tr>
                @foreach ($datas as $data)
                    <tr class="data-{{ $data->id }}">
                        <td>
                            <a href="{{ route('category.edit', $data->id) }}">{{ $data->name }}</a>
                        </td>
                        <td>
                            <form method="POST" action="{{ route("category.destroy", $data->id) }}">
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
                location.href = '/category';
            }
        })
    </script>
@endPushOnce