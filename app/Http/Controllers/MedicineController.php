<?php

namespace App\Http\Controllers;

// Mengakses database Medicine
use App\Models\Medicine;
use Illuminate\Http\Request;
class MedicineController extends Controller
{
    /**
     * R: read, menampilkan banyak data/halaman awal fitur.
     */
    public function index(Request $request)
    {
        // all() : mengambil semua data
        // orderBy = untuk mengurutkan
        // ASC = mengurutkan A-Z
        // ubah all() menjadi orderBy()
        $orderStock = $request->sort_stock ? 'stock' : 'name';
        $aorderStock = $request->asort_stock ? 'stock' : 'name';

        $medicines = Medicine::where('name', 'LIKE' , '%' . $request->search_obat . '%')
        ->orderBy($orderStock, 'ASC', $aorderStock, 'DESC')->simplePaginate(5)->appends($request->all());

        // compact) : mengirim data ke view (isinya sama dengan $)
        return view('medicine.index',compact('medicines'));
    }

    /**
     * C : create, menampilkan form untuk menambahkan data
     */
    public function create()
    {
        //
        return view('medicine.create');
    }

    /**
     * C : create, menambahkan data ke database/eksekusi formulir.
     * Request $request untuk mengambil data dari inputan user
     */
    public function store(Request $request)
    {
        // membuat ketentuan validasi ke database
        $user = $request->validate([
            'name' => 'required|max:100',
            'type' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',

        ],
        [
            'name.required' => 'Nama Barang Harus Diisi',
            'type.required' => 'Tipe Barang Harus Diisi',
            'price.required' => 'Harga Barang Harus Diisi',
            'stock.required' => 'Stock Barang Harus Diisi',
            'name.max' => 'Nama Barang Maksimal 100 Karakter',
            'type.min' => 'Tipe Barang Harus Diisi',
            'price.numeric' => 'Harga Barang Harus Menggunakan Angka',
            'stock.numeric' => 'Stock Barang Harus Menggunakan Angka',
        ]);

        // Mevalidasi data yang masuk ke database dan memasukkan ke database
        // $request-> adalah inputan user yang ingin dimasukkan ke database
        Medicine::create([
            'name' => $request->name,
            'type' => $request->type,
            'price' => $request->price,
            'stock' => $request->stock,
        ]);
        // memindahkan kembali halaman bersama nama dan pesan data obatnya ke halaman create
        return redirect()->back()->with('success', 'Berhasil menambahkan data Barang');
    }

    /**
     * R : read, menampilkan hanya satu data sepesifik.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * U : update, menampilkan form untuk mengedit data
     */
    public function edit(string $id)
    {
        // first() hanya mengambil satu data, dan satu pertama
        $medicine = Medicine::where('id', $id)->first();
        return view("medicine.edit", compact('medicine'));
    }

    /**
     * U : update, mengupdate data ke databse/eksekusi formulir data
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'type' => 'required',
            'price' => 'required',
        ]);

        Medicine::where('id', $id)->update([    
            'name' => $request->name,
            'type' => $request->type,
            'price' => $request->price,
        ]);

        return redirect()->route('obat.data')->with('success', 'Berhasil Mengedit Data Barang!');
    }

    public function updateStock(Request $request, $id){
        // menggunakan isset untuk pengecekan required
        if(isset($request->stock) == FALSE){
            $dataSebelumnya = Medicine::where('id', $id)->first();
            return redirect()->back()->with([
                'failed' => 'Stock Tidak Boleh Kosong!!',
                'id' => $id,
                'stock' => $dataSebelumnya->stock,
            ]);
        }
        Medicine::where('id', $id)->update([
            'stock' => $request->stock
        ]);
        return redirect()->back()->with('success', 'Berhasil Mengedit Data Barang!');
    }
    /**
     * D : delete, menghapus data dari database
     */
    public function destroy($id)
    {
        $deleteData = Medicine::where('id', $id)->delete();
        if($deleteData){
            return redirect()->back()->with('success', 'Berhasil Menghapus Data Barang');
        }else {
            return redirect()->back()->with('error', 'Gagal Menghapus Data Barang');
        }
    }
}
