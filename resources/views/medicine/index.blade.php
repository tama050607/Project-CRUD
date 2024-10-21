@extends('layouts.layout')

@section('content')
    <div class=" container w-75 mx-auto mt-5">

        @if (Session::get('success'))
            <div class="alert alert-success text-black mb-4"> {{ Session::get('success') }} </div>
        @endif
        <div class="card mx-auto">
            <table class="table table-striped table-bordered table-hover ">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Tipe</th>
                        <th>Harga</th>
                        <th>Stock</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($medicines) < 1)
                        <tr>
                            <td colspan="6" class="text-center">Data Obat Kosong</td>
                        </tr>
                    @else
                        @foreach ($medicines as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item['name'] }}</td>
                                <td>{{ $item['type'] }}</td>
                                <td class='text-end'>Rp.{{ number_format($item['price'], 0, ',', '.') }}</td>
                                <td class="text-end {{ $item['stock'] < 2 ? 'bg-danger text-white' : '' }}"
                                    style="cursor: pointer;" onclick="showModalStock('{{ $item->id }}', '{{ $item->stock }}')">{{ $item['stock'] }}</td>
                                <td class="d-flex justify-content-center">
                                    <button class="btn btn-primary me-2"><a class='text-white link-underline-primary'
                                            href="{{ route('obat.edit', $item['id']) }}">Edit</a></button>
                                    <button class="btn btn-danger" onclick="showModal('{{ $item->id }}', '{{ $item->name }}')">Hapus</button>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
            {{-- Modal Delete --}}
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form id="form-delete-obat" method="POST">
                        @csrf
                        {{-- menimpa method="POST" diganti menjadi delete, sesuai dengan http
                        method untul menghapus data- --}}
                        @method('DELETE')
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Hapus Data barang</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                    href="{{ route('obat.data') }}"></button>
                            </div>
                            <div class="modal-body">
                                Apakah anda yakin ingin menghapus barang <span id="nama-obat"></span>?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                    href="{{ route('obat.data') }}">Batalkan</button>
                                <button type="submit" class="btn btn-danger" id="confirm-delete">Hapus</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Modal Edit --}}
            <div class="modal fade" id="modal_edit_stock" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <form id="form_edit_stock" method="POST">
                        @csrf
                        {{-- menimpa method="POST" diganti menjadi delete, sesuai dengan http
                    method untul menghapus data- --}}
                        @method('PATCH')
                        {{-- modal delete --}}
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Edit Stock</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                                    href="{{ route('obat.data') }}"></button>
                            </div>
                            <div class="modal-body">
                                <form action="" class="form-label">
                                    <label for="stock" class="form-label">Stock</label>
                                    <input type="number" class="form-control" id="stock_edit" name="stock" placeholder="Update">
                                    {{-- membuat menjadi input required kalau kosong --}}
                                    @if (Session::get('failed'))
                                    <small class="text-danger">{{ Session::get('failed') }}</small>
                                    @endif
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                    href="{{ route('obat.data') }}">Batalkan</button>
                                <button type="submit" class="btn btn-danger" id="confirm-delete">Edit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center mt-4 text-danger">
            {{ $medicines->links() }}
        </div>
    </div>
    @push('script')
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script>
            function showModal(id, name) {
                //ini untuk url delete nya {route}
                let urlDelete = "{{ route('obat.hapus', ':id') }}";
                urlDelete = urlDelete.replace(':id', id);
                //ini untuk action attribute nya
                $("#form-delete-obat").attr('action', urlDelete);
                //ini untuk show Modalnya
                $('#exampleModal').modal('show');
                //ini untuk mengisi
                $('#nama-obat').text(name);
            }

            function showModalStock(id, stock){
                $('#stock_edit').val(stock);
                //ambil route patch stock
                let url = "{{ route('obat.edit.stock' , ':id')}}";
                url = url.replace(':id', id);
                $("#form_edit_obat").attr("action", url);
                $("#modal_edit_stock").modal("show");
            }

            @if (Session::get('failed'))

                $(document). ready(function(){
                    let id = "{{ Session::get('id') }}";
                    let stock = "{{ Session::get('stock') }}";
                showModalStock(id, stock);
                });
            @endif
        </script>
    @endpush
@endsection
