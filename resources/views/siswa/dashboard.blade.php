<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Peringkat Kebersihan (Mode Siswa)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6 p-4 bg-blue-100 border-l-4 border-blue-500 text-blue-700 rounded shadow-sm">
                <p class="text-sm">👋 <strong>Halo Siswa!</strong> Berikut adalah hasil penilaian kebersihan kelas terbaru.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="bg-green-600 p-6 rounded-lg shadow-lg text-white">
                    <p class="text-sm font-bold uppercase opacity-75">Nilai Tertinggi 🏆</p>
                    <h3 class="text-3xl font-black mt-2">{{ $nilai_tertinggi->nama_kelas ?? '-' }}</h3>
                    <p class="mt-2 text-xl font-semibold">Total Skor: {{ $nilai_tertinggi->total_skor ?? 0 }}</p>
                </div>
                <div class="bg-red-600 p-6 rounded-lg shadow-lg text-white">
                    <p class="text-sm font-bold uppercase opacity-75">Nilai Terendah 🧹</p>
                    <h3 class="text-3xl font-black mt-2">{{ $nilai_terendah->nama_kelas ?? '-' }}</h3>
                    <p class="mt-2 text-xl font-semibold">Total Skor: {{ $nilai_terendah->total_skor ?? 0 }}</p>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border">
                <div class="p-6 text-gray-900 font-bold border-b bg-gray-50 uppercase text-center">Urutan Peringkat</div>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase italic">Rank</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Nama Kelas</th>
                            <th class="px-6 py-3 text-right text-xs font-bold text-gray-500 uppercase">Total Skor</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($rekap_nilai as $index => $kls)
                        <tr class="{{ $index == 0 ? 'bg-yellow-50 font-bold' : '' }}">
                            <td class="px-6 py-4 text-sm">{{ $index + 1 }}</td>
                            <td class="px-6 py-4">{{ $kls->nama_kelas }}</td>
                            <td class="px-6 py-4 text-right text-blue-600 font-black text-lg">{{ $kls->total_skor ?? 0 }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>