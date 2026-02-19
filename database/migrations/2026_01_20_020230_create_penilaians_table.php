<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('penilaians', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Juri yang menilai
    $table->foreignId('kelas_id')->constrained()->onDelete('cascade'); // Kelas yang dinilai
    $table->foreignId('kriteria_id')->constrained()->onDelete('cascade'); // Kriteria apa
    $table->integer('skor'); // Skor 1-100
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaians');
    }
};
