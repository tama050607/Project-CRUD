@extends('layouts.layout')
{{-- extends : untuk mengimport template @yield dari layout --}}
@section('content')
<h1 class="text-center mt-4">Halaman Menambahkan Akun</h1>
<div class="d-flex justify-content-center">
    <form action="{{route('kelola.akun.tambah')}}" method="POST" class="card p-5 mt-4 d-flex w-75">
        @csrf
    {{-- Mengecek Jika Success --}}
    {{--  --}}
    @if(Session::get('success'))
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
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name')}} ">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="email" class="col-sm-2 col-form-label">Email : </label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="email" name="email">
        </div>
    </div>
    <div class="mb-3 row">
        <label for="role" class="col-sm-2 col-form-label" >Tipe Pengguna : </label>
        <div class="col-sm-10">
            <select class="form-select" name="role" id="role">
                <option selected disabled hidden>Tipe Pengguna</option>
                <option value="admin" {{old('role') =='admin' ? 'selected' : ''}}>Admin</option>
                <option value="cashier" {{old('role') =='cashier' ? 'selected' : ''}}>Cashier</option>
            </select>
        </div>
    </div>
    <div class="mb-3 row">
        <label for="password" class="col-sm-2 col-form-label">Password : </label>
        <div class="col-sm-10">
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <button type="submit" class="btn btn-info text-white mt-3">Tambah Data</button>
    </div>
</div>
</form>
</div>
@endsection

