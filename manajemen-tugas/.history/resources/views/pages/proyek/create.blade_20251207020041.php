@extends('layout.app', ['pageTitle' => 'Tugas'])
@section('content')

<div class="w-full flex justify-center">

    <!-- CARD WRAPPER -->
    <div class="bg-white w-full max-w-4xl p-10 rounded-3xl shadow-lg">

        <h1 class="text-xl font-semibold mb-8">Tambah Tugas Baru</h1>

        <form action="{{ route('tugas.store') }}" method="POST">
            @csrf

            <!-- JUDUL -->
            <div class="mb-6">
                <label class="font-medium">Judul Tugas</label>
                <input type="text"
                       name="judul"
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
                          placeholder="Deskripsikan detail tugas..."
                          rows="3"
                          required
                          class="mt-2 w-full px-4 py-3 bg-gray-100 border rounded-xl focus:ring-2 focus:ring-black outline-none"></textarea>
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
                        <option value="">Pilih status</option>
                        <option value="Belum Mulai">Belum Mulai</option>
                        <option value="Sedang">Sedang</option>
                        <option value="Selesai">Selesai</option>
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
                        <option value="">Pilih prioritas</option>
                        <option value="Rendah">Rendah</option>
                        <option value="Sedang">Sedang</option>
                        <option value="Tinggi">Tinggi</option>
                    </select>
                    @error('prioritas')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- KATEGORI (hanya muncul jika bukan tugas proyek) -->
                @if(!$project_id)
                <div>
                    <label class="font-medium">Kategori</label>
                    <select name="kategori"
                            id="kategori_select"
                            class="mt-2 w-full px-4 py-3 bg-gray-100 border rounded-xl focus:ring-2 focus:ring-black outline-none">
                        <option value="">Pilih Kategori (Opsional)</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->nama_kategori }}</option>
                        @endforeach
                        <option value="buat_baru">+ Buat Kategori Baru</option>
                    </select>
                    @error('kategori')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- INPUT KATEGORI BARU (hidden by default) -->
                <div id="kategori_baru_wrapper" style="display: none;">
                    <label class="font-medium">Nama Kategori Baru</label>
                    <input type="text"
                           name="kategori_baru"
                           id="kategori_baru_input"
                           placeholder="Masukkan nama kategori baru"
                           maxlength="100"
                           class="mt-2 w-full px-4 py-3 bg-gray-100 border rounded-xl focus:ring-2 focus:ring-black outline-none">
                    @error('kategori_baru')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                @endif

                <!-- DEADLINE -->
                <div>
                    <label class="font-medium">Deadline</label>
                    <input type="date"
                           name="deadline"
                           required
                           min="{{ date('Y-m-d') }}"
                           class="mt-2 w-full px-4 py-3 bg-gray-100 border rounded-xl focus:ring-2 focus:ring-black outline-none">
                    @error('deadline')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            <!-- HIDDEN PROJECT ID -->
            <input type="hidden" name="project_id" value="{{ $project_id }}">

            <!-- BUTTON -->
            <div class="mt-10 flex justify-end gap-3">
                <a href="{{ $project_id ? route('proyek.detail', $project_id) : route('tugas.index') }}"
                   class="px-6 py-2 rounded-xl border bg-gray-200 hover:bg-gray-300 transition">
                    Batal
                </a>

                <button type="submit"
                        class="px-6 py-2 rounded-xl bg-black text-white hover:bg-gray-800 transition">
                    Simpan Tugas
                </button>
            </div>

        </form>

    </div>

</div>

@if(!$project_id)
<script>
    document.getElementById('kategori_select').addEventListener('change', function() {
        const wrapper = document.getElementById('kategori_baru_wrapper');
        const input = document.getElementById('kategori_baru_input');

        if (this.value === 'buat_baru') {
            wrapper.style.display = 'block';
            input.required = true;
            this.required = false;
        } else {
            wrapper.style.display = 'none';
            input.required = false;
            input.value = '';
            this.required = false;
        }
    });
</script>
@endif

@endsection
