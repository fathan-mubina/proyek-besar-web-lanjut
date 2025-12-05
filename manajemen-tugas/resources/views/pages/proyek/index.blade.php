@extends('layout.app', ['pageTitle' => 'Proyek'])

@section('content')


    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
    <h1 class="text-3xl font-bold text-gray-900">
        Proyek Kamu 😄✨</h1>


        <a href="{{ route('proyek.create') }}"
           class="px-4 py-2 bg-[#E5E3E3] ext-black rounded-lg shadow hover:bg-gray-300 font-medium">
            + Tambah Proyek
        </a>
    </div>

    {{-- List Proyek --}}
    <div class="space-y-4">
        @foreach ($projects as $project)
        <a href="{{ route('proyek.detail', $project->id) }}"
           class="block bg-white p-5 rounded-xl shadow hover:shadow-md transition">
            
            <h2 class="text-lg font-semibold">{{ $project->nama }}</h2>
            <p class="text-gray-600 mb-2">{{ $project->deskripsi }}</p>

            {{-- Tanggal --}}
            <div class="flex items-center text-sm text-gray-500 gap-2 mb-3">
                <div class="w-3 h-3 bg-gray-300 rounded"></div>
                <span>
                    {{ \Carbon\Carbon::parse($project->tanggal_mulai)->format('d M Y') }}
                    –
                    {{ \Carbon\Carbon::parse($project->tanggal_selesai)->format('d M Y') }}
                </span>
            </div>

            {{-- Progress Bar --}}
            <div class="w-full bg-gray-200 rounded-full h-3">
    <div class="h-3 rounded-full 
        @if ($project->progress < 50) bg-red-400 
        @elseif ($project->progress < 100) bg-yellow-400 
        @else bg-green-500 
        @endif"
        style="width: {{ $project->progress }}%;">
    </div>
</div>


            <div class="text-right text-sm text-gray-600 mt-1">{{ $project->status }}</div>
        </a>
        @endforeach
    </div>
</div>
@endsection
