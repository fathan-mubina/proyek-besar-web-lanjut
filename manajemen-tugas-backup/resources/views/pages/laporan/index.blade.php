@extends('layout.app', ['pageTitle' => 'Laporan'])

@section('content')

<h2 class="text-2xl font-semibold mb-6">Laporan</h2>

<div class="space-y-6">

    @foreach ($laporan as $item)
        <div class="bg-white p-6 rounded-xl shadow-md border border-gray-200">

            <div class="flex justify-between items-start mb-2">

                <div>
                    <h3 class="text-lg font-semibold">{{ $item['judul'] }}</h3>
                    <p class="text-gray-600 text-sm">{{ $item['deskripsi'] }}</p>

                    <div class="flex items-center text-sm text-gray-500 mt-2">
                        📅 <span class="ml-2">{{ $item['tanggal'] }}</span>
                    </div>
                </div>

                {{-- STATUS BADGE --}}
                <div class="space-x-2">

                    @if($item['status'] == 'Sedang')
                        <span class="px-3 py-1 text-xs rounded-full bg-yellow-200 text-yellow-800">Sedang</span>
                        <span class="px-3 py-1 text-xs rounded-full bg-red-200 text-red-800">Belum Mulai</span>
                    @elseif($item['status'] == 'Dalam Proses')
                        <span class="px-3 py-1 text-xs rounded-full bg-blue-200 text-blue-800">Dalam Proses</span>
                    @endif

                    {{-- BUTTONS --}}
                    <button class="px-3 py-1 text-xs bg-[#E5E3E3] hover:bg-red-600 text-black rounded-lg shadow">
                        Hapus
                    </button>
                    <button class="px-3 py-1 text-xs bg-[#E5E3E3] hover:bg-blue-600 text-black rounded-lg shadow">
                        Edit
                    </button>

                </div>

            </div>
        </div>
    @endforeach

</div>

@endsection
