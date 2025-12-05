@extends('layout.app', ['pageTitle' => 'Tugas'])
@section('content')

<div class="w-full flex justify-center">

    <!-- CARD WRAPPER -->
    <div class="bg-white w-full max-w-4xl p-10 rounded-3xl shadow-lg">

        <h1 class="text-xl font-semibold mb-8">Edit Tugas</h1>

        <form action="{{ route('tugas.update', $tugas->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- JUDUL -->
            <div class="mb-6">
                <label class="font-medium">Judul Tugas</label>
                <input type="text"
                       name="judul"
                       value="{{ $tugas->judul }}"
                       placeholder="Masukkan judul tugas"
                       class="mt-2 w-full px-4 py-3 bg-gray-100 border rounded-xl focus:ring-2 focus:ring-black outline-none">
            </div>

            <!-- DESKRIPSI -->
            <div class="mb-6">
                <label class="font-medium">Deskripsi</label>
                <textarea name="deskripsi"
                          rows="3"
                          class="mt-2 w-full px-4 py-3 bg-gray-100 border rounded-xl focus:ring-2 focus:ring-black outline-none"
                          placeholder="Deskripsikan detail tugas...">{{ $tugas->deskripsi }}</textarea>
            </div>

            <!-- GRID 2 KOLOM -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- STATUS -->
                <div>
                    <label class="font-medium">Status</label>
                    <select name="status"
                            class="mt-2 w-full px-4 py-3 bg-gray-100 border rounded-xl focus:ring-2 focus:ring-black outline-none">
                        <option {{ $tugas->status == 'Belum' ? 'selected' : '' }}>Belum Mulai</option>
                        <option {{ $tugas->status == 'Sedang' ? 'selected' : '' }}>Proses</option>
                        <option {{ $tugas->status == 'Selesai   ' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>

                <!-- PRIORITAS -->
                <div>
                    <label class="font-medium">Prioritas</label>
                    <select name="prioritas"
                            class="mt-2 w-full px-4 py-3 bg-gray-100 border rounded-xl focus:ring-2 focus:ring-black outline-none">
                        <option {{ $tugas->prioritas == 'Rendah' ? 'selected' : '' }}>Rendah</option>
                        <option {{ $tugas->prioritas == 'Sedang' ? 'selected' : '' }}>Sedang</option>
                        <option {{ $tugas->prioritas == 'Tinggi' ? 'selected' : '' }}>Tinggi</option>
                    </select>
                </div>

                <!-- KATEGORI -->
                <div>
                    <label class="font-medium">Kategori</label>
                    <input type="text"
                           name="kategori"
                           value="{{ $tugas->kategori }}"
                           class="mt-2 w-full px-4 py-3 bg-gray-100 border rounded-xl focus:ring-2 focus:ring-black outline-none"
                           placeholder="Isi kategori">
                </div>

                <!-- DEADLINE -->
                <div>
                    <label class="font-medium">Deadline</label>
                    <input type="date"
                           name="deadline"
                           value="{{ $tugas->deadline }}"
                           class="mt-2 w-full px-4 py-3 bg-gray-100 border rounded-xl focus:ring-2 focus:ring-black outline-none">
                </div>

            </div>

            <!-- BUTTON -->
            <div class="mt-10 flex justify-end gap-3">
                <a href="{{ route('tugas.index') }}"
                   class="px-6 py-2 rounded-xl border hover:bg-gray-100 transition">
                    Batal
                </a>

                <button type="submit"
                        class="px-6 py-2 rounded-xl border hover:bg-gray-100 transition">
                    Perbarui
                </button>
            </div>

        </form>

    </div>

</div>

@endsection
