@extends('layouts.admin')

@section('title', 'Pengantaran | Miesabi')

@section('content')
    <main>
        <section>
            <h2>Jenis Pengantaran</h2>
            <form method="POST" action="{{ isset($delivery) ? route('delivery.update', $delivery->id) : route('delivery.store')  }}">
                @csrf
                @if(isset($delivery))
                    @method('PUT')
                @endif
                <label for="name">
                    <input type="text" name="name" id="name" value="{{ $delivery->name ?? '' }}">
                </label>
                <label for="price">
                    <input type="text" name="price" id="price" value="{{ $delivery->price ?? '' }}">
                </label>
                
                <div>
                    <button type="submit">{{ isset($delivery) ? "Simpan" : "Tambah" }}</button>
                    @if(isset($delivery))
                        <a href="{{ route('delivery.index') }}">Kembali</a>
                    @endif
                </div>
            </form>
        </section>

        <section>
            <table id="datas">
                <tr class="header">
                    <th>Jenis</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
                @foreach ($datas as $data)
                    <tr class="data-{{ $data->id }}">
                        <td>
                            <a href="{{ route('delivery.edit', $data->id) }}">{{ $data->name }}</a>
                        </td>
                        <td>
                            <a href="{{ route('delivery.edit', $data->id) }}">{{ $data->price }}</a>
                        </td>
                        <td>
                            <form method="POST" action="{{ route("delivery.destroy", $data->id) }}">
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
                location.href = '/delivery';
            }
        })
    </script>
@endPushOnce