<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Input Nilai Kebersihan: {{ $kelas->nama_kelas }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow-lg">
                
                {{-- WAJIB: enctype="multipart/form-data" --}}
                <form action="{{ route('juri.penilaian.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="kelas_id" value="{{ $kelas->id }}">

                   @foreach($semua_kriteria as $kriteria)
<div class="mb-4">
    <label>{{ $kriteria->nama_kriteria }}</label>
    
    <input type="number" name="skor[{{ $kriteria->id }}]" required>

    <input type="file" name="foto[{{ $kriteria->id }}]" accept="image/*">
</div>
@endforeach

                    <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-black py-4 rounded-xl shadow-xl transition-all uppercase tracking-widest">
                        Simpan Penilaian Sekarang
                    </button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>