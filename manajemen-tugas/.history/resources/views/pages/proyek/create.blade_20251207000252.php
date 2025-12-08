@extends('layout.app', ['pageTitle' => 'Proyek'])

@section('content')
<div class="px-8 py-6">

    <h1 class="text-2xl font-semibold mb-6">Proyek</h1>

    <form action="{{ route('proyek.store') }}" method="POST" class="max-w-2xl space-y-6">
        @csrf

        {{-- Judul --}}
        <div>
            <label class="font-medium">Judul Proyek</label>
            <input type="text" name="nama"
                   class="w-full mt-1 p-3 bg-gray-100 rounded-lg"
                   placeholder="Masukkan judul proyek">
        </div>

        {{-- Deskripsi --}}
        <div>
            <label class="font-medium">Deskripsi</label>
            <textarea name="deskripsi" rows="4"
                      class="w-full mt-1 p-3 bg-gray-100 rounded-lg"
                      placeholder="Deskripsikan detail proyek..."></textarea>
        </div>

        {{-- Grid --}}
        <div class="grid grid-cols-2 gap-6">

            <div>
                <label class="font-medium">Status</label>
                <select name="status" class="...">
    <option value="belum">Belum Mulai</option>
    <option value="sedang">Proses</option>
    <option value="selesai">Selesai</option>
</select>

            </div>

            <div>
                <label class="font-medium">Prioritas</label>
                <select name="prioritas" class="...">
    <option value="rendah">Rendah</option>
    <option value="sedang">Sedang</option>
    <option value="tinggi">Tinggi</option>
</select>

            </div>

            <div>
                <label class="font-medium">Tanggal Mulai</label>
                <input type="date" name="tanggal_mulai"
                       class="w-full mt-1 p-3 bg-gray-100 rounded-lg">
            </div>

            <div>
                <label class="font-medium">Tanggal Selesai</label>
                <input type="date" name="tanggal_selesai"
                       class="w-full mt-1 p-3 bg-gray-100 rounded-lg">
            </div>

        </div>

        <button
            class="px-4 py-2 bg-[#E5E3E3] ext-black rounded-lg shadow hover:bg-gray-300 font-medium">
            Kirim
        </button>

    </form>

</div>
@endsection
