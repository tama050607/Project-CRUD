<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $akun = User::where('name', 'LIKE', '%' . $request->search_akun . '%')
        ->orderBy('email', 'ASC')
        ->simplePaginate(5)
        ->appends($request->all());
        
        return view('akun.akun', compact('akun'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('akun.buat');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    $request->validate([
        'name' => 'required|max:100',
        'email' => 'required|max:100',
        'password' => 'required|min:5',
        'role' => 'required|min:2',
    ],
    [
        'name.required' => 'Nama Harus Diisi',
        'email.required' => 'Email Harus Diisi',
        'password.required' => 'Password Harus Diisi',
        'role.required' => 'Role Harus Diisi',
    ]);

    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => $request->role,
    ]);

    return redirect()->back()->with('success', 'Akun Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $akun = User::where('id', $id)->first();
        return view("akun.ubah", compact('akun'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'nullable|min:5',
            'role' => 'required',
        ]);

        User::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);
        return redirect()->route('kelola.akun')->with('success', 'Berhasil Mengedit Data!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        $deleteData = User::where('id', $id)->delete();
        if($deleteData){
            return redirect()->back()->with('success', 'Berhasil Menghapus Data Obat');
        }else {
            return redirect()->back()->with('error', 'Gagal Menghapus Data Obat');
        }
    }
}
