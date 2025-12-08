@extends('layout.app', ['pageTitle' => 'Kategori'])

@section('content')

<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-semibold">Kategori</h2>
    <a href="{{ route('kategori.create') }}"
       class="px-6 py-2 bg-black text-white rounded-xl hover:bg-gray-800 transition">
        + Tambah Kategori
    </a>
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

            {{-- ACTION BUTTONS --}}
            <div class="flex gap-2 mt-auto">
                <a href="{{ route('kategori.edit', $c->id) }}"
                   class="px-4 py-1.5 text-sm bg-gray-100 hover:bg-gray-200 rounded-lg transition">
                    Edit
                </a>
                <form action="{{ route('kategori.destroy', $c->id) }}"
                      method="POST"
                      onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="px-4 py-1.5 text-sm bg-red-100 text-red-600 hover:bg-red-200 rounded-lg transition">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
    @empty
        <div class="col-span-full text-center py-12 text-gray-500">
            <p class="text-lg mb-2">Belum ada kategori</p>
            <p class="text-sm">Silakan tambah kategori baru untuk mengelola tugas Anda</p>
        </div>
    @endforelse

</div>


@endsection
