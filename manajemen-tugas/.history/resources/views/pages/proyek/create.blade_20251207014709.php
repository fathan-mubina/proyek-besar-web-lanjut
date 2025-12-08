@extends('layout.app', ['pageTitle' => 'Proyek'])

@section('content')
<div class="px-8 py-6">

    <h1 class="text-2xl font-semibold mb-6">Tambah Proyek Baru</h1>

    <form action="{{ route('proyek.store') }}" method="POST" class="max-w-2xl space-y-6">
        @csrf

        {{-- Nama Proyek --}}
        <div>
            <label class="font-medium">Nama Proyek</label>
            <input type="text"
                   name="nama"
                   required
                   class="w-full mt-1 p-3 bg-gray-100 rounded-lg border focus:ring-2 focus:ring-black outline-none"
                   placeholder="Masukkan nama proyek">
            @error('nama')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Deskripsi --}}
        <div>
            <label class="font-medium">Deskripsi</label>
            <textarea name="deskripsi"
                      rows="4"
                      class="w-full mt-1 p-3 bg-gray-100 rounded-lg border focus:ring-2 focus:ring-black outline-none"
                      placeholder="Deskripsikan detail proyek..."></textarea>
            @error('deskripsi')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Grid 2 Kolom --}}
        <div class="grid grid-cols-2 gap-6">



            {{-- Tanggal Mulai --}}
            <div>
                <label class="font-medium">Tanggal Mulai</label>
                <input type="date"
                       name="tanggal_mulai"
                       required
                       class="w-full mt-1 p-3 bg-gray-100 rounded-lg border focus:ring-2 focus:ring-black outline-none">
                @error('tanggal_mulai')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tanggal Selesai --}}
            <div>
                <label class="font-medium">Tanggal Selesai</label>
                <input type="date"
                       name="tanggal_selesai"
                       required
                       class="w-full mt-1 p-3 bg-gray-100 rounded-lg border focus:ring-2 focus:ring-black outline-none">
                @error('tanggal_selesai')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

        </div>

        {{-- Buttons --}}
        <div class="flex gap-3">
            <a href="{{ route('proyek.index') }}"
               class="px-6 py-2 bg-gray-200 text-black rounded-lg shadow hover:bg-gray-300 font-medium">
                Batal
            </a>
            <button type="submit"
                    class="px-6 py-2 bg-black text-white rounded-lg shadow hover:bg-gray-800 font-medium">
                Simpan Proyek
            </button>
        </div>

    </form>

</div>
@endsection
