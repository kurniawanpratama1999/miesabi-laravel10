@extends('layouts.admin')

@section('title', 'Kategori Produk | Miesabi')

@section('content')
        <div class="container">
            <section class="pt-3 px-3 row">
                <form class="col-12 col-lg-6 row bg-yellow-400 rounded p-3 mb-4 mx-auto" method="POST" action="{{ isset($category) ? route('a.categories.update', $category->id) : route('categories.store')  }}">
                    @csrf
                    @if(isset($category))
                        @method('PUT')
                    @endif
                    <div class="col-12 p-3">
                        <div>
                            <label for="name" class="form-label">Category Name</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ $category->name ?? '' }}">
                        </div>
                    </div>

                    <div class="d-flex align-items-center gap-3 justify-content-end">
                        @if(isset($category))
                            <a href="{{ route('a.categories.index') }}" class="link-dark fw-bold">Kembali</a>
                        @endif
                        <button type="submit" class="d-block border-0 bg-yellow-500 py-2 px-4 rounded text-white">{{ isset($category) ? "Simpan" : "Tambah" }}</button>
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
                                <th class="w-100">Nama</th>
                                <th >Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datas as $data)
                                <tr class="data-{{ $data->id }}">
                                    <td class="align-middle">{{ $data->name }}</td>
                                    <td class="align-middle text-nowrap">
                                        <a href="{{ route('a.categories.edit', $data->id) }}" class="btn btn-outline-primary">
                                            <i class="bi bi-pencil-fill"></i>
                                        </a>
                                        <form method="POST" action="{{ route("a.categories.destroy", $data->id) }}" class="d-inline ms-2">
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

