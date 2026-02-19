<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Penilaian Kelas: <span class="text-indigo-600">{{ $kelas->nama_kelas }}</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border">
                <div class="p-6">
                    <form action="{{ route('juri.penilaian.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="kelas_id" value="{{ $kelas->id }}">

                        <p class="mb-6 text-sm text-gray-600 border-b pb-4">
                            Silakan isi nilai (0-100) dan lampirkan foto bukti untuk setiap kriteria di bawah ini.
                        </p>

                        @foreach($kriterias as $kriteria)
                        <div class="mb-8 p-4 bg-gray-50 rounded-xl border border-gray-200">
                            <label class="block font-bold text-gray-800 text-lg mb-2">
                                {{ $kriteria->nama_kriteria }}
                            </label>

                            <div class="grid grid-cols-1 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Skor Penilaian</label>
                                    <input type="number" 
                                           name="skor[{{ $kriteria->id }}]" 
                                           min="0" max="100" 
                                           class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" 
                                           placeholder="Contoh: 85"
                                           required>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Foto Bukti (Kebersihan/Kekurangan)</label>
                                    <input type="file" 
                                           name="foto[{{ $kriteria->id }}]" 
                                           accept="image/*"
                                           capture="environment"
                                           class="block w-full text-sm text-gray-500 
                                                  file:mr-4 file:py-2 file:px-4 
                                                  file:rounded-full file:border-0 
                                                  file:text-sm file:font-semibold 
                                                  file:bg-indigo-50 file:text-indigo-700 
                                                  hover:file:bg-indigo-100">
                                    <p class="mt-1 text-xs text-gray-400">*Format: JPG, PNG (Max 2MB)</p>
                                </div>
                            </div>
                        </div>
                        @endforeach

                        <div class="flex items-center justify-end mt-6 gap-4">
                            <a href="{{ route('dashboard') }}" class="text-sm text-gray-600 hover:underline">Batal</a>
                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-lg shadow-lg transition duration-200">
                                Simpan Semua Nilai
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>