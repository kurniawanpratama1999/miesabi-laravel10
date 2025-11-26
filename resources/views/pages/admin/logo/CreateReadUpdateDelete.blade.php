@extends('layouts.admin')

@section('title', 'Logo | Miesabi')

@section('content')
        <div class="container">
            <section class="pt-3">
                <form enctype="multipart/form-data" style="width: 350px;" class="row bg-yellow-400 rounded p-3 mb-4 mx-auto" method="POST" action="{{ isset($data, $data->photo) ? route('a.logo.update', $data->id) : route('a.logo.store')  }}">
                    <div style="width: 300px; aspect-ratio: 1/1;" class="overflow-hidden mx-auto">
                        @if ($data && $data->photo)
                            <img src="{{ asset('storage/' . $data->photo) }}" class="w-100 h-100 object-fit-contain rounded">
                        @endif
                    </div>
                    @csrf
                    @if(isset($data, $data->photo))
                        @method('PUT')
                    @endif
                    <div class="col-12 p-3">
                        <div>
                            <label for="photo" class="form-label">Logo</label>
                            <input type="file" class="form-control" name="photo" id="photo" value="{{ ($data && $data->photo) ? $data->photo : "" }}">
                        </div>
                    </div>

                    <div class="d-flex align-items-center gap-3 justify-content-end">
                        <button type="submit" class="d-block border-0 bg-yellow-500 py-2 px-4 rounded text-white">{{ isset($data, $data->photo) ? "Update" : "Tambah" }}</button>
                    </div>
                </form>
            </section>
        </div>
@endsection
