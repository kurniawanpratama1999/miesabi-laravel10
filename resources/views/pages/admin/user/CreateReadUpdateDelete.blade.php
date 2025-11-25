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
                    <div class="col-6 p-3">
                        <div>
                            <label for="name" class="form-label">User FullName</label>
                            <input type="text" class="form-control" name="name" id="name" value="{{ $user->name ?? '' }}">
                        </div>
                    </div>
                    <div class="col-6 p-3">
                        <div>
                            <label for="role" class="form-label">Role</label>
                            <select name="role" id="role" class="form-select" aria-label="role">
                                @foreach ($roles as $role)
                                    <option value="{{ $role }}">{{ $role }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-6 p-3">
                        <div>
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" name="username" id="username" value="{{ $user->username ?? '' }}">
                        </div>
                    </div>
                    <div class="col-6 p-3">
                        <div>
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" id="email" value="{{ $user->email ?? '' }}">
                        </div>
                    </div>
                    <div class="col-12 p-3">
                        <div>
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" name="phone" id="phone" value="{{ $user->phone ?? '' }}">
                        </div>
                    </div>
                    <div class="col-6 p-3">
                        <div>
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" id="password" value="">
                        </div>
                    </div>
                    <div class="col-6 p-3">
                        <div>
                            <label for="password_confirmation" class="form-label">Password Confirmation</label>
                            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" value="">
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

            <section class="">
                <div class="d-block d-md-flex align-items-center gap-5 py-3">
                    <h3>Daftar User</h3>
                </div>
                <div class="table-responsive">
                    <table id="datas" class="table table-striped">
                        <thead>
                            <tr class="header">
                                <th>Nama</th>
                                <th>Role</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Date</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datas as $data)
                                <tr class="data-{{ $data->id }}">
                                    <td class="align-middle">{{ $data->name }}</td>
                                    <td class="align-middle"><span>{{ $data->role }}</span></td>
                                    <td class="align-middle"><span>{{ $data->username }}</span></td>
                                    <td class="align-middle"><span >{{ $data->email }}</span></td>
                                    <td class="align-middle"><span >{{ $data->phone }}</span></td>
                                    <td class="align-middle"><span >{{ $data->created_at }}</span></td>
                                    <td class="align-middle">
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
