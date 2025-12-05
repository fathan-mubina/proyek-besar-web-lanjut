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
                       class="mt-2 w-full px-4 py-3 bg-gray-100 border rounded-xl focus:ring-2 focus:ring-black outline-none">
            </div>

            <!-- DESKRIPSI -->
            <div class="mb-6">
                <label class="font-medium">Deskripsi</label>
                <textarea name="deskripsi"
                          placeholder="Deskripsikan detail tugas..."
                          rows="3"
                          class="mt-2 w-full px-4 py-3 bg-gray-100 border rounded-xl focus:ring-2 focus:ring-black outline-none"></textarea>
            </div>

            <!-- GRID 2 KOLOM -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- STATUS -->
                <div>
                    <label class="font-medium">Status</label>
                    <select name="status"
                            class="mt-2 w-full px-4 py-3 bg-gray-100 border rounded-xl focus:ring-2 focus:ring-black outline-none">
                        <option>Pilih status</option>
                        <option>Belum</option>
                        <option>Sedang</option>
                        <option>Selesai</option>
                    </select>
                </div>

                <!-- PRIORITAS -->
                <div>
                    <label class="font-medium">Prioritas</label>
                    <select name="prioritas"
                            class="mt-2 w-full px-4 py-3 bg-gray-100 border rounded-xl focus:ring-2 focus:ring-black outline-none">
                        <option>Pilih prioritas</option>
                        <option>Rendah</option>
                        <option>Sedang</option>
                        <option>Tinggi</option>
                    </select>
                </div>

                <!-- KATEGORI -->
                <div>
                    <label class="font-medium">Kategori</label>
                    <select name="kategori"
                            class="mt-2 w-full px-4 py-3 bg-gray-100 border rounded-xl focus:ring-2 focus:ring-black outline-none">
                        <option value="1">Pilih Kategori</option>
                        <option value="2">Umum</option>
                        <option value="3">Pendidikan</option>
                        <option value="4">Pekerjaan</option>
                    </select>
                </div>


                <!-- DEADLINE -->
                <div>
                    <label class="font-medium">Deadline</label>
                    <input type="date"
                           name="deadline"
                           class="mt-2 w-full px-4 py-3 bg-gray-100 border rounded-xl focus:ring-2 focus:ring-black outline-none">
                </div>

            </div>

            <!-- BUTTON -->
             <input type="hidden" name="project_id" value="{{ $project_id }}">
            <div class="mt-10 flex justify-end gap-3">
    <a href="{{ route('tugas.index') }}"
       class="px-4 py-2 bg-gray-200 text-black rounded-lg shadow hover:bg-gray-300 font-medium">
        Batal
    </a>
    <button type="submit"
        class="px-4 py-2 bg-black text-white rounded-lg shadow hover:bg-gray-800 font-medium">
        Kirim
    </button>
</div>


        </form>

    </div>

</div>

@endsection
