@extends('layout')

@section('title', 'User | Miesabi')

@section('content')
        <div class="container">
            <section class="pt-3 row px-3">
                <x-form-modal 
                    method="{{ isset($variant) ? 'PUT' : 'POST' }}"
                    title="{{ isset($user) ? 'Sunting User' : 'Tambah User' }}" 
                    action="{{ isset($user) ? route('a.users.update', $user->id) : route('a.users.store') }}">

                    <div class="col-6">
                        <x-form-input idprop="name" labelprop="Nama Lengkap" typeprop="text" :model="$user ?? null" />
                    </div>
                    
                    <div class="col-6">
                        <x-form-select idprop="role" labelprop="Role" :model="$user ?? null" :options="[['id' => 'admin', 'name' => 'admin'], ['id' => 'user', 'name' => 'user']]"/>
                    </div>

                    <div class="col-6">
                        <x-form-input idprop="username" labelprop="Username" typeprop="text" :model="$user ?? null" />
                    </div>

                    <div class="col-6">
                        <x-form-input idprop="email" labelprop="Email" typeprop="email" :model="$user ?? null" />
                    </div>

                    <div class="col-12">
                        <x-form-input idprop="phone" labelprop="Nomor Telepon" typeprop="text" :model="$user ?? null" />
                    </div>

                    <div class="col-12">
                        <x-form-input idprop="password" labelprop="Password" typeprop="password" />
                    </div>

                    <div class="col-12">
                        <x-form-input idprop="password_confirmation" labelprop="Konfirmasi Password" typeprop="password" />
                    </div>

                    <div class="d-flex align-items-center gap-3 justify-content-end">
                        @if(isset($user))
                            <a href="{{ route('a.users.index') }}" class="link-dark fw-bold">Kembali</a>
                        @endif
                        <button type="submit" class="d-block border-0 bg-yellow-500 py-2 px-4 rounded text-white">{{ isset($user) ? "Simpan" : "Tambah" }}</button>
                    </div>
                </x-form-modal>
            </section>

            <section class="pb-5">
                <div class="container my-4">
                    <div class="card shadow-sm border-0 rounded-4">
                        <div class="card-header bg-white py-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0 fw-semibold">Product Collection</h5>

                                @if(!isset($product))
                                <div class="d-flex align-items-center gap-3">
                                    <button id="btn-tambah-data" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#formModal">
                                        Tambah Data
                                    </button>
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="table-responsive" style="max-height: 420px;">
                            <table class="table align-middle table-hover mb-0 modern-table">
                                <thead class="sticky-top bg-white shadow-sm">
                                    <tr>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>No Telepon</th>
                                        <th>Tanggal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datas as $data)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="ms-2">
                                                        <div class="fw-semibold">{{ $data->name }}</div>
                                                        <div class="text-muted small">{{ $data->role }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="ms-2 d-flex flex-column align-items-start gap-1">
                                                        <div class="badge bg-warning-light text-black">{{ $data->username }}</div> 
                                                        <div class="badge bg-success-light text-success">{{ $data->email }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><span>{{ $data->phone }}</span></td>
                                            <td>{{ $data->created_at }}</td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <a href="{{ route('a.users.edit', $data->id) }}" class="btn btn-sm btn-light border"><i class="bi bi-pencil"></i></a>
                                                    <form method="POST" action="{{ route("a.users.destroy", $data->id) }}" class="d-inline ms-2">
                                                        @csrf   
                                                        @method('DELETE')
                                                        <button class="btn btn-sm btn-light border"><i class="bi bi-trash"></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </div>
@endsection

@if(isset($user))
    @push('scripts')
    <script>
        window.addEventListener('load', () => {
            new bootstrap.Modal('#formModal', {
            }).show();

            const myModalEl = document.getElementById('formModal')
            myModalEl.addEventListener('hidden.bs.modal', event => {
                location.href = "{{ route('a.users.index') }}"
            })
        })
    </script>
    @endpush
@endif