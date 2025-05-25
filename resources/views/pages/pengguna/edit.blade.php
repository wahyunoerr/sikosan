@extends('layouts.app')
@section('title', 'Edit Data Pengguna')
@section('content')
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <form class="form theme-form" action="{{ route('pengguna.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label>Nama Pengguna</label>
                                <input class="form-control @error('name') is-invalid @enderror" type="text"
                                    placeholder="Nama Pengguna" name="name" value="{{ $user->name }}">
                                @error('name')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label>Email</label>
                                <input class="form-control @error('email') is-invalid @enderror" type="email"
                                    placeholder="Email" name="email" value="{{ $user->email }}">
                                @error('email')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label>Password</label>
                                <input class="form-control @error('password') is-invalid @enderror" type="password"
                                    placeholder="Password" name="password">
                                @error('password')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label>Confirm Password</label>
                                <input class="form-control @error('password_confirmation') is-invalid @enderror"
                                    type="password" placeholder="Confirm Password" name="password_confirmation">
                                @error('password_confirmation')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label>Role</label>
                                <select name="role" class="form-select @error('role') is-invalid @enderror">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->name }}"
                                            {{ $user->roles->first()->name == $role->name ? 'selected' : '' }}>
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('role')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="text-end">
                                <button class="btn btn-success me-3" type="submit">Ubah</button>
                                <a class="btn btn-danger" href="{{ url('/pengguna') }}">Batal</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
