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
                       value="{{ old('judul', $tugas->judul) }}"
                       placeholder="Masukkan judul tugas"
                       required
                       class="mt-2 w-full px-4 py-3 bg-gray-100 border rounded-xl focus:ring-2 focus:ring-black outline-none">
                @error('judul')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- DESKRIPSI -->
            <div class="mb-6">
                <label class="font-medium">Deskripsi</label>
                <textarea name="deskripsi"
                          rows="3"
                          required
                          class="mt-2 w-full px-4 py-3 bg-gray-100 border rounded-xl focus:ring-2 focus:ring-black outline-none"
                          placeholder="Deskripsikan detail tugas...">{{ old('deskripsi', $tugas->deskripsi) }}</textarea>
                @error('deskripsi')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- GRID 2 KOLOM -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- STATUS -->
                <div>
                    <label class="font-medium">Status</label>
                    <select name="status"
                            required
                            class="mt-2 w-full px-4 py-3 bg-gray-100 border rounded-xl focus:ring-2 focus:ring-black outline-none">
                        <option value="Belum Mulai" {{ $tugas->status == 'Belum Mulai' ? 'selected' : '' }}>Belum Mulai</option>
                        <option value="Proses" {{ $tugas->status == 'Proses' ? 'selected' : '' }}>Proses</option>
                        <option value="Sedang" {{ $tugas->status == 'Sedang' ? 'selected' : '' }}>Sedang</option>
                        <option value="Selesai" {{ $tugas->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                    @error('status')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- PRIORITAS -->
                <div>
                    <label class="font-medium">Prioritas</label>
                    <select name="prioritas"
                            required
                            class="mt-2 w-full px-4 py-3 bg-gray-100 border rounded-xl focus:ring-2 focus:ring-black outline-none">
                        <option value="rendah" {{ $tugas->prioritas == 'rendah' ? 'selected' : '' }}>Rendah</option>
                        <option value="sedang" {{ $tugas->prioritas == 'sedang' ? 'selected' : '' }}>Sedang</option>
                        <option value="tinggi" {{ $tugas->prioritas == 'tinggi' ? 'selected' : '' }}>Tinggi</option>
                    </select>
                    @error('prioritas')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- KATEGORI (hanya untuk tugas NON-proyek) -->
                @if(!$tugas->project_id)
                <div>
                    <label class="font-medium">Kategori</label>
                    <select name="kategori"
                            class="mt-2 w-full px-4 py-3 bg-gray-100 border rounded-xl focus:ring-2 focus:ring-black outline-none">
                        <option value="">Tanpa Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ $tugas->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                    @error('kategori')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                @endif

                <!-- DEADLINE -->
                <div>
                    <label class="font-medium">Deadline</label>
                    <input type="date"
                           name="deadline"
                           value="{{ old('deadline', $tugas->tanggal_deadline) }}"
                           required
                           class="mt-2 w-full px-4 py-3 bg-gray-100 border rounded-xl focus:ring-2 focus:ring-black outline-none">
                    @error('deadline')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            <!-- BUTTON -->
            <div class="mt-10 flex justify-end gap-3">
                <a href="{{ route('tugas.index') }}"
                   class="px-6 py-2 rounded-xl border bg-gray-200 hover:bg-gray-300 transition">
                    Batal
                </a>

                <button type="submit"
                        class="px-6 py-2 rounded-xl bg-black text-white hover:bg-gray-800 transition">
                    Perbarui
                </button>
            </div>

        </form>

    </div>

</div>

@endsection
