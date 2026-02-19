<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;

    // Pastikan baris ini ada agar data bisa disimpan
    protected $fillable = ['nama_kriteria'];
}