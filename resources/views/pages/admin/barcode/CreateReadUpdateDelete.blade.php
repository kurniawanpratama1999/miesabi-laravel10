@extends('layouts.admin')

@section('title', 'Produk | Miesabi')

@section('content')
        <div class="container">
            <section class="pt-3">
                <form class="row bg-yellow-400 rounded p-3 mb-4 w-50 mx-auto" method="POST" action="{{ isset($user) ? route('users.update', $user->id) : route('users.store')  }}">
                    @csrf
                    @if(isset($user))
                        @method('PUT')
                    @endif
                    <div class="col-12 p-3">
                        <div>
                            <label for="barcode" class="form-label">Barcode</label>
                            <input type="file" class="form-control" name="barcode" id="barcode" value="{{ $user->name ?? '' }}">
                        </div>
                    </div>

                    <div class="d-flex align-items-center gap-3 justify-content-end">
                        @if(isset($user))
                            <a href="{{ route('users.index') }}" class="link-dark fw-bold">Kembali</a>
                        @endif
                        <button type="submit" class="d-block border-0 bg-yellow-500 py-2 px-4 rounded text-white">{{ isset($user) ? "Simpan" : "Tambah" }}</button>
                    </div>
                </form>
            </section>

            <section>
                <div>
                    <img src="{{ asset('storage/' . $barcode->photo) }}">
                </div>
                <div class="align-middle">
                    <a href="{{ route('users.edit', $data->id) }}" class="btn btn-outline-primary">
                        <i class="bi bi-pencil-fill"></i>
                    </a>

                    @if(Auth::user()->id !== $data->id)
                    <form method="POST" action="{{ route("users.destroy", $data->id) }}" class="d-inline ms-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger">
                            <i class="bi bi-eraser-fill"></i>
                        </button>
                    </form>
                    @endif
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
