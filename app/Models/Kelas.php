<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Penilaian; // <--- PASTIKAN ADA BARIS INI

class Kelas extends Model
{
    use HasFactory;

    protected $fillable = ['nama_kelas'];

    public function penilaians()
    {
        return $this->hasMany(Penilaian::class);
    }
}