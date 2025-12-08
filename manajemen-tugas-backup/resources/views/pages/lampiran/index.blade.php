@extends('layout.app', ['pageTitle' => $pageTitle])

@section('content')

<h2 class="text-xl font-semibold mb-6">Lampiran</h2>

<div class="space-y-4 max-w-4xl">

    @foreach ($lampiran as $item)
    <div class="bg-white p-4 rounded-lg shadow-sm border">

        <div class="flex justify-between items-start">
            
            {{-- KIRI --}}
            <div>
                <h3 class="font-semibold">{{ $item['judul'] }}</h3>
                <p class="text-sm text-gray-600">{{ $item['deskripsi'] }}</p>

                <div class="flex items-center gap-2 text-sm text-gray-500 mt-1">
                    <img src="/icons/calendar.svg" class="w-4 opacity-70">
                    <span>{{ $item['tanggal'] }}</span>
                </div>
            </div>

            {{-- KANAN --}}
            <div class="flex items-center gap-2">

                @if ($item['status1'])
                <span class="px-3 py-1 bg-yellow-200 text-yellow-900 rounded text-xs">
                    {{ $item['status1'] }}
                </span>
                @endif

                @if ($item['status2'])
                <span class="px-3 py-1 bg-red-200 text-red-800 rounded text-xs">
                    {{ $item['status2'] }}
                </span>
                @endif

                <button class="px-3 py-1 text-xs bg-[#E5E3E3] hover:bg-red-600 text-black rounded-lg shadow">Hapus</button>
                <button class="px-3 py-1 text-xs bg-[#E5E3E3] hover:bg-blue-600 text-black rounded-lg shadow">Edit</button>

            </div>
        </div>

    </div>
    @endforeach

</div>

@endsection
