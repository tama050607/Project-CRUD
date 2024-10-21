@extends('layouts.layout')
{{-- extends : untuk mengimport template @yield dari layout --}}
@section('content')
    <h1 class="text-center mt-4">Halaman Edit Barang</h1>
    <div class="d-flex justify-content-center">
        {{-- ',' memisahkan route dan id dinamis --}}
        <form action="{{route('obat.edit.formulir', $medicine['id'])}}" method="POST" class="card p-5 mt-4 d-flex w-75">
            @csrf
            {{-- Menimpa method lain --}}
            {{-- put digunakan jiga mengubah semua data sedangkan kalau patch tidak semua data --}}
            @method('PATCH')
            {{-- Mengecek Jika Success --}}
            {{--  --}}
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
                <label for="name" class="col-sm-2 col-form-label">Nama Barang : </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" value="{{ $medicine['name'] }} ">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="type" class="col-sm-2 col-form-label">Jenis Barang : </label>
                <div class="col-sm-10">
                    <select class="form-select" name="type" id="type">
                        <option selected disabled hidden>Pilih Barang</option>
                        <option value="tablet" {{ $medicine['type'] == 'tablet' ? 'selected' : '' }}>Makanan</option>
                        <option value="sirup" {{ $medicine['type'] == 'sirup' ? 'selected' : '' }}>Minuman</option>
                        <option value="kapsul"{{ $medicine['type'] == 'Kapsul' ? 'selected' : '' }}>Obat</option>
                    </select>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="price" class="col-sm-2 col-form-label">Harga Barang : </label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="price" name="price" value="{{ $medicine['price'] }}">
                </div>
            </div>
            <button type="submit" class="btn btn-info text-white mt-3">Tambah Data</button>
        </form>
    </div>
@endsection
