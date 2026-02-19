<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Penilaian Kebersihan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="bg-indigo-600 p-6 rounded-lg shadow-md text-white">
                    <p class="text-sm font-bold uppercase opacity-75">Peringkat 1 🏆</p>
                    <h3 class="text-3xl font-black mt-2">{{ $rekap_nilai->first()->nama_kelas ?? 'Belum ada data' }}</h3>
                    <p class="mt-2">Skor: {{ $rekap_nilai->first()->total_skor ?? 0 }}</p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
                    <p class="text-sm font-bold uppercase text-gray-500">Total Kelas Dinilai</p>
                    <h3 class="text-3xl font-black mt-2 text-gray-800">{{ $rekap_nilai->count() }}</h3>
                    <p class="mt-2 text-gray-400 text-sm italic">*Data diperbarui secara real-time</p>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-200">
                <div class="p-6 bg-gray-50 border-b border-gray-200">
                    <h3 class="font-bold text-lg text-gray-700">Tabel Peringkat & Aksi Penilaian</h3>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Rank</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase">Nama Kelas</th>
                                <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase">Total Skor</th>
                                <th class="px-6 py-3 text-center text-xs font-bold text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($rekap_nilai as $index => $item)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-600">
                                        #{{ $index + 1 }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap font-semibold text-gray-800">
                                        {{ $item->nama_kelas }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center text-indigo-700 font-black text-lg">
                                        {{ $item->total_skor ?? 0 }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <a href="{{ route('juri.penilaian.create', $item->id) }}" 
                                           class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-xs font-bold uppercase rounded shadow transition">
                                            📸 Beri Nilai & Foto
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-10 text-center text-gray-500 italic">
                                        Data kelas belum tersedia. Silakan hubungi Admin.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>