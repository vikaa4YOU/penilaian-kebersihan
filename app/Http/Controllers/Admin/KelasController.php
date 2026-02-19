<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas; // Pastikan model Kelas sudah ada
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        // Mengambil semua data kelas dari database
        $semua_kelas = Kelas::all();
        return view('admin.kelas.index', compact('semua_kelas'));
    }

    public function store(Request $request)
    {
        // Validasi agar nama kelas tidak boleh kosong dan tidak boleh sama
        $request->validate([
            'nama_kelas' => 'required|unique:kelas,nama_kelas'
        ]);

        // Simpan data ke database
        Kelas::create($request->all());
        
        return back()->with('success', 'Kelas berhasil ditambahkan!');
    }

    // Saya ubah $kela menjadi $kelas agar lebih mudah dibaca
    public function destroy(Kelas $kelas)
    {
        $kelas->delete();
        return back()->with('success', 'Kelas berhasil dihapus!');
    }
}