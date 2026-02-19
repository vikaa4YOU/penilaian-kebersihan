<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kriteria;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    public function index()
    {
        // Mengambil semua data kriteria
        $semua_kriteria = Kriteria::all();
        return view('admin.kriteria.index', compact('semua_kriteria'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kriteria' => 'required|string|max:255',
        ]);

        Kriteria::create($request->all());

        return back()->with('success', 'Kriteria berhasil ditambahkan!');
    }

    public function destroy(Kriteria $kriteria)
    {
        $kriteria->delete();
        return back()->with('success', 'Kriteria berhasil dihapus!');
    }
}