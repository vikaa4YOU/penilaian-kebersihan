<?php

namespace App\Http\Controllers\Juri;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Kriteria;
use App\Models\Penilaian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PenilaianController extends Controller
{
    public function index()
    {
        $semua_kelas = Kelas::all();
        return view('juri.dashboard', compact('semua_kelas'));
    }

    public function create($kelas_id)
    {
        $kelas = Kelas::findOrFail($kelas_id);
        $semua_kriteria = Kriteria::all();
        
        return view('juri.penilaian', compact('kelas', 'semua_kriteria'));
    }

    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'skor' => 'required|array',
            'foto' => 'nullable|array',
            'foto.*' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // 2. Gunakan foreach untuk memproses setiap kriteria yang dinilai
        foreach ($request->skor as $kriteria_id => $nilai) {
            $pathFoto = null;

            // Logika Upload Foto
            if ($request->hasFile("foto.$kriteria_id")) {
                // Simpan foto ke folder storage/app/public/bukti_penilaian
                $pathFoto = $request->file("foto.$kriteria_id")->store('bukti_penilaian', 'public');
            }

            // 3. Simpan ke Database
            // Kita gunakan updateOrCreate supaya jika juri input ulang, data tidak duplikat
            Penilaian::updateOrCreate(
                [
                    'kelas_id' => $request->kelas_id,
                    'kriteria_id' => $kriteria_id,
                ],
                [
                    'user_id' => auth()->id(),
                    'skor' => $nilai,
                    'foto_bukti' => $pathFoto ?? null,
                ]
            );
        }

        return redirect()->route('dashboard')->with('success', 'Penilaian berhasil disimpan!');
    }
}