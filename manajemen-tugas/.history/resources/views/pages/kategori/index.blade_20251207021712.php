@extends('layout.app', ['pageTitle' => 'Kategori'])

@section('content')

<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-semibold">Kategori</h2>
  
</div>

{{-- GRID 3 KOLOM --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

    @forelse ($categories as $c)
        <div class="bg-white rounded-2xl p-6 shadow-lg transition-all duration-300 hover:-translate-y-2 hover:shadow-xl flex flex-col items-center text-center relative">

            {{-- ICON --}}
            <div class="w-14 h-14 bg-blue-100 rounded-full flex items-center justify-center mb-4">
                <img src="/icons/tag.svg" class="w-7 opacity-80" alt="tag icon">
            </div>

            {{-- NAMA --}}
            <h3 class="text-lg font-semibold mb-1">
                {{ $c->nama_kategori }}
            </h3>

            {{-- DESKRIPSI (jika ada) --}}
            @if($c->deskripsi)
            <p class="text-gray-500 text-xs mb-2">
                {{ Str::limit($c->deskripsi, 50) }}
            </p>
            @endif

            {{-- JUMLAH TUGAS --}}
            <p class="text-gray-500 text-sm mb-4">
                {{ $c->tasks_count ?? 0 }} Tugas
            </p>


        </div>
    @empty
        <div class="col-span-full text-center py-12 text-gray-500">
            <p class="text-lg mb-2">Belum ada kategori</p>
            <p class="text-sm">Silakan tambah kategori baru untuk mengelola tugas Anda</p>
        </div>
    @endforelse

</div>


@endsection
