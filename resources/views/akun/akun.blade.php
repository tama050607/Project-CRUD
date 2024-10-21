@extends('layouts.layout')

@section('content')

<div class=" container w-75 mx-auto mt-5">
    <div class='d-flex justify-content-end'>
        <form class="d-flex" action="{{ route('kelola.akun')}}" role="search" method="GET">
            <input class="form-control" type="text" placeholder="Search" aria-label="Search"
            name="search_akun">
            <button class="btn btn-info text-white ms-2" type="submit ">Search</button>
            <button class="btn btn-primary text-white ms-2">
                <a href="{{ route('kelola.akun.formulir') }}" class="text-white link-underline-primary">Tambah</a></button>
            </form>
        </div>
        @if(Session::get('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif
        <table class="table table-striped table-bordered table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Tipe Pengguna</th>
                <th>Email</th>
                <th class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @if (count($akun) < 1)
            <tr>
                <td colspan="6" class="text-center">Data Akun Kosong</td>
            </tr>
            @else
            @foreach ($akun as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ $item['role'] }}</td>
                    <td>{{ $item['email'] }}</td>
                    <td class="d-flex justify-content-center">
                        <a href="{{ route('kelola.edit.form', $item['id']) }}" class="btn btn-primary me-3">Edit</a>
                        <a href="#" onclick="showModal('{{ $item->id }}', '{{ $item->name }}')" class="btn btn-danger">Hapus</a>
                    </td>
                </tr>
            @endforeach
            @endif
        </tbody>
    </table>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="form-hapus-akun" method="POST">
                @csrf
                {{-- menimpa method="POST" diganti menjadi delete, sesuai dengan http
                method untul menghapus data- --}}
                @method('DELETE')
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Hapus Akun</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            href="{{ route('kelola.akun') }}"></button>
                    </div>
                    <div class="modal-body">
                        Apakah anda yakin ingin menghapus akun <span id="nama-akun"></span>?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                        href="{{ route('kelola.akun') }}">Batalkan</button>
                        <button type="submit" class="btn btn-danger" id="confirm-delete">Hapus</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="d-flex justify-content-center mt-4 text-danger">
        {{ $akun->links() }}
    </div>
</div>
@endsection
@push('script')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    
    function showModal(id, name) {
        //ini untuk url delete nya {route}
        let urlDelete = "{{ route('kelola.akun.hapus', ':id') }}";
        urlDelete = urlDelete.replace(':id', id);
        //ini untuk action attribute nya
        $("#form-hapus-akun").attr('action', urlDelete);
        //ini untuk show Modalnya
        $('#exampleModal').modal('show');
        //ini untuk mengisi
        $('#nama-akun').text(name);
    }
</script>
