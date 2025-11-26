@extends('layout')

@section('title', 'Barcode | Miesabi')

@section('content')
        <div class="container">
            <section class="pt-3 row">
                <form enctype="multipart/form-data" class="col-12 col-lg-4 row bg-yellow-200 rounded p-3 mb-4 mx-auto" method="POST" action="{{ isset($data, $data->photo) ? route('a.barcode.update', $data->id) : route('a.barcode.store')  }}">
                    <h5 class="text-center mb-3">Upload Barcode</h5>
                    <div style="width: 300px; aspect-ratio: 1/1;" class="overflow-hidden mx-auto border position-relative bg-warning-subtle">
                        @if ($data && $data->photo)
                            <img src="{{ asset('storage/' . $data->photo) }}" class="w-100 h-100 object-fit-contain rounded">
                        @else
                            <i class="bi bi-qr-code start-50 top-50 translate-middle position-absolute" style="font-size: 13rem;"></i>
                        @endif
                    </div>
                    @csrf
                    @if(isset($data, $data->photo))
                        @method('PUT')
                    @endif
                    <div class="col-12 p-3">
                        <div>
                            <label for="photo" class="form-label">
                                <input type="file" class="form-control" name="photo" id="photo" value="{{ ($data && $data->photo) ? $data->photo : "" }}">
                            </label>
                        </div>
                    </div>

                    <div class="px-3">
                        <button type="submit" class="btn btn-warning w-100">{{ isset($data, $data->photo) ? "Update" : "Tambah" }}</button>
                    </div>
                </form>
            </section>
        </div>
@endsection
