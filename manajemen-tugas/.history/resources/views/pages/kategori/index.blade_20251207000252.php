@extends('layout.app', ['pageTitle' => 'Kategori'])

@section('content')

<h2 class="text-2xl font-semibold mb-6">Kategori</h2>

{{-- GRID 3 KOLOM --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

    @foreach ($categories as $c)
        <div class="bg-white rounded-2xl p-6 shadow-lg transition-all duration-300 hover:-translate-y-2 hover:shadow-xl flex flex-col items-center text-center">

            {{-- ICON --}}
            <div class="w-14 h-14 bg-blue-100 rounded-full flex items-center justify-center mb-4">
                <img src="/icons/tag.svg" class="w-7 opacity-80">
            </div>

            {{-- NAMA --}}
            <h3 class="text-lg font-semibold mb-1">
                {{ $c->nama_kategori }}
            </h3>

            {{-- JUMLAH TUGAS --}}
            <p class="text-gray-500 text-sm">
                {{ $c->tugas_count ?? 0 }} Tugas
            </p>
        </div>
    @endforeach

</div>

@endsection
