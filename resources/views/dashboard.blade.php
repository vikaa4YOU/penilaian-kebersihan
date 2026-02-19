<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Peringkat Kebersihan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(auth()->user()->role == 'user')
            <div class="mb-6 p-4 bg-blue-50 border-l-4 border-blue-500 text-blue-700 rounded shadow-sm">
                <p class="text-sm">👋 <strong>Halo Siswa!</strong> Pantau terus peringkat kebersihan kelasmu. Semangat menjaga kebersihan! ✨</p>
            </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="bg-green-600 p-6 rounded-lg shadow-lg text-white relative overflow-hidden">
                    <p class="text-sm font-bold uppercase opacity-75">Nilai Tertinggi 🏆</p>
                    <h3 class="text-3xl font-black mt-2">{{ $nilai_tertinggi->nama_kelas ?? 'Belum Ada Data' }}</h3>
                    <p class="mt-2 text-xl font-semibold">Total Skor: {{ $nilai_tertinggi->total_skor ?? 0 }}</p>
                </div>

                <div class="bg-red-600 p-6 rounded-lg shadow-lg text-white relative overflow-hidden">
                    <p class="text-sm font-bold uppercase opacity-75">Nilai Terendah 🧹</p>
                    <h3 class="text-3xl font-black mt-2">{{ $nilai_terendah->nama_kelas ?? 'Belum Ada Data' }}</h3>
                    <p class="mt-2 text-xl font-semibold">Total Skor: {{ $nilai_terendah->total_skor ?? 0 }}</p>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                <div class="p-6 text-gray-900 font-bold text-lg border-b bg-gray-50 flex justify-between items-center">
                    <span>Urutan Peringkat Kelas</span>
                    <span class="text-xs font-normal text-gray-500">Pembaruan Real-time</span>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-100">
    <tr>
        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Rank</th>
        <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Kelas</th>
        <th class="px-6 py-3 text-right text-xs font-bold text-gray-500 uppercase">Total Skor</th>
        
        @if(auth()->user()->role === 'juri' || auth()->user()->role === 'admin')
            <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase">Aksi</th>
        @endif
    </tr>
</thead>

<tbody class="bg-white divide-y divide-gray-200">
    @foreach($rekap_nilai as $index => $kls)
    <tr>
        <td class="px-6 py-4 text-sm">{{ $index + 1 }}</td>
        <td class="px-6 py-4 font-bold">{{ $kls->nama_kelas }}</td>
        <td class="px-6 py-4 text-right text-blue-600 font-black">{{ $kls->total_skor ?? 0 }}</td>

        @if(auth()->user()->role === 'juri' || auth()->user()->role === 'admin')
        <td class="px-6 py-4 text-center">
            <a href="{{ route('juri.penilaian.create', $kls->id) }}" class="bg-indigo-600 text-white px-3 py-1 rounded text-xs font-bold hover:bg-indigo-700">
                Beri Nilai
            </a>
        </td>
        @endif
    </tr>
    @endforeach
</tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>