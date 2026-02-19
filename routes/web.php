<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\KelasController;
use App\Http\Controllers\Admin\KriteriaController;
use App\Http\Controllers\Juri\PenilaianController;
use App\Models\Kelas;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// DASHBOARD TERPUSAT (Siswa vs Staff)
Route::get('/dashboard', function () {
    $rekap_nilai = Kelas::withSum('penilaians as total_skor', 'skor')
        ->orderBy('total_skor', 'desc')
        ->get();

    $nilai_tertinggi = $rekap_nilai->first();
    $nilai_terendah = $rekap_nilai->last();

    // Jika Siswa
    if (auth()->user()->role !== 'juri' && auth()->user()->role !== 'admin') {
        return view('siswa-dashboard', compact('rekap_nilai', 'nilai_tertinggi', 'nilai_terendah'));
    }

    // Jika Admin atau Juri
    return view('dashboard', compact('rekap_nilai', 'nilai_tertinggi', 'nilai_terendah'));
})->middleware(['auth', 'verified'])->name('dashboard');

// ROUTE KHUSUS ADMIN (Kelola Data Master)
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::resource('kelas', KelasController::class);
    Route::resource('kriteria', KriteriaController::class);
});

// ROUTE PENILAIAN (Bisa diakses JURI dan ADMIN)
// Di sinilah letak perbaikan 403 tadi
Route::middleware(['auth', 'role:admin,juri'])->group(function () {
    Route::get('/penilaian/create/{kelas_id}', [PenilaianController::class, 'create'])->name('juri.penilaian.create');
    Route::post('/penilaian/store', [PenilaianController::class, 'store'])->name('juri.penilaian.store');
});

// ROUTE PROFILE
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';