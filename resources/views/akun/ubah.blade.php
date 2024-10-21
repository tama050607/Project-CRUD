@extends('layouts.layout')
{{-- extends : untuk mengimport template @yield dari layout --}}
@section('content')
    <h1 class="text-center mt-4">Halaman Edit Barang</h1>
    <div class="d-flex justify-content-center">
        {{-- ',' memisahkan route dan id dinamis --}}
        <form action="{{route('kelola.edit.selesai', $akun['id'])}}" method="POST" class="card p-5 mt-4 d-flex w-75">
            @csrf
            {{-- Menimpa method lain --}}
            {{-- put digunakan jiga mengubah semua data sedangkan kalau patch tidak semua data --}}
            {{-- Mengecek Jika Success --}}
            {{--  --}}
            @method('PATCH')
            @if (Session::get('success'))
                <div class="alert alert-success"> {{ Session::get('success') }} </div>
            @endif

            {{-- Mengecek Jika Errors --}}
            @if ($errors->any())
                <ul class="alert alert-danger">
                    {{-- Memakai looping karena array(banyak data) --}}
                    @foreach ($errors->all() as $error)
                        <li> {{ $error }} </li>
                    @endforeach
                </ul>
            @endif

            <div class="mb-3 row">
                <label for="name" class="col-sm-2 col-form-label">Nama : </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" value="{{ $akun['name'] }} ">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="email" class="col-sm-2 col-form-label">Email : </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="email" name="email" value="{{ $akun['email'] }}">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="role" class="col-sm-2 col-form-label">Tipe Pengguna : </label>
                <div class="col-sm-10">
                    <select class="form-select" name="role" id="role">
                        <option selected disabled hidden>Pilih Barang</option>
                        <option value="admin" {{ $akun['role'] == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="cashier" {{ $akun['role'] == 'cashier' ? 'selected' : '' }}>Cashier</option>
                    </select>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="password" class="col-sm-2 col-form-label">Password : </label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="password" name="password" value="{{ $akun['password'] }}">
                </div>
            </div>
            <button type="submit" class="btn btn-info text-white mt-3">Tambah Akun</button>
        </form>
    </div>
@endsection
