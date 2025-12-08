@extends('layout.app', ['pageTitle' => 'Laporan'])

@section('content')

<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-semibold">Laporan</h2>
    <div class="text-sm text-gray-600">
        Total: <span class="font-bold">{{ $laporan->count() }}</span> item
    </div>
</div>

<div class="space-y-6">

    @forelse ($laporan as $item)
        <div class="bg-white p-6 rounded-xl shadow-md border border-gray-200">

            <div class="flex justify-between items-start mb-2">

                <div class="flex-1">
                    <div class="flex items-center gap-3 mb-2">
                        <h3 class="text-lg font-semibold">{{ $item['judul'] }}</h3>

                        {{-- Badge Type --}}
                        @if($item['type'] == 'proyek')
                            <span class="px-2 py-1 text-xs rounded-full bg-purple-100 text-purple-700">
                                Proyek
                            </span>
                        @else
                            <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-700">
                                Tugas
                            </span>
                        @endif
                    </div>

                    <p class="text-gray-600 text-sm">{{ $item['deskripsi'] }}</p>

                    <div class="flex items-center text-sm text-gray-500 mt-2">
                        📅 <span class="ml-2">{{ $item['tanggal'] }}</span>
                    </div>
                </div>

                {{-- STATUS BADGE & BUTTONS --}}
                <div class="flex flex-col items-end gap-2">

                    {{-- Status Badge --}}
                    @if($item['status'] == 'Belum Mulai')
                        <span class="px-3 py-1 text-xs rounded-full bg-red-200 text-red-800">Belum Mulai</span>
                    @elseif($item['status'] == 'Dalam Proses')
                        <span class="px-3 py-1 text-xs rounded-full bg-blue-200 text-blue-800">Dalam Proses</span>
                    @elseif($item['status'] == 'Selesai')
                        <span class="px-3 py-1 text-xs rounded-full bg-green-200 text-green-800">Selesai</span>
                    @endif

                    {{-- Action Buttons --}}
                    <div class="flex gap-2">
                        @if($item['type'] == 'tugas')
                            <a href="{{ route('tugas.edit', $item['id']) }}"
                               class="px-3 py-1 text-xs bg-[#E5E3E3] hover:bg-blue-600 hover:text-white text-black rounded-lg shadow transition">
                                Edit
                            </a>
                            <a href="{{ route('tugas.index') }}"
                               class="px-3 py-1 text-xs bg-[#E5E3E3] hover:bg-gray-400 text-black rounded-lg shadow transition">
                                Lihat
                            </a>
                        @else
                            <a href="{{ route('proyek.detail', $item['id']) }}"
                               class="px-3 py-1 text-xs bg-[#E5E3E3] hover:bg-blue-600 hover:text-white text-black rounded-lg shadow transition">
                                Detail
                            </a>
                        @endif
                    </div>

                </div>

            </div>
        </div>

    @empty
        <div class="bg-gray-100 rounded-xl p-8 text-center">
            <p class="text-gray-500 mb-4">Belum ada laporan tugas atau proyek.</p>
            <div class="flex justify-center gap-3">
                <a href="{{ route('tugas.create') }}"
                   class="px-6 py-2 bg-black text-white rounded-lg hover:bg-gray-800">
                    + Tambah Tugas
                </a>
                <a href="{{ route('proyek.create') }}"
                   class="px-6 py-2 bg-gray-200 text-black rounded-lg hover:bg-gray-300">
                    + Tambah Proyek
                </a>
            </div>
        </div>
    @endforelse

</div>

@endsection
