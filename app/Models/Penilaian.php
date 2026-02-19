<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    use HasFactory;

    // Tambahkan user_id ke sini agar bisa di-submit
    protected $fillable = [
        'user_id', 
        'kelas_id', 
        'kriteria_id', 
        'skor' ,
        'foto_bukti' ,
    ];
}